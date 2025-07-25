<?php
require_once '../config/config.php';

class EmployeeModel
{// --EmployeeModel---
	private $conn;
	private $table_name = "tbl_employee";
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
        //$query = "SELECT intPositionID, varPosition FROM " . $this->table_position . " ORDER BY varPosition ASC";
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
        $query = "SELECT * FROM tbl_refprovince ORDER BY txtProvDesc  ASC";
        $result = $this->conn->query($query);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $provinces[] = [
                    'provid' => $row['intProvID'],
                    'prov' => $row['txtProvDesc']
                ];
            }            
        }
        return $provinces;
    }

    //Select City/Municipality
    public function getAllCityMun(){
        $query = "SELECT * FROM tbl_refcitymun ORDER BY txtCityMunDesc  ASC";
        $result = $this->conn->query($query);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $citymun[] = [
                    'cmid' => $row['intCityMunID'],
                    'citymun' => $row['txtCityMunDesc']
                ];
            }            
        }
        return $citymun;
    }

        public function getAllBarangay(){
        $query = "SELECT * FROM tbl_refbarangay ORDER BY txtBrgyDesc  ASC";
        $result = $this->conn->query($query);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $barangay[] = [
                    'brgyid' => $row['intBrgyID'],
                    'brgy' => $row['txtBrgyDesc']
                ];
            }            
        }
        return $barangay;
    }

   

}// --/EmployeeModel---

?>