<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model
{
	function __construct()
    {
      // Call the Model constructor
      parent::__construct();
      $this->load->database();
    }
	
	public function friendly_url($title)
	{		
		$aPattern = array (
            "a" => "á|à|ạ|ả|ã|ă|ắ|ằ|ặ|ẳ|ẵ|â|ấ|ầ|ậ|ẩ|ẫ|Á|À|Ạ|Ả|Ã|Ă|Ắ|Ằ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ",
            "o" => "ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ|Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ộ|Ổ|Ỗ|Ơ|Ớ|Ờ|Ợ|Ở|Ỡ",
            "e" => "é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ|É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ệ|Ể|Ễ",
            "u" => "ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ|Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ự|Ử|Ữ",
            "i" => "í|ì|ị|ỉ|ĩ|Í|Ì|Ị|Ỉ|Ĩ",
            "y" => "ý|ỳ|ỵ|ỷ|ỹ|Ý|Ỳ|Ỵ|Ỷ|Ỹ",
            "d" => "đ|Đ",
        );
        while(list($key,$value) = each($aPattern))
        {
            $title = @ereg_replace($value, $key, $title);
        }
		
		$title = strtr(
			$title,
			'`!"$%^&*()-+={}[]<>;:@#~,./?|' . "\r\n\t\\",
			'                             ' . '    '
		);
		$title = strtr($title, array('"' => '', "'" => ''));
		$title = preg_replace('/[^a-zA-Z0-9_ -]/', '', $title);

		$title = preg_replace('/[ ]+/', '-', trim($title));
		$title = strtr($title, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');
		return $title;
	}
	
	public function get_all_category($active = NULL)
	{
		if (isset($active))
		{
			$this->db->where('active', $active);
		}
		$query = $this->db->get('news_category');
		return $query->result_array();
	}
	
	public function get_category_by_id($category_id)
	{
		$this->db->where('id', $category_id);
		$query = $this->db->get('news_category');
		return $query->row_array();
	}
	
	public function get_all_post($category_id = NULL, $limit = NULL)
	{
		if (isset($category_id))
		{
			$this->db->where('category_id', $category_id);
		}
		if (isset($limit))
		{
			$this->db->limit($limit, 0);
		}
		
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get('news');
		return $query->result_array();
	}
	
	public function get_post_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('news');
		return $query->row_array();
	}
	
	public function post_save($id, $title, $category_id, $image, $description, $content)
	{
		if (isset($id))
		{
			$data = array('title' => $title, 'category_id' => $category_id, 'image' => $image, 'description' => $description , 'content' => $content);
			$where = "id = ".$id.""; 
			$str = $this->db->update_string('news', $data, $where);
			$this->db->query($str);
			return $this->db->affected_rows();
		}
		else
		{
			$data = array('title' => $title, 'category_id' => $category_id, 'image' => $image, 'description' => $description , 'content' => $content);
			$str = $this->db->insert_string('news', $data);
			$this->db->query($str);
			return $this->db->insert_id();
		}
	}
	
	public function category_save($id, $short_title, $title, $active, $description)
	{
		if (isset($id))
		{
			$data = array('short_title' => $short_title, 'title' => $title, 'active' => $active, 'description' => $description);
			$where = "id = ".$id.""; 
			$str = $this->db->update_string('news_category', $data, $where);
			$this->db->query($str);
			return $id;
		}
		else
		{
			$data = array('short_title' => $short_title, 'title' => $title, 'active' => $active, 'description' => $description);
			$str = $this->db->insert_string('news_category', $data);
			$this->db->query($str);
			return $this->db->insert_id();
		}
	}
	
	public function category_change_active($id, $active)
	{
			$data = array('active' => $active);
			$where = "id = ".$id.""; 
			$str = $this->db->update_string('news_category', $data, $where);
			$this->db->query($str);
			return $this->db->affected_rows();
	}
	
	public function post_delete($id)
	{
		if($id != 5)
		{
			$this->db->query("DELETE FROM `news` WHERE `id` = ".$id."");
		}
		return true;
	}
	
	public function category_delete($id)
	{
		if($id != 5)
		{
			$posts = $this->get_all_post($id);
			foreach($posts AS $post)
			{
				$this->db->query("UPDATE  `news` SET  `category_id` =  '5' WHERE  `id` = ".$post['id']." ");
			}
			$this->db->query("DELETE FROM `news_category` WHERE `id` = ".$id."");
			return true;
		}
		return FALSE;
	}
}