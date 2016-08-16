
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* * @author: Starvnnet
 * AdminCP Controller  */
class admin extends MY_Controller{

	function __construct(){
		die();
		parent::__construct();
		$this->load->model('admin_model','admin');
	}

	public $arr_order = array('count','doanhthu','gia');
	protected $admins = array('1', '2', '7'); 
	public function index()
	{
		/*
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		*/
		$data['title'] = 'Bảng điều khiển của Sếp';
		$data['main_template'] = 'admin/main';
		$this->load->view('admin/template_sidebar', $data);
		
	}
	
	public function add_card()
	{
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		$the = '';
		if(isset($_GET['the']))
		{
			$the = $_GET['the'];
		}
		
		if($the == '')
		{
				$data['all'] = (array)json_decode($this->menhgia->giathe('all'));
				$data['title'] = 'Chọn loại thẻ cần thêm' ;
			    $data['main_template'] = 'admin/add';
				$this->load->view('admin/template_sidebar', $data);
		}	else {
				$data['all'] = (array)json_decode($this->menhgia->giathe('all'));
				
				if(!isset($data['all'][$the]))
				{
					redirect('');
				}
				else {
					$data['all'] = (array)json_decode($this->menhgia->giathe('all'));
					$data['title'] = 'Thêm thẻ' ;
					$data['main_template'] = 'admin/add_form';
					$this->load->view('admin/template_sidebar', $data);
				}
		}
	}
	
