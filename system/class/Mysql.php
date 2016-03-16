<?php
/*
 * DB Class
 */
class Mysql{

	protected $conn;
	
	/*
	 * 构造函数 
	 */
	function __construct($config){
		try{
			$this->conn = mysqli_connect($config['db_url'],$config['db_username'],$config['db_password'],$config['db_database']);
		}catch(exception $e){
			$e->getMessage();
		}
		
		$this->conn->query("set character set '".$config['db_charset']."'");
		$this->conn->query("set names '".$config['db_charset']."'");
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
	 * 给定查询值，获得一条数据
	 * @param array $value	查询条件
	 * @param string $table	数据表
	 * return array(mysql_type:assoc)
	 */
	public function get_one($value,$table){
		$array = array();
		foreach ($value as $key => $v){
			$where = $key.'="'.$v.'" ';
			array_push($array, $where);
		}
		$condition = implode('and ', $array);
		$sql = "select * from ".$table." where ".$condition;
		$object = mysqli_query($this->conn,$sql);
		$result = mysqli_fetch_assoc($object);
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
		$object = mysqli_query($this->conn,$sql);
		$result = mysqli_fetch_all($object,MYSQL_ASSOC);
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
		
	}

}
?>