<?php 
	// Api.php

	class API{
		private $connect = '';

		function __construct(){
			$this->database_connection();
		}
		function database_connection(){
			$this->connect = new PDO("mysql:host=localhost;dbname=php_crud_rest_api", "root", "");
		}

		function fetch_all(){
			$query = "SELECT * FROM tbl_sample ORDER BY id";
			$statement = $this->connect->prepare($query);
			if($statement->execute()){
				$data=array();
				$i=0;
				while($row = $statement->fetch(PDO::FETCH_ASSOC)){
					$data[$i] = $row;
					$i++;
				}
				return $data;
			}
		}
	}

?>