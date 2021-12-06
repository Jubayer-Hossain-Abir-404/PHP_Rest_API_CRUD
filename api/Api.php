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

		function insert(){
			if(isset($_POST["first_name"])){
				$form_data = array(
					':first_name' => $_POST["first_name"],
   
					':last_name' => $_POST["last_name"]
				);
				$query = "INSERT INTO tbl_sample (first_name, last_name) VALUES (:first_name, :last_name)";
				$statement = $this->connect->prepare($query);

				if($statement->execute($form_data)){
					$data[] = array(
						'success' => '1'
					);
				}
				else{
					$data[] = array(
						'success' => '0'
					);
				}
			}
			else{
				$data[] = array(
					'success' => '0'
				);
			}
			return $data;
		}

		function fetch_single($id){
			$query = "SELECT * FROM tbl_sample WHERE id='".$id."'";
			$statement = $this->connect->prepare($query);
			if($statement->execute()){
				foreach($statement->fetchAll() as $row){
					$data['first_name'] = $row['first_name'];
					$data['last_name'] = $row['last_name'];
				}
				return $data;
			}
		}
	}

?>