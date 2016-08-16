<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends CI_Model
{
	function __construct()    
	{      
		parent::__construct();	  
		$this->load->database();
	}
	
	function thongke($time=0,$loai='all',$order='doanhthu')
	{
		if($order =='')
		{
			$order = 'doanhthu';
		}
		if($time > 0)
		{
			$cutoff = strtotime("now") - $time * 24*60*60;
		}
		else
		{
			$cutoff = 0;
		}

		if($loai == 'all')
		{
			$query = $this->db->query('
				SELECT * , COUNT(id) AS count, COUNT(id) * `gia` AS doanhthu
				FROM  `cart` WHERE `ngayxuat` > '.$cutoff.'
				GROUP BY `loai` 
				ORDER BY '.$order.' DESC 
			');
		}
		else
		{
			$query = $this->db->query("
				SELECT * , COUNT(id) AS count, COUNT(id) * `gia` AS doanhthu
				FROM  `cart` 
				WHERE `ngayxuat` > ".$cutoff."
				AND  `loai` LIKE '%".$this->db->escape_like_str($loai)."%'
				GROUP BY `loai`
				ORDER BY ".$order." DESC 
			");
		}
		return $query->result_array();
	}
	
	function thanhvien($order = 'id', $active ='1')
	{
		$query = $this->db->query("
				SELECT * 
				FROM  `users` 
				WHERE active = ".$active."
				ORDER BY ".$order." DESC 
			");
		return $query->result_array();
	}
	
}
