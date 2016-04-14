<?php
/*
 * Captcha
 */
Class Captcha{
	
	//随机因子
	private static $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
	
	//存储最多数量的验证码
	private static $max_captcha = 200;
		 
    protected   $code;       //验证码  
    protected   $codelen;    //验证码长度  
    protected   $width;      //宽度  
    protected   $height;     //高度  
    protected   $img;        //图形资源句柄  
    protected   $font;       //指定的字体  
    protected   $fontsize;   //指定字体大小  
    protected   $fontcolor;  //指定字体颜色 
    protected 	$url;		 //验证码路径
  
    //构造方法初始化  
    function __construct($config) {
        extract($config);
        $this->codelen = (!empty($codelen))?$codelen:4;
        $this->width = (!empty($width))?$width:130;
        $this->height = (!empty($height))?$height:50;
        $this->fontsize = (!empty($fontsize))?$fontsize:20;
        $this->font = dirname(__FILE__).'\..\..\statics\font\elephant.ttf';  
    }
  
    //生成背景  
    private function createBg() {  
        $this->img = imagecreatetruecolor($this->width, $this->height);  
        $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));  
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);  
    }  
    
    //生成随机码
    private function createCode() {
    	$_len = strlen(self::$charset)-1;
    	for ($i=0;$i<$this->codelen;$i++) {
    		$this->code .= self::$charset[mt_rand(0,$_len)];
    	}
    }
  
    //生成文字  
    private function createFont() {      
        $_x = $this->width / $this->codelen;
        for ($i=0;$i<$this->codelen;$i++) {  
            $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);  
        }  
    }  
  
    //生成线条、雪花  
    private function createLine() {  
        for ($i=0;$i<6;$i++) {  
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));  
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);  
        }  
        for ($i=0;$i<100;$i++) {  
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));  
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);  
        }  
    }  
  
    //生成图片信息
    private function outPut() {
    	$captcha_temp = APP_PATH.'cache/captcha';
    	if (!file_exists($captcha_temp)){
    		mkdir($captcha_temp,0777);
    	}
    	$captcha_num = count(glob(APP_PATH.'cache/captcha/*.*'));
    	if ($captcha_num > self::$max_captcha){
    		$this->delCaptcha($captcha_temp);
    	}
    	$url_temp = $captcha_temp.'/'.$this->code.'.png';
        imagepng($this->img,$url_temp);
        imagedestroy($this->img);
        $this->url = $url_temp;
    } 
    
    //删除超过指定存储数量的验证码
    private function delCaptcha($dir){
    	//先删除目录下的文件：
    	$dh=opendir($dir);
    	while ($file=readdir($dh)) {
    		if($file!="." && $file!="..") {
    			$fullpath=$dir."/".$file;
    			if(!is_dir($fullpath)) {
    				unlink($fullpath);
    			} else {
    				$this->delCaptcha($fullpath);
    			}
    		}
    	}
    	closedir($dh);
    }
  
    //对外生成  
    public function doimg() {  
        $this->createBg();
        $this->createCode();
        $this->createLine();  
        $this->createFont();
        $this->outPut();
    }  
  
    //获取验证码 
    public function getCode() {
    	$code = array(
    		'url' => $this->url,
    		'code'=> strtolower($this->code)
    	);
        return $code;  
    }  
}  