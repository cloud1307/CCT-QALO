<?php
require_once '../config/config.php';

class EmployeeModel
{// --EmployeeModel---
	private $conn;
    private $table_position = "tbl_position";
    private $table_school = "tbl_school";
    private $table_employee = "tbl_employee";
    private $table_school_program = "tbl_school_program";
    private $table_major_program = "tbl_school_program_major";
    private $table_board_resolution = "tbl_board_resolution";
    private $table_academic_resolution = "tbl_academic_resolution";
    private $table_city_resolution = "tbl_city_resolution";
    private $table_accreditation = 'tbl_accreditation';


	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
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

    //Insert Into Query For Postion Table
    public function addPosition($position) {
        $query = "INSERT INTO {$this->table_position} (varPosition) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $position);        
        return $stmt->execute();
    }
    //Update Query for Position Table
    public function updatePosition($id, $position){
        $query = "UPDATE {$this->table_position} SET varPosition = ? WHERE intPositionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si",$position,$id);
        return $stmt->execute();
    }
    //Position Already Exist
    public function positionExists($positionName, $excludeId = null) {
    $query = "SELECT COUNT(*) as count FROM {$this->table_position} WHERE varPosition = ?";
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
        $query = "SELECT * FROM {$this->table_position} ORDER BY varPosition ASC";
        $result = $this->conn->query($query);        
         if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc() ) {
                $positions[] = $row;
            }
         }
         return $positions;
    }

    //Insert School
    public function addSchool($schName, $schCode, $category) {
        $query = "INSERT INTO {$this->table_school} (varSchoolName, varSchoolCode, enumCategory) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $schName, $schCode, $category);
        return $stmt->execute();
    }

    //Update School
    public function updateSchool($schid, $schName, $schCode, $category){        
        $query = "UPDATE {$this->table_school} SET varSchoolName = ?, varSchoolCode = ?, enumCategory = ? WHERE intSchoolID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $schName, $schCode, $category, $schid);        
        return $stmt->execute();
    }

    //School Already Exist
    public function schoolExists($name, $code, $excludeID = null) {
		$sql = "SELECT COUNT(*) FROM {$this->table_school} WHERE (varSchoolName = ? AND varSchoolCode = ?)";
		if (!empty($excludeID)) {
			$sql .= " AND intSchoolID != ?";
		}

		$stmt = $this->conn->prepare($sql);
		if (!empty($excludeID)) {
			$stmt->bind_param("ssi", $name, $code, $excludeID);
		} else {
			$stmt->bind_param("ss", $name, $code);
		}
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		return $count > 0;
	}
   
     //Select All School
    public function getAllSchool($category = null) {
        if (!empty($category)) {
            $query = "SELECT * FROM {$this->table_school} WHERE enumCategory = ? ORDER BY varSchoolName ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $category);
        } else {
            $query = "SELECT * FROM {$this->table_school} ORDER BY varSchoolName ASC";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $schools = [];
        while ($row = $result->fetch_assoc()) {
            $schools[] = $row;
        }
        return $schools;
    }

    //Select All School Program
    public function getAllSchoolProgram(){
        $query = "SELECT a.*, b.* FROM {$this->table_school} a INNER JOIN {$this->table_school_program} b ON b.intSchoolID = a.intSchoolID";
        
        $result = $this->conn->query($query);
        $schProgram = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $schProgram[] = $row;
            }
        }return $schProgram;
    }

    //Insert School Program
    public function addSchoolProgram($schid, $schProgram, $progCode){
        $query = "INSERT INTO {$this->table_school_program} (intSchoolID, varProgramName, varProgramCode) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $schid, $schProgram, $progCode);
        return $stmt->execute();
    }

    //Update School Program
    public function updateSchoolProgram($schProgid, $schid, $schProgram, $progCode){        
        $query = "UPDATE {$this->table_school_program} SET intSchoolID = ?, varProgramName = ?, varProgramCode = ? WHERE intProgramID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issi", $schid, $schProgram, $progCode, $schProgid);        
        return $stmt->execute();
    }


    //School Program Already Exist
    public function schoolProgramExists($schProgram, $progCode, $schProgid = null) {
		$sql = "SELECT COUNT(*) FROM {$this->table_school_program} WHERE (varProgramName = ? AND varProgramCode = ?)";
		if (!empty($schProgid)) {
			$sql .= " AND intSchoolID != ?";
		}

		$stmt = $this->conn->prepare($sql);
		if (!empty($schProgid)) {
			$stmt->bind_param("ssi", $schProgram, $progCode, $schProgid);
		} else {
			$stmt->bind_param("ss", $schProgram, $progCode,);
		}
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		return $count > 0;
	}

    //Insert major program
    public function addMajorProgram($progid, $majorcourse) {
        $query = "INSERT INTO {$this->table_major_program} (intProgramID, varMajorCourse) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $progid, $majorcourse);
        return $stmt->execute();
    }

    //update major program
    public function updateMajorProgram($progid, $majorcourse, $majorid){
        $query = "UPDATE {$this->table_major_program} SET intProgramID = ?, varMajorCourse = ? WHERE intMajorID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isi", $progid, $majorcourse, $majorid);
        return $stmt->execute();
    }

    //Check duplicate Major Program
    public function majorProgramExists($progid, $majorcourse, $majorid = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_major_program} WHERE (intProgramID = ? AND varMajorCourse = ?)";
        if (!empty($majorid)) {
            $sql .= " AND intMajorID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($majorid)){
            $stmt->bind_param('isi', $progid, $majorcourse, $majorid);
        }else{
            $stmt->bind_param('is', $progid, $majorcourse);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }


    //Select All Major Program
    public function getAllMajorProgram(){
        $query = "SELECT a.*, b.* FROM {$this->table_major_program} a
        INNER JOIN {$this->table_school_program} b ON b.intProgramID = a.intProgramID
        ORDER BY a.varMajorCourse ASC";

        $result = $this->conn->query($query);
        $majorProgram = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $majorProgram[] = $row;
            }
        }return $majorProgram;
    }

    //Add Employee
        public function addEmployee($data) {
        $query = "INSERT INTO tbl_employee (
            intEmployeeNumber, varLastName, varFirstName, varMiddleName, varExtensionName, enumGender,
            enumCivilStatus, BirthDate, varPlaceOfBirth, varHouseNo, varStreet,
            intProvID, intCityMunID, intBrgyID,
            intSchoolID, intPositionID, EmploymentDate, enumJobStatus, enumJobCategory, enumUserLevel, dateCreated
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
			throw new Exception("Email check query preparation failed: " . $this->conn->error);
		}
        $stmt->bind_param(
            'isssssssssiiiiisssss',
            $data['employeeNumber'],
            $data['lastName'],
            $data['firstName'],
            $data['middleName'],
            $data['extension'],
            $data['gender'],
            $data['civilStatus'],
            $data['dateOfBirth'],
            $data['placeOfBirth'],
            $data['houseNo'],
            $data['street'],
            $data['province'],
            $data['cityMun'],
            $data['barangay'],
            $data['school'],
            $data['position'],
            $data['employmentDate'],
            $data['jobStatus'],
            $data['jobCategory'],
            $data['userlevel']
            

        );

        return $stmt->execute();
    }


    // Select All Employees
        public function getAllEmployee($status = 'Active') {
            if ($status === 'non-active') {
                $query = "SELECT a.*, b.*, c.*
                        FROM {$this->table_employee} a
                        INNER JOIN {$this->table_position} b ON b.intPositionID = a.intPositionID
                        INNER JOIN {$this->table_school} c ON c.intSchoolID = a.intSchoolID
                        WHERE enumEmploymentStatus IN ('Inactive','Retired','Resigned','Terminated','Non-Renewal')
                        ORDER BY a.varLastName ASC";
                $stmt = $this->conn->prepare($query);
            } elseif (!empty($status)) {
                $query = "SELECT a.*, b.*, c.*
                        FROM {$this->table_employee} a
                        INNER JOIN {$this->table_position} b ON b.intPositionID = a.intPositionID
                        INNER JOIN {$this->table_school} c ON c.intSchoolID = a.intSchoolID
                        WHERE enumEmploymentStatus = ?
                        ORDER BY a.varLastName ASC";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('s', $status);
            } else {
                $query = "SELECT a.*, b.*, c.*
                        FROM {$this->table_employee} a
                        INNER JOIN {$this->table_position} b ON b.intPositionID = a.intPositionID
                        INNER JOIN {$this->table_school} c ON c.intSchoolID = a.intSchoolID
                        ORDER BY a.varLastName ASC";
                $stmt = $this->conn->prepare($query);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            $employee = [];
            while ($row = $result->fetch_assoc()) {
                $employee[] = $row;
            }

            return $employee;
        }
    //Add Board Resolution 
        public function addBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $resolutionFile){
            $documentVerifyID = date('Ymd') . mt_rand(1000000000, 9999999999);
            $query = "INSERT INTO {$this->table_board_resolution} (varBoardResolution, varBoardResolutionCode, BoardResolutionYear, BoardDateUpload, resolutionFile, boardResoDocumentVerifyID) VALUES (?, ?, ?, NOW(), ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssiss", $boardResolution, $boardResolutionCode, $boardResolutionYear, $resolutionFile, $documentVerifyID);
            return $stmt->execute();        
        }

    //Update Resolution
        public function updateBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID, $resolutionFile = NULL){
        $file = isset($resolutionFile) ? ", resolutionFile = ?" : '';
        $params = isset($resolutionFile) ? "ssisi" : 'ssis';
        $query = "UPDATE {$this->table_board_resolution} 
                SET varBoardResolution = ?, varBoardResolutionCode = ?, BoardResolutionYear = ?$file 
                WHERE intBoardResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        if (isset($resolutionFile)) {
            $stmt->bind_param($params, $boardResolution, $boardResolutionCode, $boardResolutionYear, $resolutionFile, $boardResolutionID);
        } else {
            $stmt->bind_param($params, $boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID);
        }
        return $stmt->execute();
    }


    public function getBoardResolution($boardResolutionID){
        $query = "SELECT * FROM {$this->table_board_resolution} WHERE intBoardResolutionID  = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $boardResolutionID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();;
        return $row;
    }
    

     public function BoardResolutionExists($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_board_resolution} WHERE varBoardResolution = ? AND varBoardResolutionCode = ? AND BoardResolutionYear = ?";
        
        if (!empty($boardResolutionID)) {
            $sql .= " AND intBoardResolutionID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        
        if (!empty($boardResolutionID)){
            // Corrected: Only one 'i' for the last int ID
            $stmt->bind_param('sssi', $boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID);
        } else {
            $stmt->bind_param('ssi', $boardResolution, $boardResolutionCode, $boardResolutionYear);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }


    public function ResolutionFileExists($fileName, $boardResolutionID = null) {
    $sql = "SELECT COUNT(*) FROM {$this->table_board_resolution} WHERE resolutionFile = ?";
    if (!empty($boardResolutionID)) {
        $sql .= " AND intBoardResolutionID != ?";
    }

    $stmt = $this->conn->prepare($sql);
    if (!empty($boardResolutionID)) {
        $stmt->bind_param('si', $fileName, $boardResolutionID);
    } else {
        $stmt->bind_param('s', $fileName);
    }

    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count > 0;
}

    //Delete Board Resolution
public function deleteBoardResolution($boardResolutionID) {
    // Step 1: Get the file name
    $query = "SELECT resolutionFile FROM {$this->table_board_resolution} WHERE intBoardResolutionID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $boardResolutionID);
    $stmt->execute();
    $stmt->bind_result($fileName);
    $stmt->fetch();
    $stmt->close();

    // Step 2: Delete the file if it exists
    if (!empty($fileName)) {
        $filePath = "../uploads/botupload/" . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Step 3: Delete the record from the database
    $query = "DELETE FROM {$this->table_board_resolution} WHERE intBoardResolutionID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $boardResolutionID);
    return $stmt->execute();
}


    public function getAllBoardResolution(){
        $query = "SELECT * FROM {$this->table_board_resolution} ORDER BY BoardResolutionYear DESC";
        $result = $this->conn->query($query);
        $board_resolution = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $board_resolution[] = $row;
            }
        }return $board_resolution;
    }

    public function addAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile){
        $AcademicdocumentVerifyID = date('Ymd') . mt_rand(1000000000, 9999999999);
        $query = "INSERT INTO {$this->table_academic_resolution} (varAcademicResolution, varAcademicResolutionCode, AcademicResolutionYear, AcademicDateUpload, AcadResolutionFile, AcademicdocumentVerifyID) VALUES (?, ?, ?, NOW(),?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile, $AcademicdocumentVerifyID);
        return $stmt->execute();
    }

    public function updateAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID){
        $query = "UPDATE {$this->table_academic_resolution} SET varAcademicResolution = ?, varAcademicResolutionCode = ?, AcademicResolutionYear = ? WHERE intAcademicResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssii", $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
        return $stmt->execute();
    }

    public function AcademicResolutionExists($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_board_resolution} WHERE (varBoardResolution = ? AND varBoardResolutionCode = ? AND BoardResolutionYear = ? )";
        if (!empty($majorid)) {
            $sql .= " AND intBoardResolutionID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($boardResolutionID)){
            $stmt->bind_param('ssii', $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
        }else{
            $stmt->bind_param('ssi', $academicResolution, $academicResolutionCode, $academicResolutionYear);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

    public function getAllAcademicResolution(){
        $query ="SELECT * FROM {$this->table_academic_resolution} ORDER BY AcademicResolutionYear ASC";
        $result = $this->conn->query($query);
        $academic_resolution = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $academic_resolution[] = $row;
            }
        }return $academic_resolution;
    }

    //Add City Resolution
    public function addCityResolution($cityResolution, $cityResolutionCode, $cityResolutionYear, $cityResolutionFile){
        $citydocumentVerifyID = date('Ymd') . mt_rand(100000000, 999999999);
        $query = "INSERT INTO {$this->table_city_resolution} (varCityResolution, varCityResolutionCode, CityResolutionYear, CityDateUpload, CityResolutionFile, CitydocumentVerifyID) VALUES (?, ?, ?, NOW(),?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $cityResolution, $cityResolutionCode, $cityResolutionYear, $cityResolutionFile, $citydocumentVerifyID);
        return $stmt->execute();
    }
   

    //Get All City Resolution
    public function getAllCityResolution(){
        $query = "SELECT * FROM {$this->table_city_resolution}";
        $result = $this->conn->query($query);
        $city_resolution = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $city_resolution[] = $row;
            }
        }return $city_resolution;
    }
   
    //Get All Accreditation
    public function getAllAccreditation(){
        $query = "SELECT * FROM {$this->table_accreditation}";
        $result = $this->conn->query($query);
        $accreditation = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $accreditation[] = $row;
            }
        }return $accreditation;
    }

}// --/EmployeeModel---

?>