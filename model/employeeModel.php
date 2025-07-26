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

    public function addPosition($position) {
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_position . " (varPosition) VALUES (?)");
        $stmt->bind_param("s", $position);
        return $stmt->execute();
    }

    public function updatePosition($id, $position){
        $stmt = $this->conn->prepare("UPDATE " . $this->table_position . " SET varPosition = ? WHERE intPositionID = ?");
        $stmt->bind_param("si",$position,$id);
        return $stmt->execute();
    }

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