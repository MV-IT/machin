<?php
if(file_exists('nk-config.php'))
	require_once('nk-config.php');
elseif(file_exists('../nk-config.php'))
	require_once('../nk-config.php');
if(!class_exists('Database')):
class Database
{
	// Biến lưu trữ kết nối
	private $__conn;
	protected $host;
	protected $user;
	protected $pass;
	protected $name;
	public $connect_error;
	

	function __construct($host = '', $user = '', $pass = '', $name = ''){
		$this->host = !empty($host) ? $host : db_host;
		$this->user = !empty($user) ? $user : db_user;
		$this->pass = !empty($user) ? $pass : db_pass;
		$this->name = !empty($name) ? $name : db_name;
		$this->connect_error = false;
	}
	public function getConn()
	{
		return $this->__conn;
	}
	// Hàm Kết Nối
	function connect()
	{
		if (empty($this->__conn)){
			// Kết nối
			$this->__conn = mysqli_connect($this->host, $this->user, $this->pass, $this->name) or die(mysqli_connect_error());
			// Xử lý truy vấn UTF8 để tránh lỗi font
			mysqli_set_charset($this->__conn, 'utf8');
		}
	}
 
	// Hàm Ngắt Kết Nối
	function disConnect(){
		// Nếu đang kết nối thì ngắt
		if ($this->__conn){
			if(!mysqli_close($this->__conn))
				die(mysqli_error($this->__conn));
		}
	}

	function query($sql){
		$this->connect();
		return mysqli_query($this->__conn, $sql);
	}

	function escape_string($string){
		try {
			$this->connect();
			return mysqli_real_escape_string($this->__conn, $string);
		} catch (Exception $e) {
			echo 'Lỗi server!';
			die();
		}
	}
 
	// Hàm Insert
	function insert($table, $data)
	{
		// Lưu trữ danh sách field
		$field_list = '';
		// Lưu trữ danh sách giá trị tương ứng với field
		$value_list = '';
 
		// Lặp qua data
		foreach ($data as $key => $value){
			$field_list .= ",$key";
			$value_list .= ",'".$this->escape_string($value)."'";
		}
 
		// Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
		$sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
		return $this->query($sql);
	}
 
	// Hàm Update
	function update($table, $data, $where)
	{
		// Kết nối
		$sql = '';
		// Lặp qua data
		foreach ($data as $key => $value){
			$sql .= "$key = '".$this->escape_string($value)."',";
		}
 
		// Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
		$sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
 
		return $this->query($sql);
	}
 
	function deleteRow($table, $where){
		 
		$sql = "DELETE FROM $table WHERE $where";
		return $this->query($sql);
	}

	function dropTable($table){
		
		$sql = "DROP TABLE $table";

		return $this->query($sql);
	}
 
	function getList($sql)
	{
		 
		$result = $this->query($sql);
 
		if (!$result){
			die ('Câu truy vấn bị sai');
		}
 
		$return = array();
 
		while ($row = mysqli_fetch_assoc($result)){
			$return[] = $row;
		}
 
		mysqli_free_result($result);
 
		return $return;
	}
 
	function getRow($sql)
	{
		 
		$result = $this->query($sql);
 
		if (!$result){
			die ('Câu truy vấn bị sai');
		}
 
		$row = mysqli_fetch_assoc($result);
 
		mysqli_free_result($result);
 
		if ($row){
			return $row;
		}
 
		return false;
	}

	function getNumRows($sql){

		$query = $this->query($sql);

		$result = mysqli_num_rows($query);

		mysqli_free_result($query);

		return $result;
	}

	
	function insertDatabaseFile($filename){
		$done = true;
		$templine = '';

		$lines = file($filename); 
		// Loop through each line 
		foreach ($lines as $line) { 
		// Skip it if it's a comment 
			if (substr($line, 0, 2) == '--' || $line == '') continue; 
			// Add this line to the current segment 
			$templine .= $line; 
			// If it has a semicolon at the end, it's the end of the query 
			if (substr(trim($line), -1, 1) == ';') { 
			// Perform the query 
				$this->query($templine) or $done = false; 
				// Reset temp variable to empty 
				$templine = ''; 
			} 
		}
		return $done;
	}
}
endif;
?>