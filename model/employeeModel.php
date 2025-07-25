<?php
require_once '../config/config.php';

class EmployeeModel
{// --EmployeeModel---
	private $conn;
    private $table_position = "tbl_position";
    private $table_school = "tbl_school";
    //private $table_province = "tbl_refprovince";

	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
	}

    //Select All Position
    public function getAllPosition() {
        
        $positions = []; // ✅ Initialize
        $query = "SELECT * FROM " . $this->table_position . " ORDER BY varPosition ASC";
        $result = $this->conn->query($query);

         if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $positions[] = [
                    'posid' => $row['intPositionID'],
                    'position' => $row['varPosition']
                ];
            }
         }
         return $positions;
    }
     //Select All School
    public function getAllSchool(){
        $schools = []; // ✅ Initialize
        $query = "SELECT * FROM " . $this->table_school . " ORDER BY varSchoolName ASC";
        $result = $this->conn->query($query);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $schools[] = [
                    'schid' => $row['intSchoolID'],
                    'schoolName' => $row['varSchoolName']
                ];
            }            
        }
        return $schools;
    }

    //Select All Province
    public function getAllProvince(){
        $provinces = []; // ✅ Initialize
        $query = "SELECT * FROM tbl_refprovince ORDER BY txtProvDesc  ASC";
        $result = $this->conn->query($query);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $provinces[] = [
                    'provid' => $row['varProvCode'],
                    'prov' => $row['txtProvDesc']
                ];
            }            
        }
        return $provinces;
    }
   

}// --/EmployeeModel---

?>