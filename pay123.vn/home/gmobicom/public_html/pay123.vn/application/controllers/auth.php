<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->lang->load('tank_auth');

	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
		$data = $this->data;
		$data['title'] = 'Thong bao';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('auth/general_message', array('message' => $message));
		$this->load->view('layout/footer');
		} else {
			redirect('/auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		$data = $this->data;  
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			//redirect('/auth/send_again/');
			// 24/12/2013Trc kia là gửi lại email, giờ sửa lại là kích hoạt số đt
			redirect('/auth/active_phone/');

		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Ghi nhớ', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				if ($data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', 'Mã xác nhận', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', 'Mã xác nhận', 'trim|xss_clean|required|callback__check_captcha');
			}
			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {								// success
				if(count($this->cart->contents()) > 0)
				{
					redirect(''.$this->config->base_url().'cart');
				}
				else
				{
					redirect($this->config->base_url());
				}

				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						//redirect('/auth/send_again/');
						//24/12/2013
						redirect('/auth/active_phone/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			$data['title'] = 'Đăng nhập';
			
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('auth/login_form', $data);
			$this->load->view('layout/footer', $data);

			
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();

		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		$data = $this->data;
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			//redirect('/auth/send_again/');
			// 24/12/2013Trc kia là gửi lại email, giờ sửa lại là kích hoạt số đt
			redirect('/auth/active_phone/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));

		} else {
			$use_username = $this->config->item('use_username', 'tank_auth');
			if ($use_username) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			}
			// 24/12/2013, tắt chức năng mã xác nhận và số đt, thay email bằng số đt
			//$this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Số ĐT', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', 'trim|required|xss_clean|matches[password]');

			$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
			$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Mã xác nhận', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Mã xác nhận', 'trim|xss_clean|required|callback__check_captcha');
				}
			}
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');
			
			if ($this->form_validation->run()) {								// validation ok
			$email = $this->form_validation->set_value('email');
			if(substr($email, 0, 1) == '0')
			{
				$email = substr($email, 1);
				$email = '84'.$email.'';
			}
				if (!is_null($data = $this->tank_auth->create_user(
						$use_username ? $this->form_validation->set_value('username') : '',
						$email,
						$this->form_validation->set_value('password'),
						$email_activation))) {									// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {									// send "activate" email
						$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

						$this->_send_email('activate', $data['email'], $data);

						unset($data['password']); // Clear password (just for any case)
						$this->load->model('tank_auth/users','tuser');
						$data['user'] = (array)$this->tuser->get_user_by_id($data['user_id']); 
						$this->session->set_userdata(array(
								'user_id'	=> $data['user']['id'],
								'credit'	=> $data['user']['credit'],
								'username'	=> $data['user']['username'],
								'status'	=> ($data['user']['activated'] == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
								'new_email_key' => $data['user']['new_email_key'],
						));
		
						redirect(''.$this->config->base_url().'auth/active_phone');
						$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

							$this->_send_email('welcome', $data['email'], $data);
						}
						unset($data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_2'));
					}
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			$data += $this->data;
			$data['title'] = 'Đăng kí';
			$data['use_username'] = $use_username;
			$data['captcha_registration'] = $captcha_registration;
			$data['use_recaptcha'] = $use_recaptcha;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('auth/register_form', $data);
			$this->load->view('layout/footer');
		}
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		$data = $this->data;
		if (!isset($data['user_id']) AND (!isset($data['user']['id']) OR $data['user']['id'] < 1)) {									// logged in
			redirect('');
		}
		if($data['new_email_key'] > 0)
		{
			$this->_send_email('send_again', $data['user']['email'], &$data['user']);
		
			redirect('auth/active_phone');
		}
		else
		{
			redirect('');
		}
	}
	
	public function active_phone()
	{
		$data = $this->data;

		$data['title'] = 'Kích hoạt tài khoản';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('auth/active_phone', $data);
		$this->load->view('layout/footer');
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$data = $this->data;
		
		//24/12/2013
		//$user_id		= $this->uri->segment(3);
		//$new_email_key	= $this->uri->segment(4);
		$user_id = $this->tank_auth->get_user_id();
		
		$this->form_validation->set_rules('active_key', 'Mã xác nhận', 'trim|required|xss_clean');
		$this->form_validation->run();
		$new_email_key = $this->form_validation->set_value('active_key');

		
		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->load->model('tank_auth/users','tuser');
			$data['user'] = (array)$this->tuser->get_user_by_id($user_id); 
			$this->session->set_userdata(array(
					'user_id'	=> $data['user']['id'],
					'credit'	=> $data['user']['credit'],
					'username'	=> $data['user']['username'],
					'status'	=> ($data['user']['activated'] == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
					'new_email_key' => $data['user']['new_email_key'],
			));
						
			$this->_show_message($this->lang->line('auth_message_activation_completed'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		$data = $this->data;
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			//redirect('/auth/send_again/');
			// 24/12/2013 chuyển sang trang kích hoạt số đt
			redirect('/auth/active_phone/');

		} else {
			$this->form_validation->set_rules('email', 'Số ĐT', 'trim|required|xss_clean');
			
			$data['errors'] = array();

			
			if ($this->form_validation->run()) {								// validation ok
			$email = $this->form_validation->set_value('email');	
			if(substr($email, 0, 1) == '0')
			{
				$email = substr($email, 1);
				$email = '84'.$email.'';
			}
				if (!is_null($data = $this->tank_auth->forgot_password(
						$email))) {
					$this->session->set_userdata('user_id_wait', $data['user_id']);
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);
					redirect('auth/reset_pass');
					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$this->_show_message('Chúng tôi không tìm thấy số điện thoại nào phù hợp');
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			if(!isset($data) OR $data ==NULL)
			{
				$data = $this->data;
			}
			else
			{
				$data += $this->data;
			}
			$data['title'] = 'Quên mật khẩu';
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('auth/forgot_password_form', $data);
			$this->load->view('layout/footer');
		}
	}

	
	public function reset_pass()
	{
		$data = $this->data;

		$data['title'] = 'Đổi mật khẩu';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('auth/reset_pass', $data);
		$this->load->view('layout/footer');
	}
	
	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$data = $this->data;
		$user_id = $this->session->userdata('user_id_wait');
		$this->form_validation->set_rules('reset_key', 'Mã xác nhận', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_password', 'Mật khẩu mới', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Xác nhận mật khẩu', 'trim|required|xss_clean|matches[new_password]');
		
		$this->form_validation->run();
		$new_pass_key = $this->form_validation->set_value('reset_key');

		
		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		$data['title'] = 'Lấy lại mật khẩu';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('auth/reset_password_form', $data);
		$this->load->view('layout/footer');
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		$data = $this->data;
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Mật khẩu', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'Mật khẩu mới', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Xác nhận mật khẩu', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$data['title'] = 'Đổi mật khẩu';
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('auth/change_password_form', $data);
			$this->load->view('layout/footer');
		}
	}

	

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$data = $this->data;
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Đăng nhập'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 * Function này nguy hiểm quá, thôi xóa
	 
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$data = $this->data;
			$data['title'] = 'Xóa nick';
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('auth/unregister_form', $data);
			$this->load->view('layout/footer');
		}
	}
	*/

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$data = $this->data;
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email_cu($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}
	
	function _send_email($type, $email, &$data)
	{
	$this->load->library('vnpay/nusoap/nusoap', 'nusoap');
	$MTusername="ibo";
	$MTpassword="svjetisc2k14";
	$serviceId="8741"; 
	$requestId="1";
	$contentType="0";  
	$commandCode="HS";
	$phone = $data['email'];
	if(substr($phone, 0, 1) == '0')
	{
		$phone = substr($phone, 1);
		$phone = '84'.$phone.'';
	}
	switch ($type)
	{
		case 'send_again':
			$key  = $data['new_email_key'];
			$message = 'Ma xac nhan (pay123.vn): '.$key.'';
		break;
		
		case 'activate':
			$key  = $data['new_email_key'];
			$message = 'Ma xac nhan (pay123.vn): '.$key.'';
		break;
		
		case 'forgot_password':	
			$key  = $data['new_pass_key'];
			$message = 'Ma xac nhan (pay123.vn): '.$key.'';	
		break;
		
		case 'reset_password':
			$key = $data['new_password'];
			$message = 'Chuc mung! Doi mat khau tai khoan '.$data['username'].' tren pay123.vn thanh cong!';
		break;
	}
	
	$mt = new soapclient('http://8x41.com/ws8x41/SendMTReceiver/index.php?wsdl');
    
	$params=array('userId'=>$phone,'message'=>$message,'serviceId'=>$serviceId,'commandCode'=>$commandCode,'requestId'=>$requestId,'contentType'=>$contentType,'MTusername'=>$MTusername,'MTpassword'=>$MTpassword);
	$result=$mt->__call('sendMT', $params);
	}
	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */