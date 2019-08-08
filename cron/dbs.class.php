<?php
class DBS{
	private $conn = null;
	private $host = 'localhost';
	private $user = 'root';
	private $pwd = '';
	private $db = 'listenenglish';
	function __construct(){
		$this->conn = new mysqli($this->host,$this->user,$this->pwd,$this->db);
		if(!$this->conn->connect_error){
		    echo $this->conn->connect_error;
		}
	}
	function __destruct(){
		if(isset($conn)){
			$this -> conn -> close();
		}
	}
	public function query($sql){
		return $this -> conn -> query($sql);
	}
	public function close(){
		if(isset($conn)){
			$this -> conn -> close();
			$this -> conn = null;
		}
	}
	public function error(){
		return $this -> conn -> error();
	}
}