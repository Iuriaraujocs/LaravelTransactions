<?php

namespace system\mvc;

use \PDO;
use PDOException;

class SQL
{

	public $conn;
	public $hostname;
	public $username;
	public $password;
	public $database;


	public function __construct($hostname = null,$database= null,$username = null,$password = null)
	{
		if(php_sapi_name() != 'cli'){
			$conn = Config();
			$hostname = $conn->hostname;
			$database = $conn->database;
			$username = $conn->username;
			$password = $conn->password;	
		} 
		
		try {
			$this->conn = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
			die();
		}
	}

	private function setParams($statment, $parameters = array())
	{
		if ($this->array_key_first($parameters) == '0') {
			$size = count($parameters);
			for ($i = 0; $i < $size; $i++) $this->setParam($statment, ($i + 1), $parameters[$i]);
		} else foreach ($parameters as $key => $value) {
			$this->setParam($statment, $key, $value);
		}
	}

	private function setParam($statment, $key, $value)
	{
		if (is_int($value)) $statment->bindParam($key, $value, PDO::PARAM_INT);
		else {$statment->bindParam($key, $value,PDO::PARAM_STR);}    
	}

	public function queryy($comandoSQL, $params = array())
	{
		$stmt = $this->conn->prepare($comandoSQL);
		$this->setParams($stmt, $params);

		// debug banco
		if (isset($GLOBALS['dbgBsnco']) && $GLOBALS['dbgBsnco'] = 1)
			print_r($stmt);
//			echo "<div>{$comandoSQL}</div>"ç
		$stmt->execute();
		return $stmt;
	}

	public function select($comando, $params = array())
	{
		$stmt = $this->queryy($comando, $params);
		ini_set('memory_limit', '-1');
		return $stmt->fetchALL(PDO::FETCH_ASSOC);
}

	public function run($comando, $params = array()){
		$stmt = $this->queryy($comando, $params);
		return $stmt;
	}

	public function datatoArray($atributo = array(), $data = array())
	{
		$array = array();
		$length = sizeof($data);
		for ($i = 0; $i < $length; $i++) {
			array_push($array, $data[$atributo[$i]]);
		}
		return $array;

	}

	private function array_key_first(array $arr)
	{
		foreach ($arr as $key => $unused) {
			return $key;
		}

	}

	public function alteraNull($result = array(), $key = array())
	{
		$tamanho = sizeof($result);
		if (isset($result[0])) {
			for ($i = 0; $i < $tamanho; $i++) {
				foreach ($result[$i] as $key => $value) {
					if ($value == null) $result[$i][$key] = '';
				}
			}
		} else $result = array($key);

		return $result;
	}

}