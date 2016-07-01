<?php
/*
 * 数据库类
 */
class Mysql{

	protected $conn;
	private static $result_mode = array(MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH);
	
	/*
	 * 构造函数 
	 */
	function __construct($config){
		try{
			$this->conn = mysqli_connect($config['db_url'],$config['db_username'],$config['db_password'],$config['db_database']);
		}catch(exception $e){
			$e->getMessage();
		}
		if (!empty($config['db_charset'])){
			$this->conn->query("set character set '".$config['db_charset']."'");
			$this->conn->query("set names '".$config['db_charset']."'");
		}
	}
	
	public function query($sql){
		return mysqli_query($this->conn,$sql);
	}

	/*
	 * 插入数据库
	 * 插入数据，默认是一条
	 * @param array $value	插入数据
	 * @param string $table	数据表
	 * return boolean
	 */
	public function insert($data,$table,$num=1){
		$filed_ar = array();
		$value_ar = array();

		foreach ($data as $key=>$v){
			array_push($filed_ar, $key);
			array_push($value_ar, "'".$v."'");
		}
		$filed = implode(',', $filed_ar);
		$value = implode(',', $value_ar);
		
		$sql = "insert into $table(".$filed.") values(".$value.")";
		$result = mysqli_query($this->conn, $sql);
		return $result;
	}

	/*
	 * 查询数据库
	 * 获取当前表中所有数据
	 * @param string $table	数据表
	 * return array(mysql_type:assoc) 
	 */
	public function getAll($table){
		$sql = "select * from ".$table;
		$object = $this->query($sql);
		$result = mysqli_fetch_all($object,self::$result_mode[0]);
		return $result;
	}
	
	/*
	 * 查询数据库
	 * 获取指定字段值
	 * @param string $table 数据表  
	 * @param array  $param 查询的字段
	 * @param array  $where 查询条件
	 * @param int 	 $mode 返回模型
	 * return array
	 */
	public function select($table , $param , $where = '' , $mode = 0){
		if (is_array($where)){
			$array = array();
			foreach ($where as $v){
				$cond = is_integer($v[1])?$v[0].$v[2].$v[1]:$v[0].$v[2].'"'.$v[1].'"';
				array_push($array, $cond);
			}
			$where = implode(' and ', $array);
			$where = ' where '.$where;
		}
		$param = is_array($param)?implode(',',$param):'*';
		$sql = "select ".$param." from ".$table.$where;
		$object = $this->query($sql);
		$result = mysqli_fetch_all($object,self::$result_mode[$mode]);
		return $result;
	}
	
	/*
	 * 查询数据库
	 * 模糊查询
	 * @param string $table 数据表
	 * @param array  $param 查询字段
	 * @param array  $where 查询条件
	 * @param int    $mode  字段模式
	 * return array
	 */
	public function getFuzzy($table , $param , $where , $mode = 0){
		$param = is_array($param)?implode(',',$param):'*';
		switch ($where[0]){
			case 'left':
				$cond = '%'.$where[1];break;
			case 'right':
				$cond = $where[1].'%';break;
			case 'all':
				$cond = '%'.$where[1].'%';break;
		} 
		$sql = 'select '.$param.' from '.$table.' where '.$where[2].' like "'.$cond.'"';
		$object = $this->query($sql);
		$result = mysqli_fetch_all($object,self::$result_mode[$mode]);
		return $result;
	}

	/*
	 * 更新数据库
	 * @param array $value	将要更新的数据
	 * @param array $conditoin	更新条件
	 * @param string $table	数据表
	 * return boolean
	 */
	public function update($value,$conditoin,$table){
		//将要更新的数据，拼接sql
		$val = array();
		foreach ($value as $key => $v){
			$data = $key.'="'.$v.'"';
			array_push($val, $data);
		}
		$update_data = implode(',', $val);
		
		//更新条件，拼接sql
		$val = array();
		foreach ($conditoin as $key => $v){
			$where = $key.'="'.$v.'" ';
			array_push($val, $where);
		}
		$update_condition = implode('and ', $val);
		
		$sql = "update ".$table." set ".$update_data." where ".$update_condition;
		$object = mysqli_query($this->conn,$sql);
		if ($object){
			return true;
		}else{
			return false;
		}
	}

	/*
	 * 删除数据库
	 * @param array $value	删除条件
	 * @param string $table	数据表
	 * return boolean
	 */
	public function delete($value,$table){
		$array = array();
		foreach ($value as $key=>$v){
				array_push($array, $key." = '".$v."'");
				$condition = implode(' and ', $array);
		}
		$sql = "delete from ".$table." where ".$condition;
		$result = mysqli_query($this->conn, $sql);
		if ($result){
			return true;
		}else{
			return false;
		}
	}

}
?>