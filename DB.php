<?php

class DB{
	private $dbHost     = "localhost";
	private $dbUsername = "root";
	private $dbPassword = "";
	private $dbName     = "batscty";
	
	public function __construct(){

		if (!isset($this->db)) {
			try {
				$conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db = $conn;
			} catch (PDOException $e) {
				die("Failed to connect with MySQL: ". $e->getMessage());
			}
		}

		// if(!isset($this->db)){
		// 	// Connect to the database
		// 	$conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
		// 	if($conn->connect_error){
		// 		die("Failed to connect with MySQL: " . $conn->connect_error);
		// 	}else{
		// 		$this->db = $conn;
		// 	}
		// }
	}
    
	
	public function getRows($table,$condition = array()){
		$sql = 'SELECT ';
		$sql .= array_key_exists("select",$condition)?$condition['select']:'*';
		$sql .= ' FROM '.$table;

		// if(array_key_exists("where",$condition)){
		// 	$sql .= ' WHERE ';
		// 	$i = 0;
		// 	foreach($condition['where'] as $key => $value){
		// 		$pre = ($i > 0)?' AND ':'';
		// 		$sql .= $pre.$key." = '".$value."'";
		// 		$i++;
		// 	}
		// }


		if (!array_key_exists("like", $condition) && array_key_exists("where", $condition)) {
			$sql .= ' WHERE ';
			$i = 0;

			foreach ($condition['where'] as $key => $value) {
				$pre = ($i > 0)?' AND ':'';
				$sql .= $pre.$key."='".$value."'";
				$i++;
			}
		}

		// for search
		if (!array_key_exists("where", $condition) && array_key_exists("like", $condition) && !empty($condition['like'])) {

			$sql .= ' WHERE ';
			$whereClauses = array();
			$keyword_tokens = explode(' ', $condition['like']['keywords']);

			if (is_array($condition['like']['concat'])) {
				$concats[] = implode(', ', $condition['like']['concat']);

				for ($i=0; $i < count($concats); $i++) { 
					foreach ($keyword_tokens as $keyword) {
					    $keyword = mysql_real_escape_string($keyword);
					    $whereClauses[] = "CONCAT(" .$concats[$i]. ") LIKE '%$keyword%'";
					}
				}
			} else {
				$concats = $condition['like']['concat'];

				for ($i=0; $i < count($concats); $i++) { 
					foreach ($keyword_tokens as $keyword) {
					    $keyword = mysql_real_escape_string($keyword);
					    $whereClauses[] = $concats . " LIKE '%$keyword%'";
					}
				}
			}

			$sql .= implode(' OR ', $whereClauses);
		}
		// end search


		
		if(array_key_exists("order_by",$condition)){
			$sql .= ' ORDER BY '.$condition['order_by']; 
		}
		
		if(array_key_exists("start",$condition) && array_key_exists("limit",$condition)){
			$sql .= ' LIMIT '.$condition['start'].','.$condition['limit']; 
		}elseif(!array_key_exists("start",$condition) && array_key_exists("limit",$condition)){
			$sql .= ' LIMIT '.$condition['limit']; 
		}
		
		// $result = $this->db->query($sql);

		$query = $this->db->prepare($sql);
		$query->execute();
		
		// if(array_key_exists("return_type",$condition) && $condition['return_type'] != 'all'){
		// 	switch($condition['return_type']){
		// 		case 'count':
		// 			$data = $result->num_rows;
		// 			break;
		// 		case 'single':
		// 			$data = $result->fetch_assoc();
		// 			break;
		// 		default:
		// 			$data = '';
		// 	}
		// }else{
		// 	if($result->num_rows > 0){
		// 		while($row = $result->fetch_assoc()){
		// 			$data[] = $row;
		// 		}
		// 	}
		// }
		// return !empty($data)?$data:false;


		if (array_key_exists("return_type", $condition) && $condition['return_type'] != 'all') {
			switch ($condition['return_type']) {
				case 'count':
					$data = $query->rowCount();
					break;
				case 'single':
					$data = $query->fetch(PDO::FETCH_ASSOC);
					break;
				
				default:
					$data = '';
					break;
			}
		} else {
			if ($query->rowCount() > 0) {
				$data = $query->fetchAll();
			}
		}
		return !empty($data)?$data:false; 

	}
	

	public function insert($table,$data){
		if(!empty($data) && is_array($data)){
			$columnString = '';
			$valueString  = '';
			$i = 0;

			if(!array_key_exists('created',$data)){
				$data['created'] = date("Y-m-d H:i:s");
			}
			if(!array_key_exists('modified',$data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}


			// foreach($data as $key=>$val){
			// 	$pre = ($i > 0)?', ':'';
			// 	$columns .= $pre.$key;
			// 	$values  .= $pre."'".$val."'";
			// 	$i++;
			// }
			// $query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
			// $insert = $this->db->query($query);
			// return $insert?$this->db->insert_id:false;

			$columnString = implode(',', array_keys($data));
			$valueString = ":".implode(',:', array_keys($data));

			$sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";


			$query = $this->db->prepare($sql);

			foreach ($data as $key => $value) {
				$query->bindValue(":".$key, $value);
			}

			$insert = $query->execute();
			return $insert?$this->db->lastInsertId():false;

		}else{
			return false;
		}
	}
	
	
	public function update($table,$data,$condition){
		if(!empty($data) && is_array($data)){
			$colvalSet = '';
			$whereSql = '';
			$i = 0;
			
			if(!array_key_exists('modified',$data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}

			foreach($data as $key=>$val){
				$pre = ($i > 0)?', ':'';
				$colvalSet .= $pre.$key."='".$val."'";
				$i++;
			}
			if(!empty($condition)&& is_array($condition)){
				$whereSql .= ' WHERE ';
				$i = 0;

				foreach($condition as $key => $value){
					$pre = ($i > 0)?' AND ':'';
					$whereSql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}

			// $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
			// $update = $this->db->query($query);
			// return $update?$this->db->affected_rows:false;

			$sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
			$query = $this->db->prepare($sql);
			$update = $query->execute();

			return $update?$query->rowCount():false;

		}else{
			return false;
		}
	}
	
	
	public function delete($table,$condition){
		$whereSql = '';
		if(!empty($condition)&& is_array($condition)){
			$whereSql .= ' WHERE ';
			$i = 0;
			foreach($condition as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$whereSql .= $pre.$key." = '".$value."'";
				$i++;
			}
		}
		// $query = "DELETE FROM ".$table.$whereSql;
		// $delete = $this->db->query($query);
		// return $delete?true:false;

		$sql = "DELETE FROM ".$table.$whereSql;
		$delete = $this->db->exec($sql);

		return $delete?$delete:false;
	}

	//for renaming files
	public function upload_file($file) {
		if(isset($file)) {
			$extension = explode('.', $file['name']);
            $new_name = rand() . '.' . $extension[1];  
            // $destination = 'image/' . $new_name;  
            // move_uploaded_file($file['tmp_name'], $destination);  
            return $new_name;  
        }  
	}

}