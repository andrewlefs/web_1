<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Card_model extends CI_Model
{
	function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

	//cái function này hơi buồn cười, gần giống getCode, xóa có 1 dòng
	//Mệt quá rồi, viết thêm 1 function cho đỡ đau đầu
	function getCodeHistory($loai, $soluong, $user_id, $limit = '0')
	{
		if($loai != NULL)
		{
			$this->db->where('loai', $loai);
		}
		$this->db->where('user_id', $user_id);
		//$this->db->where('user_id_hold' , $user_id);
		if($soluong != NULL)
		{
			$this->db->limit($soluong, $limit);
		}
		if($user_id != NULL)
		{
			$this->db->order_by('ngayxuat','DESC');
		}
		$query = $this->db->get('cart');
		return $query->result_array();
	}
	
	function getCode($loai, $soluong, $user_id, $limit = '0')
	{
		if($loai != NULL)
		{
			$this->db->where('loai', $loai);
		}
		$this->db->where('user_id', $user_id);
		//$this->db->where('user_id_hold' , $user_id);
		//24/12/2013 tạm tắt chức năng giữ chỗ
		if($soluong != NULL)
		{
			$this->db->limit($soluong, $limit);
		}
		if($user_id != NULL)
		{
			$this->db->order_by('ngayxuat','DESC');
		}
		$query = $this->db->get('cart');
		return $query->result_array();
	}
	
	function searchCode($user_id, $seri = NULL, $ma = NULL)
	{
		
		if($user_id != NULL)
		{
			$this->db->where('user_id', $user_id);
			$this->db->order_by('ngayxuat','DESC');
		}
		if($seri != NULL)
		{
			$this->db->like('seri', $seri,'after');  
		}
		if($ma != NULL)
		{
			$this->db->like('ma', $ma,'after');
		}
		
		// Neu xoa list_card2 thi xoa /* va */ o dong 71 va 82 va 4 dong tu 85 den 89
		/*
		if($user_id == NULL AND $seri == NULL AND $ma == NULL)
		{ 
			return array();
		} else
		{
			$this->db->select('cart.*, users.username');
			$this->db->join('users', 'users.id = cart.user_id', 'left');
			$query = $this->db->get('cart');
			return $query->result_array();
		}
		*/
		
		// Neu xoa list_card2 thi xoa luon 4 dong ben duoi
		$this->db->select('cart.*, users.username');
		$this->db->join('users', 'users.id = cart.user_id', 'left');
		$this->db->order_by('ma desc, id desc'); 
		$query = $this->db->get('cart'); 
		return $query->result_array();
	}
	public function timma($ma)
	{
		
		$this->db->like('ma', $ma, 'after'); 
		$query = $this->db->get('cart'); 
		return $query->result_array();
	}
	public function insert($loai, $seri, $ma)
	{
		$ngaynhap = strtotime("now");
		$this->db->query("INSERT INTO  `cart` (`loai` ,`seri` ,`ma`, `ngaynhap` ) VALUES ( '$loai',  '$seri',  '$ma', '$ngaynhap')");
	}
	
	//Ghi thẻ đã bị lấy bởi ai
	function gettedCode($user_id, $id, $price, $orderId)
	{
		$data = array(
               'user_id' => $user_id,
			   'ngayxuat' => strtotime("now"),
			   'gia' => $price,
			   'orderId' => $orderId,
            );
		$this->db->where('id', $id);
		$this->db->update('cart', $data);  
	}
	
	//Ghi thẻ tạm thời đc mua bởi ai (chưa có kết quả thanh toán)
	function holdCode($user_id, $id)
	{
		$now  = strtotime("now");
		$data = array(
               'user_id_hold' => $user_id,
			   'time_hold' => $now,
            );
		$this->db->where('id', $id);
		$this->db->update('cart', $data);  
	}
	
	//Đưa thẻ về trạng thái tự do nếu thẻ bị giữ quá 30 phút
	function unholdCode()
	{
		$now  = strtotime("now");
		$time_unhold = $now - 30 * 60;
		//30 phút nhân 60s
		
		$data = array(
               'user_id_hold' => 0,
			   'time_hold' => 0,
            );
		
		$this->db->where('user_id', NULL);
		$this->db->where('user_id_hold >', 0);
		$this->db->where('time_hold <=', $time_unhold);
		$this->db->update('cart', $data);  
	}
	
	function trutien($user_id, $price) 
	{
		$this->db->where('id', $user_id);
		$query = $this->db->get('users');
		$row = $query->row(); 
		$credit = $row->credit;
		$credit = cold($credit);
		if($credit <= $price)
		{
			return FALSE;
		}
		$data = array(
               'credit' => hot($credit-$price),
            );
		$this->db->where('id', $user_id);
		$this->db->update('users', $data); 
		return TRUE;
	}
	
	public function saveHistory($user_id, $data)
	{
		if($data[0] == '')
		{
			return FALSE;
		}
		else
		{
			$time = strtotime("now");
			$this->db->query ("INSERT INTO `history` (`user_id`, `rspCode`, `orderId`,  `amount`, `currCode`, `vnpTranId`, `paymentMethod`, `payDate`, `orderDesc`, `clientIp`, `additional_info`,`log_time`) 
			VALUES ('".$user_id."', '', '".$data['1']."', '".$data['2']."',  '".$data['3']."', '',  '".$data['4']."', '".$data['5']."', '".$data['6']."',  '".$data['7']."', '', ' ".$time." ' )");
		}
	}
	
	public function updateHistory($orderId, $data)
	{
		if($data[0] == '')
		{
			return FALSE;
		}
		else
		{
			$this->db->query ("UPDATE `history` SET `rspCode` =  '".$data['0']."', `vnpTranId` =  '".$data['5']."', `additional_info` = '".$data['8']."' WHERE `id` = '".$orderId."' ");
		}
	} 
	
	public function saveLog($content) 
	{
			$time = strtotime("now");
			$this->db->query (" INSERT INTO `log` (`time`, `content`) 
			VALUES (' ".$time." ',' ".$content." ')");
	}
	
	public function getHistory($orderId)
	{
			$query = $this->db->query ("SELECT * FROM  `history` WHERE orderId = '$orderId'");
			return $query->row_array();
			return FALSE;
	}
	

	public function getcardByOrderId($orderId)
	{
		$query = $this->db->query ("SELECT * FROM  `cart` WHERE orderId = '$orderId'");
		return $query->result_array();
	}
	public function getCount()
	{
		$query = $this->db->query ("SELECT * FROM  `cart_count` ORDER BY id DESC  LIMIT 0 , 1 ");
		return $query->row_array();
	}
	
	public function getCountByLoai()
	{
		$query = $this->db->query ("SELECT *, count(id) AS `soluong` FROM `cart` WHERE `ngayxuat` IS NULL GROUP BY `loai` ");
		return $query->result_array();
	}
	
	public function addCount()
	{
		$time = strtotime("now");
		$this->db->query ("INSERT INTO `cart_count` (`time`) VALUES ('$time')");
	}
}