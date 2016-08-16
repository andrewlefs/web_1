<?php
function water($text)
{
	$return = '';
	$text = substr($text, 0, -3);
	$re = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', 'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','v','x','y','z');
	$ra = array(')%!!%)','#%$#$#','%*%*%&','%%^^&&','**!!##','!%&%@$','^$^##$','^@^##$','*$!%$@','&!%$%&','120834','105892','107635','117685','102343','121266','108807','116515','102865','107973','107348','109246','980905','105148','113598','123266','111742','104256','118955','112678','116143','119483','105983','114462','122245','101434', '120834','105892','107635','117685','102343','121266','108807','116515','102865','107973','107348','109246','980905','105148','113598','123266','111742','104256','118955','112678','116143','119483','105983','114462','122245','101434');
	while(strlen($text) > 0)
	{
		$temp = substr($text, 0, 6);
		$text = substr($text, 6);
		$return .= str_replace($ra, $re, $temp);
	} 
	$return = strtoupper($return);
	return $return;
}

mysql_connect('localhost','gmobicom_sv','2525132519896');
mysql_select_db('gmobicom_pay123');
$result=mysql_query('select `id`,`loai`,`seri`,`ma` from `cart` where  user_id=""');
echo '<table>';
while($row=mysql_fetch_assoc($result){
	echo '<tr>';
	echo '<td>'.$row['id'].'</td><td>'.$row['loai']..'</td><td>'.water($row['seri']).'</td><td>'.water($row['ma']).'</td>';
	echo '</tr>';
}
echo '</table>';
?>