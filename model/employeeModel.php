<?php
require_once '../config/config.php';

class EmployeeModel
{// --EmployeeModel---
	private $conn;
    private $table_position = "tbl_position";
    private $table_school = "tbl_school";


	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
	}
    //Insert Into Query For Postion Table
    public function addPosition($position) {
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_position . " (varPosition) VALUES (?)");
        $stmt->bind_param("s", $position);
        return $stmt->execute();
    }
    //Update Query for Position Table
    public function updatePosition($id, $position){
        $stmt = $this->conn->prepare("UPDATE " . $this->table_position . " SET varPosition = ? WHERE intPositionID = ?");
        $stmt->bind_param("si",$position,$id);
        return $stmt->execute();
    }
    //Position Already Exist
    public function positionExists($positionName, $excludeId = null) {
    $query = "SELECT COUNT(*) as count FROM tbl_position WHERE varPosition = ?";
    if ($excludeId) {
        $query .= " AND intPositionID != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $positionName, $excludeId);
    } else {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $positionName);
    }

    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['count'] > 0;
}

    //Select All Position
    public function getAllPosition() {
        
        $positions = []; // ✅ Initialize
        $query = "SELECT * FROM " . $this->table_position . " ORDER BY varPosition ASC";
        $result = $this->conn->query($query);

         if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc() ) {
                $positions[] = $row;
            }
         }
         return $positions;
    }

    //Insert School
    public function addSchool($schName, $schCode) {
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_school . " (varSchoolName, varSchoolCode) VALUES (?, ?)");
        $stmt->bind_param("ss", $schName, $schCode);
        return $stmt->execute();
    }

    //Update School
    public function updateSchool($schid, $schName, $schCode){        
        $stmt = $this->conn->prepare("UPDATE ". $this->table_school . " SET varSchoolName = ?, varSchoolCode = ? WHERE intSchoolID = ?");
        $stmt->bind_param("ssi", $schName, $schCode, $schid);
        return $stmt->execute();
    }
    

     //Select All School
    public function getAllSchool(){
        
        $query = "SELECT * FROM " . $this->table_school . " ORDER BY varSchoolName ASC";
        $result = $this->conn->query($query);
        $schools = []; // ✅ Initialize
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $schools[] = $row;
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