	public function add_save()
	{
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		$this->load->model('card_model', 'card');
		$this->form_validation->set_rules('loai', 'Loại', 'xss_clean');
		$this->form_validation->set_rules('seri', 'Seri', 'required|xss_clean');
		$this->form_validation->set_rules('ma', 'Mã thẻ', 'required|xss_clean');
		
		$this->form_validation->set_rules('seri2', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma2', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri3', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma3', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri4', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma4', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri5', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma5', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri6', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma6', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri7', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma7', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri8', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma8', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri9', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma9', 'Mã thẻ', 'xss_clean');
		
		$this->form_validation->set_rules('seri10', 'Seri', 'xss_clean');
		$this->form_validation->set_rules('ma10', 'Mã thẻ', 'xss_clean');

		$this->form_validation->run();

		$loai = $this->form_validation->set_value('loai');
		$seri = fire($this->form_validation->set_value('seri'));
		$ma = fire($this->form_validation->set_value('ma'));
		
		$seri2 = fire($this->form_validation->set_value('seri2'));
		$ma2 = fire($this->form_validation->set_value('ma2'));
		
		$seri3 = fire($this->form_validation->set_value('seri3'));
		$ma3 = fire($this->form_validation->set_value('ma3'));
		
		$seri4 = fire($this->form_validation->set_value('seri4'));
		$ma4 = fire($this->form_validation->set_value('ma4'));
		
		$seri5 = fire($this->form_validation->set_value('seri5'));
		$ma5 = fire($this->form_validation->set_value('ma5'));
		
		$seri6 = fire($this->form_validation->set_value('seri6'));
		$ma6 = fire($this->form_validation->set_value('ma6'));
		
		$seri7 = fire($this->form_validation->set_value('seri7'));
		$ma7 = fire($this->form_validation->set_value('ma7'));
		
		$seri8 = fire($this->form_validation->set_value('seri8'));
		$ma8 = fire($this->form_validation->set_value('ma8'));
		
		$seri9 = fire($this->form_validation->set_value('seri9'));
		$ma9 = fire($this->form_validation->set_value('ma9'));
		
		$seri10 = fire($this->form_validation->set_value('seri10'));
		$ma10 = fire($this->form_validation->set_value('ma10'));
		
		$tc = 1;
		$this->card->insert($loai, $seri, $ma);
		if(strlen($ma2) > 3)
		{
			$this->card->insert($loai, $seri2, $ma2);
			$tc ++;
		}
		if(strlen($ma3) > 3)
		{
			$this->card->insert($loai, $seri3, $ma3);
			$tc ++;
		}
		if(strlen($ma4) > 3)
		{
			$this->card->insert($loai, $seri4, $ma4);
			$tc ++;
		}
		if(strlen($ma5) > 3)
		{
			$this->card->insert($loai, $seri5, $ma5);
			$tc ++;
		}
		if(strlen($ma6) > 3)
		{
			$this->card->insert($loai, $seri6, $ma6);
			$tc ++;
		}
		if(strlen($ma7) > 3)
		{
			$this->card->insert($loai, $seri7, $ma7);
			$tc ++;
		}
		if(strlen($ma8) > 3)
		{
			$this->card->insert($loai, $seri8, $ma8);
			$tc ++;
		}
		if(strlen($ma9) > 3)
		{
			$this->card->insert($loai, $seri9, $ma9);
			$tc ++;
		}
		if(strlen($ma10) > 3)
		{
			$this->card->insert($loai, $seri10, $ma10);
			$tc ++;
		}
		$this->session->set_flashdata('message', 'Lưu thông tin '.$tc.' thẻ thành công. Chọn loại thẻ muốn thêm tiếp.');
		redirect(''.ADMIN_URL.'add_card');
	}
	
	public function list_card()
	{
		$this->load->model('tank_auth/users','usrs');
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		$this->load->model('card_model', 'card');
		$user_id = NULL;
		$seri = NULL;
		$ma = NULL;
		if(isset($_GET['user_id']) AND $_GET['user_id'] != '') 
		{
			$user = (array)$this->usrs->get_user_by_username($_GET['user_id']);
			if(isset($user['id'])) {	
				$user_id = $user['id'];
			}
		}
		if(isset($_GET['seri']) AND $_GET['seri'] != '') 
		{
			$seri = fire($_GET['seri']);
			$seri = substr($seri, 0, -3);
		}
		if(isset($_GET['ma']) AND $_GET['ma'] != '') 
		{
			$ma = fire($_GET['ma']);
			$ma = substr($ma, 0, -3);   
		}
		
		$data['title'] = 'Tìm thẻ'; 
		if( (isset($_GET['user_id']) AND  $_GET['user_id'] != '') OR (isset($_GET['seri']) AND $_GET['seri'] != '') OR (isset($_GET['ma']) AND $_GET['ma'] != ''))
		{
			$data['cards'] = $this->card->searchCode($user_id, $seri, $ma);
		} 
		else
		{
			$data['cards'] = array();
		}
		$data['main_template'] = 'admin/search';
		$this->load->view('admin/template_sidebar', $data);
		
	}
	
	public function list_card2()
	{
		$this->load->model('tank_auth/users','usrs');
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		$this->load->model('card_model', 'card');
		
		$user_id = '';
		$seri = '';
		$ma = '';
		$data['title'] = 'Tìm thẻ'; 
		$data['cards'] = $this->card->searchCode($user_id, $seri, $ma);
		$data['main_template'] = 'admin/search';
		$this->load->view('admin/template_sidebar', $data);
		
	}
	
	public function report_card()
	{
		if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
		$this->load->model('card_model', 'card');
		echo '<meta charset="utf8"/>';
		$counts = $this->card->getCountByLoai();
		$canhbao = array(
			'viettel10' => 10,'viettel20' => 10,'vina10' => 10,'vina20' => 10,'mobi10' => 10,'mobi20' => 10,
			'viettel30' => 7,'vina30' => 7,'mobi30' => 7,
			'viettel50' => 5,'vina50' => 5,'mobi50' => 5,
			'viettel100' => 3,'vina100' => 3,'mobi100' => 3,
			'viettel200' => 1 ,'viettel300' => 1 ,'viettel500' => 1 ,'vina200' => 1 ,'vina300' => 1 ,'vina500' => 1 ,'mobi200' => 1 ,'mobi300' => 1 ,
			'mobi500' => 1 ,'gate20' => 1 ,'gate50' => 1 ,'gate90' => 1 ,'gate100' => 1 ,'gate200' => 1, 'gate500' => 1 ,'vcoin20' => 1 ,'vcoin50' => 1 ,'vcoin100' => 1 ,
			'zing20' => 1 ,'zing60' => 1 ,'zing120' => 1 ,'oncash20' => 1 ,'oncash60' => 1 ,'oncash100' => 1 ,'oncash200' => 1 ,'vgold20' => 1 ,'vgold50' => 1 ,'vgold100' => 1
		);
		
		$list_cards = array('viettel10', 'viettel20', 'viettel30', 'viettel50', 'viettel100', 'viettel200', 'viettel300', 'viettel500', 'vina10', 'vina20', 'vina30', 'vina50', 'vina100', 'vina200', 'vina300', 'vina500', 'mobi10', 'mobi20', 'mobi30', 'mobi50', 'mobi100', 'mobi200', 'mobi300', 'mobi500', 'gate20', 'gate50', 'gate90', 'gate100', 'gate200', 'vcoin20', 'vcoin50', 'vcoin100', 'zing20', 'zing60', 'zing120', 'oncash20', 'oncash60', 'oncash100', 'oncash200', 'vgold20', 'vgold50', 'vgold100');
	
	
		$notice = '';
		foreach($counts AS $count)
		{
			foreach($list_cards AS $key => &$list_card)
			{
				if($list_card == $count['loai'])
				{
					unset($list_cards[$key]);
				}
			}
			//echo $count['loai']; 
			//echo ' - ';
			//echo $count['soluong'];
			//echo ' - ';
			//echo $canhbao[$count['loai']];
			//echo '<br>';
			$a = $count['soluong'] - $canhbao[$count['loai']];
			if($a <= 0)
			{
				$thieu  = -($a - $canhbao[$count['loai']]);
				$notice .= 'Thẻ '.$count['loai'].' bị thiếu '.$thieu.' cái <br>';
			}
		}
		
		foreach($list_cards AS $list)
		{
			$notice .= 'Không còn thẻ: '.$list.' <br>';
		}
	$data['title'] = 'Tình trạng thẻ';
	$data['notice'] = $notice;
    $data['main_template'] = 'admin/report';
    $this->load->view('admin/template_sidebar', $data);
	}
	
	public function categories()
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
    $data['categories'] = $this->news_model->get_all_category($active = 1);
    $data['deleted_categories'] = $this->news_model->get_all_category($active = 0);
    $data['title'] = 'Quản lý danh mục';
    $data['main_template'] = 'admin/news/categories';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function category($category_id)
  {
  if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
    $this->load->model('news_model', 'news');
    $data['posts'] = $this->news->get_all_post($category_id);
    $data['title'] = 'Xem danh mục';
    $data['main_template'] = 'admin/news/category';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function category_add()
  {
  if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
    $this->load->model('news_model', 'news');
    $data['category'] = array(
      'id' => '',
      'short_title' => '',
      'title' => '',
      'description' => '',
      'active' => '1',
    );
    $data['title'] = 'Thêm danh mục mới';
    $data['main_template'] = 'admin/news/category_add';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function category_edit($id)
  {
  if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
    $this->load->model('news_model', 'news');
    $data['category'] = $this->news->get_category_by_id($id);
    $data['title'] = 'Sửa danh mục';
    $data['main_template'] = 'admin/news/category_add';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function category_save()
  {
  if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
		{
			redirect('404');
			exit();
		}
    $this->load->model('news_model', 'news');
    $this->form_validation->set_rules('id', 'ID', 'xss_clean');
    $this->form_validation->set_rules('short_title', 'Tiêu đề ngắn gọn', 'required|xss_clean');
    $this->form_validation->set_rules('title', 'Tiêu đề', 'required|xss_clean');
    $this->form_validation->set_rules('active', 'Kích hoạt', 'required|xss_clean');
    $this->form_validation->set_rules('description', 'Miêu tả ngắn gọn', 'required|xss_clean');

    $this->form_validation->run();

    $id = $this->form_validation->set_value('id');
    $short_title = $this->form_validation->set_value('short_title');
    $title = $this->form_validation->set_value('title');
    $active = $this->form_validation->set_value('active');
    $description = $this->form_validation->set_value('description');
    if ($title != '') {
      $category_id = $this->news->category_save($id, $short_title, $title, $active, $description);
      $this->session->set_flashdata('message', 'Lưu thông danh mục thành công!');
    }
    redirect('' . $this->config->base_url() . 'news/' . $category_id . '');
  }

  public function category_delete($id)
  {
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    if ($id > 0) {
      $this->load->model('news_model', 'news');
      $this->news->category_change_active($id, '0');
      $this->session->set_flashdata('message', 'Lưu thông danh mục thành công!');
    }
    redirect('' . ADMIN_URL . 'categories');
  }

  public function category_undel($id)
  {
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    if ($id > 0) {
      $this->load->model('news_model', 'news');
      $this->news->category_change_active($id, '1');
      $this->session->set_flashdata('message', 'Lưu thông danh mục thành công!');
    }
    redirect('' . ADMIN_URL . 'categories');
  }

  public function category_harddel($id)
  {
    if ($id > 0) {
      $this->load->model('news_model', 'news');
      if ($this->news->category_delete($id)) {
        $this->session->set_flashdata('message', 'Xóa thành công!');
      } else {
        $this->session->set_flashdata('message', 'Không được phép xóa mục này');
      }
    }
    redirect('' . ADMIN_URL . 'categories');
  }

  public function post_add()
  {
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    $this->load->model('news_model', 'news');
    $data['post'] = array(
      'id' => '',
      'title' => '',
      'category_id' => '',
      'image' => '',
      'description' => '',
      'content' => '',
    );
    $data['categories'] = $this->news->get_all_category();
    $data['title'] = 'Thêm bài viết mới';
    $data['main_template'] = 'admin/news/post_add';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function post_edit($id)
  {
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    $this->load->model('news_model', 'news');
    $data['post'] = $this->news->get_post_by_id($id);
    $data['categories'] = $this->news->get_all_category();
    $data['title'] = 'Sửa danh mục';
    $data['main_template'] = 'admin/news/post_add';
    $this->load->view('admin/template_sidebar', $data);
  }

  public function post_delete($id)
  {
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    $this->load->model('news_model', 'news');
    if ($post = $this->news->get_post_by_id($id)) {
      $this->news->post_delete($id);
      $this->session->set_flashdata('message', 'Xóa thành công!');
      redirect('' . ADMIN_URL . 'category/' . $post['category_id'] . '');
    } else {
      redirect('' . ADMIN_URL . 'categories');
    }
  }

  public function post_save()
  {
  if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
    $this->load->model('news_model', 'news');
    $this->form_validation->set_rules('id', 'ID', 'xss_clean');
    $this->form_validation->set_rules('title', 'Tiêu đề bài viết', 'required|xss_clean');
    $this->form_validation->set_rules('category_id', 'Mã danh mục', 'required|xss_clean');
    $this->form_validation->set_rules('image', 'Hình ảnh', 'required|xss_clean');
    $this->form_validation->set_rules('description', 'Miêu tả ngắn gọn', 'required|xss_clean');
    $this->form_validation->set_rules('content', 'Nội dung', 'required|xss_clean');

    $this->form_validation->run();

    $id = $this->form_validation->set_value('id');
    $title = $this->form_validation->set_value('title');
    $category_id = $this->form_validation->set_value('category_id');
    $image = $this->form_validation->set_value('image');
    $description = $this->form_validation->set_value('description');
    $content = $this->form_validation->set_value('content');
    if ($title != '') {
      $post_id = $this->news->post_save($id, $title, $category_id, $image, $description, $content);
      $this->session->set_flashdata('message', 'Lưu thông tin thành công!');
    }
    redirect('' . $this->config->base_url() . 'post/' . $post_id . '');
  }

  
	public function users($page = 1)
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		//WHERE cho có để bên dưới nối cái AND vào, chứ nó chẳng có nghĩa gì :D
		$search = 'WHERE `id` >0 ';
		if(isset($_GET['phone']) AND $_GET['phone'] !== '')
		{
			$s_phone =  $this->news_model->friendly_url($_GET['phone']);
			$search .= ' AND `phone` LIKE "%'.$s_phone.'%"';
		}
		if(isset($_GET['username']) AND $_GET['username']!== '')
		{
			$s_username = $this->news_model->friendly_url($_GET['username']);
			$search .= ' AND `username` LIKE "%'.$s_username.'%"';
		}
		if(isset($_GET['email']) AND $_GET['email'] !== '') 
		{
			$s_email =  $this->news_model->friendly_url($_GET['email']);
			$search .= ' AND `email` LIKE "%'.$s_email.'"';
		}
		
		$data['title'] = 'Danh sách thành viên';
		$data['each_page'] = 15;
		$data['page'] = $page;
		$data['users'] = $this->users->get_users($search,$page, $data['each_page']);
		$data['count_page'] = ceil($this->users->count_users()/$data['each_page']);
		$data['main_template'] = 'admin/user/main';
		$this->load->view('admin/template_sidebar', $data);
	}
	
	public function user_edit($user_id)
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
	
		if(!$user = (array)$this->users->get_user_by_id($user_id))
		{
			redirect(''.ADMIN_URL.'/users');
		}
		$data['title'] = ''.$user['username'].' - Sửa thông tin thành viên';
		$data['user'] = $user;
		$data['main_template'] = 'admin/user/edit';
		$this->load->view('admin/template_sidebar', $data);
	}
	
	public function user_save()
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		$this->load->library('tank_auth','tank_auth');
		$this->form_validation->set_rules('id', 'ID', 'required|xss_clean');
		$this->form_validation->set_rules('username', 'Tên tài khoản', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|xss_clean');
		$this->form_validation->set_rules('banned', 'Cấm thành viên', 'trim|xss_clean');
		$this->form_validation->set_rules('ban_reason', 'Lý do cấm', 'trim|xss_clean');
		$this->form_validation->run();
		
		$id					= $this->form_validation->set_value('id');
		$username		= $this->form_validation->set_value('username');
		$email				= $this->form_validation->set_value('email');
		$password		= $this->form_validation->set_value('password');
		$banned			= $this->form_validation->set_value('banned');
		$ban_reason	= $this->form_validation->set_value('ban_reason');
		
		if(!$user = (array)$this->users->get_user_by_id($id))
		{
			redirect(''.ADMIN_URL.'users');
		};
		
		if($password == '')
		{
			$password = $user['password'];
		}
		else
		{
			$password = $this->tank_auth->make_new_pass($password);
		};
		if($username != '')
		{
			$phone = '';
			//Không dùng phone nữa, nhưng database trót tạo r
			$this->users->update_user_info($id, $username, $email, $phone, $password, $banned, $ban_reason);
			$this->session->set_flashdata('message', 'Lưu thông tin thành công!');
		}
		redirect(''.ADMIN_URL.'user_edit/'.$this->form_validation->set_value('id').'');
	}
	
	public function thongkengay()
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		$arr_order = $this->arr_order;
		if($this->uri->slash_segment(3) !== null)
		{
			$order = $this->uri->slash_segment(3);
			$order = substr($order, 0, -1);
			if(!in_array($order, $arr_order))
			{
				$order = '';
			}
		}
		else
		{
			$order = '';
		}
			$data['cards'] = $this->admin->thongke(1,'all',$order);
			$data['main_template'] = 'admin/thongke';
			$data['title'] = 'Thống kê theo ngày';
			$this->load->view('admin/template_sidebar', $data);
	}
	
	public function thongkethang()
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		$arr_order = $this->arr_order;
		if($this->uri->slash_segment(3) !== null)
		{
			$order = $this->uri->slash_segment(3);
			$order = substr($order,0,-1);
			if(!in_array($order, $arr_order))
			{
				$order = '';
			}
		}
		else{
			$order = '';
		}
			$data['cards'] = $this->admin->thongke(30,'all',$order);
			$data['main_template'] = 'admin/thongke';
			$data['title'] = 'Thống kê theo tháng';
			$this->load->view('admin/template_sidebar', $data);
	}
	
	public function thongketuan(){
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		$arr_order = $this->arr_order;
		if($this->uri->slash_segment(3) !== null)
		{
			$order = $this->uri->slash_segment(3);
			$order = substr($order,0,-1);
			if(!in_array($order, $arr_order))
			{
				$order = '';
			}
		}
	else{
		$order = '';
	}
		$data['cards'] = $this->admin->thongke(7,'all',$order);
		$data['main_template'] = 'admin/thongke';
		$data['title'] = 'Thống kê theo tuần';
		$this->load->view('admin/template_sidebar', $data);
	}
	
	public function thongke()
	{
	if(!$this->tank_auth->get_user_id() > 0 OR !in_array($this->tank_auth->get_user_id(), $this->admins))
	{
		redirect('404');
		exit();
	}
		$data['cards'] = $this->admin->thongke();
		$data['title'] = 'Thống kê';
		$data['main_template'] = 'admin/thongke';
		$this->load->view('admin/template_sidebar', $data);
	}
}
