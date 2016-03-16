<?php
/*
 * 自定义分页类
 * @Author 		Xuby
 * @FirstEdit	2016年1月28日15:02:03
 */

class Pagination {
	//每页数量
	protected $size;
	
	/*
	 * 构造函数
	 * @param $page_size 每页数量
	 */
	function __construct($page_size){
		if ($this->chkType($page_size)){
			$this->size = $page_size;
		}
	}
	
   /*
	* 获取分页总数
	* @param $total int 查询总量
	* return int 分页总数
	*/
	public function total($total){
		if ($this->chkType($total)){
			$int   = intval($total / $this->size);
			$float = intval($total % $this->size);
			return ($float==0)?$int:($int+1);
		}
	}
	
	/*
	 * 返回当前偏移量
	 * @param $total int 查询总量
	 * @param $page  int 当前页码
	 * return int 当前偏移量
	 */
	public function offset($total,$page){
		if ($this->chkType($page)){
			$num = $this->total($total);
			return ($page<=$num)?($page-1) * $this->size:($num-1) * $this->size;				
		}
	}
	
	/*
	 * 检查传递过来的是否为数字变量
	 * @param $int int 传递变量的具体值
	 * return boolean
	 */
	public function chkType($int){
		$var = intval($int);
		if (is_numeric($var) && $var>0){
			return true;
		} else{
			echo '数据类型错误';
			exit();
		}
	}
}
?>