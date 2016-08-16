<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{    
    function __construct ()
    {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->lang->load('title');
		$this->lang->load('menu');
		$this->lang->load('card');
		$this->lang->load('shop');
		$user = (array)$this->tank_auth->get_credit($this->tank_auth->get_user_id());
		if(isset($user['credit']))
		{
			$user['credit'] = cold($user['credit']);
		}
		$this->data = array(
			'user' => $user,
			'user_id' => $this->tank_auth->get_user_id(),
			'username' => $this->tank_auth->get_username(),
			'menu_home' => $this->lang->line('menu_home'),
			'menu_hoadon' => $this->lang->line('menu_hoadon'),
			'menu_quatang' => $this->lang->line('menu_quatang'),
			'menu_taikhoan' => $this->lang->line('menu_taikhoan'),
			'menu_tintuc' => $this->lang->line('menu_tintuc'),
			'menu_dangki' => $this->lang->line('menu_dangki'),
			'menu_dangnhap' => $this->lang->line('menu_dangnhap'),
			'menu_quenpass' => $this->lang->line('menu_quenpass'),
            'card_mobile' => $this->lang->line('card_mobile'),
            'card_mobile1' => $this->lang->line('card_mobile1'),
            'card_mobile2' => $this->lang->line('card_mobile2'),
            'card_mobile3' => $this->lang->line('card_mobile3'),
            'card_game' => $this->lang->line('card_game'),
            'card_game1' => $this->lang->line('card_game1'),
            'card_game2' => $this->lang->line('card_game2'),
            'card_game3' => $this->lang->line('card_game3'),
            'card_game4' => $this->lang->line('card_game4'),
            'card_game5' => $this->lang->line('card_game5'),
			'shop_gio' => $this->lang->line('shop_gio'),
			'shop_thanhtoan' => $this->lang->line('shop_thanhtoan'),
			'shop_rong' => $this->lang->line('shop_rong'),
		);
	}
	
	
}