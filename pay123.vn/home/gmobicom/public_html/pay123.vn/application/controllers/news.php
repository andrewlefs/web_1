<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('News_model', 'news');
	}
	
	public function index()
	{
		$data = $this->data;
		$categories = $this->news->get_all_category('1');
		$data += array(
			'title'	=> 'Danh mục bài viết',
			'categories' => $categories,
		);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		echo '<div class="col-md-9 g-home" role="main">';
		$this->load->view('news/main', $data);
		echo '</div>';
		$this->load->view('layout/footer', $data);
	}
	
	public function category($link ='', $category_id = '')
	{
		$data = $this->data;
		if(!$category = $this->news->get_category_by_id($category_id))
		{
			redirect('news');
		}
		elseif($link == '')
		{
			
			redirect('news/'.$this->news->friendly_url($category['title']).'-'.$category_id.'');
		}
		else
		{
			$posts = $this->news->get_all_post($category_id);
			$data += array(
				'category_selecting' => $category_id, 
				'title'	=> $category['title'],
				'posts' => $posts,
			);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		echo '<div class="col-md-9 g-home" role="main">';
		$this->load->view('news/category', $data);
		echo '</div>';
		$this->load->view('layout/footer', $data);
		}
	}
	
	public function post($link ='', $id)
	{
		$data = $this->data;
		if(!$post = $this->news->get_post_by_id($id))
		{
			redirect('news');
		}
		elseif ($link == '')
		{
			redirect('post/'.$this->news->friendly_url($post['title']).'-'.$id.'');
		}
		else
		{
			$data['title'] = $post['title'];
			$data['post'] = $post;
			$data['category_selecting'] = $post['category_id'];
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar', $data);
			echo '<div class="col-md-9 g-home" role="main">';
			$this->load->view('news/post', $data);
			echo '</div>';
			$this->load->view('layout/footer', $data);
		}
	}
}