<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('encrypt_card');
		$this->load->library('security');
		$this->load->model('card_model','card');
	}

	public function the()
	{
		$this->load->model('card_model', 'card');
		$thes = $this->card->searchCode();
		foreach($thes AS $the)
		{
			echo '(\' '.$the['id'].' \', \' '.$the['loai'].' \', \' '.water($the['seri']).' \', \' '.water($the['ma']).' \', \' '.$the['ngaynhap'].' \', \' '.$the['ngayxuat'].' \', \' '.$the['user_id'].' \', \' '.$the['gia'].' \', \' '.$the['user_id_hold'].' \', \' '.$the['time_hold'].' \', \' '.$the['orderId'].' \'), ';
			echo '<br>';
		}
	}
	public function index()
	{
		$data = $this->data;
		$data['title'] = 'Xác nhận thanh toán';
		$data['cart'] = $this->cart->contents();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		echo '<div class="col-md-9 g-home" role="main">';
		$this->load->view('cart/main', $data);
		echo '</div>';
		$this->load->view('layout/footer', $data);
	}
	
	public function check_ca()
	{
		echo '<meta charset="utf8"/>';
		$counts = $this->card->getCountByLoai();
		$canhbao = array(
			'viettel10' => 10,'viettel20' => 10,'vina10' => 10,'vina20' => 10,'mobi10' => 10,'mobi20' => 10,
			'viettel30' => 7,'vina30' => 7,'mobi30' => 7,
			'viettel50' => 5,'vina50' => 5,'mobi50' => 5,
			'viettel100' => 3,'vina100' => 3,'mobi100' => 3,
			'viettel200' => 1 ,'viettel300' => 1 ,'viettel500' => 1 ,'vina200' => 1 ,'vina300' => 1 ,'vina500' => 1 ,'mobi200' => 1 ,'mobi300' => 1 ,
			'mobi500' => 1 ,'gate20' => 1 ,'gate50' => 1 ,'gate90' => 1 ,'gate100' => 1 ,'gate200' => 1 , 'gate500' => 1 ,'vcoin20' => 1 ,'vcoin50' => 1 ,'vcoin100' => 1 ,
			'zing20' => 1 ,'zing60' => 1 ,'zing120' => 1 ,'oncash20' => 1 ,'oncash60' => 1 ,'oncash100' => 1 ,'oncash200' => 1 ,'vgold20' => 1 ,'vgold50' => 1 ,'vgold100' => 1
		);
		
		$list_cards = array('viettel10', 'viettel20', 'viettel30', 'viettel50', 'viettel100', 'viettel200', 'viettel300', 'viettel500', 'vina10', 'vina20', 'vina30', 'vina50', 'vina100', 'vina200', 'vina300', 'vina500', 'mobi10', 'mobi20', 'mobi30', 'mobi50', 'mobi100', 'mobi200', 'mobi300', 'mobi500', 'gate20', 'gate50', 'gate90', 'gate100', 'gate200', 'vcoin20', 'vcoin50', 'vcoin100', 'zing20', 'zing60', 'zing120', 'oncash20', 'oncash60', 'oncash100', 'oncash200', 'vgold20', 'vgold50', 'vgold100');
		$tatca = count($list_cards);
	
		$notice = '';
		foreach($counts AS $count)
		{
			echo $count;
			echo "<br/>";
			foreach($list_cards AS $key => &$list_card)
			{
				echo $list_card;
				echo "<br/>";
				if($list_card == $count['loai'])
				{
					unset($list_cards[$key]);
				}
			}
			
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
		$soluonghet = count($list_cards);
		$nguyhiem = '';
		if($tatca == $soluonghet)
		{
			$nguyhiem = 'Nguy hiem: Tat cac cac the da het';
		}
		echo '<b>'.$nguyhiem.'</b><br>';
		echo $notice;
		if($notice != '')
		{
			$this->load->library('vnpay/nusoap/nusoap', 'nusoap');
			$MTusername="ibo";
			$MTpassword="svjetisc2k14";
			$serviceId="8741"; 
			$requestId="1";
			$contentType="0";  
			$commandCode="SV";
			$phone = '84983128783';
			$message = 'Pay123.vn thong bao het the. Vui long cap nhat them!';
			
			$mt = new soapclient('http://8x41.com/ws8x41/SendMTReceiver/index.php?wsdl');
			
			$params=array('userId'=>$phone,'message'=>$message,'serviceId'=>$serviceId,'commandCode'=>$commandCode,'requestId'=>$requestId,'contentType'=>$contentType,'MTusername'=>$MTusername,'MTpassword'=>$MTpassword);
			$result=$mt->__call('sendMT', $params);
		}
	}
	
	
	
	/*
	//function này nguy hiểm, hiện toàn bộ số thẻ trng kho
	public function all()
	{
		$all = $this->card->getCode(NULL, 100, NULL, 0);
		foreach($all as $al)
		{
			echo ''.$al['loai'].' - '.water($al['seri']) .' - '.water($al['ma']).'<br>';
		}
	}
	*/
	public function history()
	{
		$data = $this->data;
		$data['title'] = 'Danh sách đã mua';
		if(!isset($data['user']['id']) OR $data['user']['id'] < 1){
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			$this->load->view('cart/history');
			$this->load->view('layout/footer', $data);
		}
		else{  
		$data['history'] = $this->card->getCodeHistory(NULL, 100, $data['user']['id'], '0');
		$data['title'] = 'Danh sách đã mua';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('cart/history', $data);
		$this->load->view('layout/footer', $data);
		}
	}
	/*public function checkout()
	{
		$data = $this->data;
		if($this->cart->total() == 0 OR !isset($data['user']['id']) OR $data['user']['credit'] < $this->cart->total())
		{
			redirect("/");
			exit();
			return FALSE;
		}
		
		$cart = $this->cart->contents();
		$data['output'] = array();
		if($this->session->userdata('datru') == 0)
		{
			$data['user']['credit'] -= $this->cart->total();
				$tru = $this->cart->total();
		}
		else{
			$tru = '0';
		}
		$count = 0;
		if($this->card->trutien($data['user']['id'], $tru))
		{
			foreach($cart AS $item)
			{
				$tmp = $this->card->getCode($item['id'], $item['qty'], NULL, '0');
				$count += count($tmp);
				foreach($tmp AS &$tm)
				{
					$tm['price'] = $item['price'];
				}
				$data['output'][$item['id']] = $tmp;
				foreach($tmp AS $tm)
				{
					$this->card->gettedCode($data['user']['id'], $tm['id'], $item['price']);
					//To do: chưa ghi $orderId
				}
			}
		}
		
		
	//$this->load->library('email');

//	$this->email->from('pay123vn@gmail.com', 'Pay123.VN');
	//$this->email->to($data['user']['email']); 

	//$this->email->subject('Thông tin thẻ cào | Pay123.VN');
	//$message = $this->load->view('cart/checkout', $data, TRUE);
	//$this->email->message($message);	

	//$this->email->send();

		if($count == $this->cart->total_items())
		{
			$data['err'] = '0';
			$this->cart->destroy();
			$ss = array(
				'datru' => '0',
			) ;
			$this->session->set_userdata($ss);
		}
		else
		{
			$ss = array(
				'datru' => '1',
			) ;
			$this->session->set_userdata($ss);
			$data['err'] = '1';
		}
		$data['title'] = 'Mua thành công';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('cart/checkout', $data);
		$this->load->view('layout/footer', $data);
		
	}
	*/
	

	
	public function getIPAddress()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	public function callpay()
	{
		//Khóa toàn bộ sự thay đổi về số lượng thẻ
		$lock = array(
			'locked'  => 'locked',
		);
		$this->session->set_userdata($lock);
		
		$local_data = $this->data;
		$amount = $this->cart->total();
		if(!($amount > 0))
		{
			redirect('/');
		} 
		if( !isset($local_data['user']['id']) OR $local_data['user']['id'] <= 0)
		{
			redirect('auth/login');
		}
		
		//Giữ chỗ cho cart (hiện đang bỏ)
		$cart = $this->cart->contents();
		$giucho = array();
		$count = 0;
		
		//Lấy card
		foreach($cart AS $item)
		{
			$tmp = $this->card->getCode($item['id'], $item['qty'], NULL, '0');
			$count += count($tmp);
			foreach($tmp AS &$tm)
			{
				$tm['price'] = $item['price'];
			}
			$giucho[$item['id']] = $tmp;
		}
		
		//Giải phóng các thẻ bị giữ lâu hơn 30p;
		//24/12/2013 tạm tắt chức năng giữ chỗ
		//$this->card->unholdCode();
		
		//Kiểm tra số lượng thẻ còn, nếu hết thì chuyển sang trang cart/oos (out of stock)
		if($count < $this->cart->total_items())
		{
			redirect('/cart/oos');
		}
		//Tạo ra orderId
		$order = $this->card->getCount();
		$localDate=date('Ymdhis');
		$orderId = 30000+$order['id']+1;
		$this->card->addCount();
		
		
		//Giữ chỗ
		foreach($giucho AS $tmp)
		{
			foreach($tmp AS $tm)
			{
				//$this->card->holdCode($local_data['user']['id'], $tm['id']);
				//24/12/2013 tạm tắt chức năng giữ chỗ
			}
		}
		

		$this->load->library('vnpay/nusoap/nusoap', 'add_nusoap');
		$wsUrl= 'https://www.vnpayment.vn/merchantsvc/merchantsvc.asmx?wsdl';
		
		$client = new soapclient($wsUrl);
		$cmdCode='INITTRANS';
		$terminalCode='10006001';
		
		$currCode='VND'; 
		$paymentMethod='VNPAYMENT';
		$orderDesc='Thanh toan mua the cao tren Pay123.vn';
		$clientIp= $this->getIPAddress();
		$data="$terminalCode|$orderId|$amount|$currCode|$paymentMethod|$localDate|$orderDesc|$clientIp|";
		
		$ar = explode('|', $data);
		$this->card->saveHistory($local_data['user']['id'], $ar);
		
		
		
		$secretKey='D9256F32E6E7CDBA1E86A36426E80642';
		$signature=strtoupper(md5($data.$secretKey));
	
		
	// Call the SOAP method
		$paras = array('cmdCode'=>$cmdCode,'strData'=>$data.$signature.'|');
		
		$result = $client->Execute($paras);
		
	//OUTPUT:rspCode|message|url|signature|
		$arData=explode("|", $result->ExecuteResult);
		$rspCode= $arData[0];
		$message=$arData[1];
		$url=$arData[2];
		$signature=$arData[3];
		if($rspCode=='00')
		{
			//header("Location: $url");
			print ("<script type='text/javascript' language ='javascript' >window.location='".$url."';</script>");
		}
		else
		{
			echo "Error: $rspCode $message";	
		}
		
	}
	

	public function hideresult()
	{
		$local_data = $this->data;
		$data = '';
		$signature = FALSE;
		$sign = '';
		if(isset($_REQUEST['data']))
		{
			$data = $_REQUEST['data'];
			$this->card->saveLog(date("h-i-s").$data.'');
		}
		if(isset($_REQUEST['signature']))
		{
			$signature = $_REQUEST['signature'];
		}
		if(isset($_REQUEST['sign']))
		{
			$sign = $_REQUEST['sign'];
		}
		
		$signature = $signature ? $signature : $sign;
		$ar = explode('|', $data);


		if($ar[0] != '')
		{
			//00|10006001|PAY123131|19400|VND|522970|DONGABANK|20131220172847|Finnish
			$terminalCode='10006001';
			$orderId = $ar[2];
			$amount = $ar[3];
			$currCode = $ar[4];
			$localDate = $ar[7];
			
			
			$rspCode = '01';
			$orderDesc='Thanh toan don hang mua the dt: '.$orderId;
			
			if($cart_saved = $this->card->getHistory($ar[2]))
			{
			$now = strtotime("now");
			//Kiểm tra đơn hàng có bị quá thời gian hay không.
			if($now > $cart_saved['log_time']+30*60)
			{
				$rspCode = '02';
			}
			else
			{
				$rspCode = '97';
				
				//Xử lý riêng cho ngân hàng Đông Á
				if ($ar[6]=='DONGABANK' && ($ar[0]=='00' || $ar[0]=='03' ) )
				{
					//Gọi thư viện
					$this->load->library('vnpay/nusoap/nusoap', 'add_nusoap');
					$wsUrl= 'https://www.vnpayment.vn/merchantsvc/merchantsvc.asmx?wsdl';
					$client = new soapclient($wsUrl);
					// Call the SOAP method
					
					//Thành lập chữ kí
					//terminalCode|orderId|amount|localDate|orderDesc|signature|
					$isign = strtoupper(MD5(''.$terminalCode.'|'.$orderId.'|'.$amount.'|'.$localDate.'|'.$orderDesc.'|D9256F32E6E7CDBA1E86A36426E80642'));
					$send = ''.$terminalCode.'|'.$orderId.'|'.$amount.'|'.$localDate.'|'.$orderDesc.'|'.$isign.'|';
					$this->card->saveLog('Gui-DongA-'.$send.'');
					$paras = array('cmdCode'=>'DELIVERED','strData'=>$send);
				
					$result = $client->Execute($paras);		
					
					//Dữ liệu nhận về
					$res = $result->ExecuteResult;
					
					//Ghi log
					$this->card->saveLog('DongA-'.$res.'');
					
					//Kiểm tra dữ liệu nhận về
					$arData=explode("|", $res);
					
					//Nếu thành công, DONG A trả về 00
					if($arData[0] = '00')
					{
						$rspCode = '00';
						
					}
				}
				
				if(!$ar[6]=='DONGABANK' AND $ar[0]=='00' AND $cart_saved['amount'] == $ar['3'])
				{
					$rspCode = '00';
				}				
			}
			}
			
			$this->card->updateHistory($orderId, $ar);
			switch ($rspCode) {
						case "00":
							$message = 'Thành công';
							break;
						case "01":
							$message = 'Không tìm thấy GD';
							break;
						case "02":
							$message = 'Giao dịch đã được confirm';
							break;
						case "08":
							$message = 'Hệ thống bảo trì hoặc kết nối webservices bị timeout';
							break;
						case "97":
							$message = 'Chữ ký không hợp lệ';
							break;
						case "99":
							$message = 'Lỗi hệ thống khác';
							break;

					}
					
			$isign = strtoupper(MD5(''.$rspCode.'|'.$message.'|'.$terminalCode.'|'.$orderId.'|'.$localDate.'|D9256F32E6E7CDBA1E86A36426E80642'));
			$strOutput  = ''.$rspCode.'|'.$message.'|'.$terminalCode.'|'.$orderId.'|'.$localDate.'|'.$isign.'|';
			$this->card->saveLog($strOutput);
			echo $strOutput;
		}
	}

	
	public function success()
	{
		$data = $this->data;
		$rspCode = '02';
		$success = 'nghingo';
		if(isset($_GET['rspCode']))
		{
			if(isset($_GET['data']) AND $_GET['data'] != '')
			{
				$getted_data = strtoupper($_GET['data']);
				
				//get['data'] có thể chỉ gồm mã đơn hàng hoặc gồm cả một dãy dài, http://pay123.vn/cart/success?rspCode=00&data=00%7c10006001%7cPAY123127%7c9700%7cVND%7c522750%7cDONGABANK%7c20131220151007%7cFinish&sign=
				$explode = explode("|", $getted_data);
				$rspCode = '05';
			
				//Nếu tồn tại đơn hàng đúng với link
				if($cart_saved = $this->card->getHistory($getted_data) OR $cart_saved = $this->card->getHistory($explode[2]))
				{
					//Phát hiện gian lận (lấy thẻ 1 lần sau đó quay trở lại link cũ, lúc này coi như đã hoàn thành lần mua 2, các thuộc tính hoàn toàn đúng nhưng lại chưa trả tiền cho lần 2 :D)
					$hack = $this->card->getcardByOrderId($cart_saved['orderId']);
					if(isset($hack['0']))
					{
						redirect('/');
						exit();
						return FALSE;
					}
					
				//Nếu đơn hàng chính xác
					if($data['user']['id'] == $cart_saved['user_id'])
					{
						$rspCode = '00';
						$cart = $this->cart->contents();
						$data['output'] = array();
						$count = 0;
						foreach($cart AS $item)
						{
							$data['output'][$item['id']] = array();

							$tmp = $this->card->getCode($item['id'], $item['qty'], NULL, '0');

							$count += count($tmp);
							foreach($tmp AS &$tm)
							{
								$tm['price'] = $item['price'];
							}
							
							 $data['output'][$item['id']]= $tmp;

							//Ghi card đã đc sử dụng
							foreach($tmp AS $tmt)
							{
								$this->card->gettedCode($data['user']['id'], $tmt['id'], $item['price'], $cart_saved['orderId']);
							}
						}
					}
					
					//Gửi tin nhắn
					$this->load->library('vnpay/nusoap/nusoap', 'nusoap');
					$MTusername="ibo";
					$MTpassword="i1b2o33o2b1iibo";
					$serviceId="8741"; 
					$requestId="1";
					$contentType="0";  
					$commandCode="SV";
					$phone = $data['user']['email'];
					if(substr($phone, 0, 1) == '0')
					{
						$phone = substr($phone, 1);
						$phone = '84'.$phone.'';
					}
					$message = 'Ban da mua the thanh cong tren www.pay123.vn. Cam on ban da su dung dich vu. Chuc ban vui ve!';
					$mt = new soapclient('http://8x41.com/ws8x41/SendMTReceiver/index.php?wsdl');
					$params=array('userId'=>$phone,'message'=>$message,'serviceId'=>$serviceId,'commandCode'=>$commandCode,'requestId'=>$requestId,'contentType'=>$contentType,'MTusername'=>$MTusername,'MTpassword'=>$MTpassword);
					$result=$mt->__call('sendMT', $params);
				} 
			}
			switch ($rspCode) {
			case "00":
				//print("Giao dịch thành công");
				$success = 'thanhcong';
				break;
			case "01":
				//print ("Giao dịch đang được thực hiện");
				$success = 'dangthuchien';
				break;
			case "02":
				//print ("Giao dịch đang bị lỗi");
				$success = 'loi';
				break;  
			case "03":
				//print ("Giao dịch đang bị đảo");
				$success = 'dao';
				break;
			case "04":
				//print ("Giao dịch đã được hoàn tiền");
				$success = 'hoantien';
				break;
			case "05":
				//print ("Giao dịch bị nghi ngờ");
				$success = 'nghingo';
				break;
			case "20":
				//print ("Giao dịch đã được đối chiếu");
				$success = 'doichieu';
				break;
			}
		}
		$this->cart->destroy();
		//Bỏ khóa toàn bộ sự thay đổi về số lượng thẻ
		$lock = array(
			'locked'  => 'unlocked',
		);
		$this->session->set_userdata($lock);
		
		$data['success'] = $success;
		$data['title'] = 'Thông tin giao dịch';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('cart/success', $data);
		$this->load->view('layout/footer', $data);
		
	}
	

	
	public function troy()
	{
		//Bỏ khóa toàn bộ sự thay đổi về số lượng thẻ
		$lock = array(
			'locked'  => 'unlocked',
		);
		$this->session->set_userdata($lock);
		$this->cart->destroy();
		redirect("/");
	}
	

	public function callback()
	{
		$lock = $this->session->userdata('locked');
		if($lock == 'locked')
		{
			echo '<script>alert("Bạn chưa thanh toán xong giao dịch trước đó. Hãy vào giỏ hàng xóa hết các thẻ để bắt đầu lại."); window.location.assign("'.$this->config->base_url().'cart")</script>';	
			exit();
		}
		$this->form_validation->set_rules('id', 'ID', 'trim|xss_clean');
		$this->form_validation->set_rules('action', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules($this->security->get_csrf_token_name(), 'TOKEN', 'trim|required|xss_clean');
		$this->form_validation->run();
		$all_cart = (array)json_decode($this->menhgia->giathe('all'));
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			if(isset($all_cart[$id]))
			{
				if(isset($_POST['action']) AND $_POST['action'] == 'add')
				{

					$qty = 1;
					foreach ($this->cart->contents() as $items)
					{
						if($items['id'] == $id)
						{
							$qty = $items['qty']+1;
							$update['rowid'] = $items['rowid'];
							$update['qty'] = $qty;
						}
					}
					$data = array(
					   'id'      => $id,
					   'qty' => $qty,
					   'price'     => $all_cart[$id],
					   'name'    => ucfirst($id),
					   'options' => array()
					);
					if($qty == 1)
					{
						$this->cart->insert($data);
					} elseif($qty > 3) {
						echo '<script>alert("Số thẻ tối đa mỗi loại là 3")</script>';						
					} else {
						$this->cart->update($update);
					}
				}
			}
		}
		$this->load->view('layout/cart');
	}
	
	public function callbackdetail()
	{
		$lock = $this->session->userdata('lock');
		if($lock == 'locked')
		{
			echo '<script>alert("Bạn chưa thanh toán xong giao dịch trước đó. Hãy vào giỏ hàng xóa hết các thẻ để bắt đầu lại."); window.location.assign("'.$this->config->base_url().'cart")</script>';	
			exit();
		}
		
		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules($this->security->get_csrf_token_name(), 'TOKEN', 'trim|required|xss_clean');
		$this->form_validation->run();
		if($this->cart->total_items() <1)
		{
			echo '<div class="col-md-9 g-home" role="main">';
			echo 'Vui lòng tải lại trang';
			echo '</div>';
			exit();
			return FALSE;
		}
		$all_cart = (array) json_decode($this->menhgia->giathe('all'));
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			if(isset($_POST['action'])){$action = $_POST['action'];}
			if(isset($_POST['numbers'])){$numbers = $_POST['numbers'];}
			if(isset($all_cart[$id]))
			{
				foreach ($this->cart->contents() as $items)
				{
					if($items['id'] === $id)
					{
						if($action =='remove')
						{
							$qty = 0;
						}
						if($action =='numbers')
						{
							$qty = $numbers;
						}
						$update['rowid'] = $items['rowid'];
						$update['qty'] = $qty;
					}
				}
				$this->cart->update($update);
			}
		$data = $this->data;
		$data['cart'] = $this->cart->contents();
		$this->load->view('cart/main', $data);
		} 
		else{
			echo 'Loại thẻ thêm vào là không hợp lệ';
		}
	}
	
	public function oos()
	{
		//Bỏ khóa toàn bộ sự thay đổi về số lượng thẻ
		$lock = array(
			'locked'  => 'unlocked',
		);
		$this->session->set_userdata($lock);
		$data = $this->data;
		$data['title'] = 'Hết thẻ';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('cart/oos', $data);
		$this->load->view('layout/footer', $data);
	}
}
