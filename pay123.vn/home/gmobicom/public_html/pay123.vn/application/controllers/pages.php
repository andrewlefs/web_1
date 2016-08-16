<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author: Starvnnet
 * Static Pages controller
 */
class Pages extends MY_Controller {

  public function index($page = 'home')
  {
    if(!file_exists('application/views/pages/'.$page.'.php'))
    {
      show_404();
    }

		$data = $this->data;
		$viettel = json_decode($this->menhgia->giathe('viettel'));
		$vina = json_decode($this->menhgia->giathe('vina'));
		$mobi = json_decode($this->menhgia->giathe('mobi'));
		
		$vcoin = json_decode($this->menhgia->giathe('vcoin'));
		$zing = json_decode($this->menhgia->giathe('zing'));
		$oncash = json_decode($this->menhgia->giathe('oncash'));
		$vgold = json_decode($this->menhgia->giathe('vgold'));
		$gate = json_decode($this->menhgia->giathe('gate'));
		
		$rand_cards = json_decode($this->menhgia->giathe('mobile'));
		$rand_games = json_decode($this->menhgia->giathe('game'));
		$i = 0;
		if($page == 'home')
		{
			$data += array( 
				'title' => $this->lang->line('title_home'),
				'viettel' => $viettel,
				'vina' => $vina,
				'mobi' => $mobi,
				
				'vcoin' => $vcoin,
				'zing' => $zing,
				'oncash' => $oncash,
				'vgold' => $vgold,
				'gate' => $gate,
				
				'rand_cards' => $rand_cards,
				'rand_games' => $rand_games,
			);
		}
		else
		{
			$data += array(
			 'title' => ucfirst($page) . ' - Pay123.Vn - Mua thẻ điện thoại - Mua thẻ game trực tuyến',
			);
		}
	
    $this->load->view('layout/header', $data);
	$this->load->view('layout/sidebar', $data);
	$this->load->view('pages/'.$page.'');
    $this->load->view('layout/footer', $data);
  }
}