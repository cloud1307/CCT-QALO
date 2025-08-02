<?php
require_once '../config/config.php';

Class AccreditationModel{
    private $conn;
    private $table_accreditation = 'tbl_accreditation';


	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
	}

    private function getAllAccreditation(){
        $query = "SELECT * FROM {$this->table_accreditation}";
        $result = $this->conn-query($query);
        $accreditation = [];
        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $accreditation[] = $row;
            }
        }return $accreditation;
    }

}




?>