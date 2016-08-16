<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menhgia
{
/**
*Mệnh giá của thẻ nạp và các loại thẻ ược ghi tại ây
*$loai với các giá trị là tatca, mobile, game, viettel, vina, mobi
*Tất cả là lấy ngẫu nhiên trong tất cả thẻ, mobile là chỉ lấy thẻ điện thoại, game là chỉ lấy thẻ game, viettel, vina, mobi...là chỉ lấy loại thẻ của mạng ấy
*$soluong là số lượng cần lấy (sắp xếp theo thứ tự từ bé đến lớn)
*Nếu không có giá trị nào thì: mặc định là lấy ngẫu loại thẻ bất kì và tối đa 8 thẻ.
*Số lượng lấy ngẫu nhiên chỉ áp dụng cho $loai = mobile hoặc game
*/
	public function giathe($loai = 'random', $soluong = 8)
	{
		$viettel = array(
			'viettel10' => '9660',
			'viettel20' => '19320',
			'viettel30' => '28980',
			'viettel50' => '48300',
			'viettel100' => '96600',
			'viettel200' => '193200',
			'viettel300' => '291000',
			'viettel500' => '483000'
			);
		$vina = array(
			'vina10' => '9660',
			'vina20' => '19320',
			'vina30' => '28980',
			'vina50' => '48300',
			'vina100' => '96600',
			'vina200' => '193200',
			'vina300' => '291000',
			'vina500' => '483000'
			);
			
		$mobi = array(
			'mobi10' => '9660',
			'mobi20' => '19320',
			'mobi30' => '28980',
			'mobi50' => '48300',
			'mobi100' => '96600',
			'mobi200' => '193200',
			'mobi300' => '291000',
			'mobi500' => '483000'
			);
			
		$gate = array(
			'gate20' => '19320',
			'gate50' => '48300',
			'gate90' => '87300',
			'gate100' => '96600',
			'gate200' => '193200'
			);
			
		$vcoin = array(
			'vcoin20' => '19320',
			'vcoin50' => '48300',
			'vcoin100' => '96600',
			);
			
		$zing = array(
			'zing20' => '19320',
			'zing60' => '58200',
			'zing120' => '116400',
			);
			
		$oncash = array(
			'oncash20' => '19320',
			'oncash60' => '58200',
			'oncash100' => '96600',
			'oncash200' => '193200', 
			);
		$vgold = array(
			'vgold20' => '19320',
			'vgold50' => '48300',
			'vgold100' => '96600',
			);
		
		$rand_mobile = array();
		$mobile = $viettel + $vina + $mobi;
		$rand_key = array_rand($mobile, $soluong);
		foreach($rand_key AS $rd)
		{
			$rand_mobile += array($rd => $mobile[$rd]);
		}
		$rand_game = array();
		$game = $gate + $vcoin + $zing + $oncash + $vgold;
		$rand_key2 = array_rand($game, 4); 
		foreach($rand_key2 AS $rd2)
		{
			$rand_game += array($rd2 => $game[$rd2]);
		}
		
		if($loai == 'viettel')
		{
			return json_encode($viettel);
		}
		if($loai == 'vina')
		{
			return json_encode($vina);
		}
		if($loai == 'mobi')
		{
			return json_encode($mobi);
		}
		
		if($loai == 'game')
		{
			return json_encode($rand_game);
		}
		
		if($loai == 'mobile')
		{
			return json_encode($rand_mobile);
		}
		
		
		if($loai == 'gate')
		{
			return json_encode($gate);
		}
		if($loai == 'vcoin')
		{
			return json_encode($vcoin);
		}
		if($loai == 'zing')
		{
			return json_encode($zing);
		}
		if($loai == 'oncash')
		{
			return json_encode($oncash);
		}
		if($loai == 'vgold')
		{
			return json_encode($vgold);
		}
		
		$all = $game + $mobile;
		if($loai == 'all')
		{
			return json_encode($all);
		}		
	}
	
}