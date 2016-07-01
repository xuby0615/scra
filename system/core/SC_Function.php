<?php
/*
 * 控制器公用函数
 */

/*
 * 验证邮箱格式是否正确
 * param $mail string 邮箱
 * return boolean
 */
function vali_mail($mail){
	$vali_type = '/^.+@[a-zA-Z0-9\-]+\..+$/';
	return preg_match($vali_type,$mail)?true:false;
}

/*
 * 验证手机号
 * param $phone string 手机号
 * return boolean
 */
function vali_phone($phone){
	$vali_type = '/^1[3|5|7|8][0-9]{9}$/';
	return preg_match($vali_type,$phone)?true:false;
}

/*
 * 获取当前IP
 */
function get_ip(){
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}elseif (isset($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	if(check_ip($ip)){
		return $ip;
	}else{
		return '0.0.0.0';
	}
}

/*
 * 验证IP
 */
function check_ip($ip){
	$oct = explode('.', $ip);
	if (count($oct) != 4) {
		return false;
	}
	for ($i = 0; $i < 4; $i++) {
		if (!is_numeric($oct[$i])) {
			return false;
		}
		if ($oct[$i] < 0 || $oct[$i] > 255){
			return false;
		}
	}
	return true;
}

