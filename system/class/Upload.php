<?php
/*
 * 文件上传类
 */	
class Upload{
	
	private $_file = array();	//上传的文件
	private $_path;				//文件上传路径
	private $_size;				//上传文件大小，单位:B
	private $_type;				//上传文件类型
	private $_code;				//上传文件名编码
	
	function __construct($config){
		$this->_path = $config['up_path'];
		$this->_size = $config['up_size'];
		$this->_code = $config['up_code'];
		$this->_type = array_filter(explode('|',$config['up_type']));
		$this->valiPath();
	}

	//整理上传数据
	private function arrangeFile($file){
		foreach ($file as $key => $value) {
			foreach ($value as $k => $v) {
				$this->_file[$key][$k] = $v[0];	
			}
		}
	}
	
	//验证上传文件类型
	private function valiType($type){
		$file_type_array = explode('.',$type);
		$file_type = $file_type_array[count(explode('.',$type))-1];
		return (in_array($file_type,$this->_type))?true:false;
	}
	
	//验证上传文件大小
	private function valiSize($size){
		return ($size == max($size,$this->_size * 1024 * 1024))?false:true;
	}

	//验证上传文件保存路径
	private function valiPath(){
		if (!file_exists($this->_path)) {
			mkdir($this->_path,0777,true);
		}
	}
	
	//上传函数
	public function doUpload($file){
		$this->arrangeFile($file);
		$callback = array();
		foreach ($this->_file as $key => $value) {
			$callback[$key]['name'] = $value['name'];
			if ($this->valiSize($value['size'])) {
				if ($this->valiType($value['name'])) {
					$code = mb_detect_encoding($value['name']);
					$result = move_uploaded_file($value['tmp_name'],$this->_path.iconv($code,$this->_code,$value['name']));
					if ($result) {
						$callback[$key]['code'] = 0;
						$callback[$key]['path'] = $this->_path.$value['name'];
					}else{
						$callback[$key]['code'] = 3;
					}
				}else{
					$callback[$key]['code'] = 1;
				}
			}else{
				$callback[$key]['code'] = 2;
			}
		}
		return $callback;
	}

	//错误信息
	public function errorLog($level){
		$errorLog = array(
			'1' => '文件类型错误，请重新上传',
			'2' => '文件大小过大，请重新上传',
			'3' => '文件上传异常，请重新上传'
		);
		return "“".$level['name']."”".$errorLog[$level['code']];
	}
	
}
	
?>