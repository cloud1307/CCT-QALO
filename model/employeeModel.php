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
    private $table_area = 'tbl_accreditation_area';
    private $table_account = "tbl_account";
    private $table_child = "tbl_child";
    private $table_contract = "tbl_contract";
    private $table_educational = "tbl_education_background";


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
    public function addSchoolProgram($schid, $schProgram, $progCode, $majorcourse){
        $query = "INSERT INTO {$this->table_school_program} (intSchoolID, varProgramName, varProgramCode, varMajorCourse) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $schid, $schProgram, $progCode, $majorcourse);
        return $stmt->execute();
    }

    //Update School Program
    public function updateSchoolProgram($schProgid, $schid, $schProgram, $progCode, $majorcourse){        
        $query = "UPDATE {$this->table_school_program} SET intSchoolID = ?, varProgramName = ?, varProgramCode = ?, varMajorCourse = ? WHERE intProgramID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $schid, $schProgram, $progCode, $majorcourse, $schProgid);        
        return $stmt->execute();
    }


    //School Program Already Exist
    public function schoolProgramExists($schProgram, $majorcourse, $schProgid = null) {
		$sql = "SELECT COUNT(*) FROM {$this->table_school_program} WHERE (varProgramName = ? AND varMajorCourse = ?)";
		if (!empty($schProgid)) {
			$sql .= " AND intProgramID != ?";
		}

		$stmt = $this->conn->prepare($sql);
		if (!empty($schProgid)) {
			$stmt->bind_param("ssi", $schProgram, $majorcourse, $schProgid);
		} else {
			$stmt->bind_param("ss", $schProgram, $majorcourse);
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
    public function addEmployee($data, $insert_id) {
        $query = "INSERT INTO tbl_employee (
            intAccountID, intEmployeeNumber, varLastName, varFirstName, varMiddleName, varExtensionName, enumGender,
            enumCivilStatus, BirthDate, varPlaceOfBirth, varHouseNo, varStreet,
            intProvID, intCityMunID, intBrgyID,
            intSchoolID, intPositionID, EmploymentDate, enumJobStatus, enumJobCategory
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
			throw new Exception("Email check query preparation failed: " . $this->conn->error);
		}
        $stmt->bind_param(
            'isssssssssssiiiiisss',
            $insert_id, //i
            $data['employeeNumber'], //s
            $data['lastName'],  //s
            $data['firstName'], //s
            $data['middleName'], //s
            $data['extension'], //s
            $data['gender'], //s
            $data['civilStatus'], //s
            $data['dateOfBirth'], //s
            $data['placeOfBirth'], //s
            $data['houseNo'], //s
            $data['street'], //s
            $data['province'], //i
            $data['cityMun'], //i
            $data['barangay'], //i
            $data['school'], //i
            $data['position'], //i
            $data['employmentDate'], //s
            $data['jobStatus'], //s
            $data['jobCategory'] //s
        
        );

        return $stmt->execute();
    }
    public function getEmployeeID($accountID){
        $query = "SELECT a.*, b.* FROM {$this->table_account} a INNER JOIN {$this->table_employee} b ON b.intAccountID = a.intAccountID WHERE a.intAccountID = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);

        if (!$stmt){

        }if (!$stmt) {
			throw new Exception("Prepare failed: " . $this->conn->error);
		}

		$stmt->bind_param("i", $userId);

		if (!$stmt->execute()) {
			throw new Exception("Execute failed: " . $stmt->error);
		}
		$result = $stmt->get_result();
		return $result->fetch_assoc();  // return single row as assoc array
	
    }

    public function updateEmployee($employeeData, $accountID){
        $query = "UPDATE {$this->table_employee} SET intEmployeeNumber = ?, varFirstName = ?, varMiddleName	= ?, varLastName = ?, varExtensionName = ?, enumGender = ?, 
        enumCivilStatus = ?, BirthDate = ?, varPlaceOfBirth = ?, varHouseNo = ?, varStreet = ?, intProvID = ?, intCityMunID = ?, intBrgyID = ?, intSchoolID = ?,
        intPositionID = ?, EmploymentDate = ?, enumJobStatus = ?, enumJobCategory = ? WHERE intAccountID = ?";
        $stmt - $this->conn->prepare($query);
        $stmt->bind_param("sssssssssssiiiiisssi",
        $employeeData['employeeNumber'],
        $employeeData['lastName'],
        $employeeData['firstName'],
        $employeeData['middleName'],
        $employeeData['extension'],
        $employeeData['gender'],
        $employeeData['civilStatus'],
        $employeeData['dateOfBirth'],
        $employeeData['placeOfBirth'],
        $employeeData['houseNo'],
        $employeeData['street'],
        $employeeData['province'],
        $employeeData['cityMun'],
        $employeeData['barangay'],
        $employeeData['school'],
        $employeeData['position'],
        $employeeData['employmentDate'],
        $employeeData['jobStatus'],
        $employeeData['jobCategory'],
        $accountID );
        return $stmt->execute();
    }

    public function AccountExist($AccountData, $accountID = null) {
        $query = "SELECT COUNT(*) 
                FROM {$this->table_account} 
                WHERE (varEmail = ? 
                        OR (varRecoveryEmail = ? AND varContactNumber = ?))";

        // If updating, exclude the current account from the check
        if (!empty($accountID)) {
            $query .= " AND intAccountID != ?";
        }

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("AccountExist query preparation failed: " . $this->conn->error);
        }

        if (!empty($accountID)) {
            $stmt->bind_param(
                'sssi',
                $AccountData['email'],            // varEmail
                $AccountData['alternativeEmail'], // varRecoveryEmail
                $AccountData['contactNumber'],    // varContactNumber
                $accountID                        // accountID
            );
        } else {
            $stmt->bind_param(
                'sss',
                $AccountData['email'],            // varEmail
                $AccountData['alternativeEmail'], // varRecoveryEmail
                $AccountData['contactNumber']     // varContactNumber
            );
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }


    //Register Account
    public function AddAccount($AccountData, $password){
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO {$this->table_account} (varEmail, varPassword, textPassword, enumUserLevel, varRecoveryEmail, varContactNumber, dateCreated)
                  VALUES (?, ?, ?, ?, ?, ?, NOW())";
				  
        $stmt = $this->conn->prepare($query);
		if (!$stmt) {
			throw new Exception("Email check query preparation failed: " . $this->conn->error);
		}
        $stmt->bind_param("ssssss",
		$AccountData['email'],
		$hashedPassword,
		$password,
        $AccountData['userlevel'],
		$AccountData['alternativeEmail'],
		$AccountData['contactNumber']
		
		);
		return $stmt->execute() ? $stmt->insert_id : $stmt->execute();
	}

    public function updateAccount($AccountData,$accountID){
        $query = "UPDATE {$this->table_account} SET varEmail = ?, enumUserLevel = ?, varRecoveryEmail= ?, varContactNumber = ? WHERE intAccountID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", 
        $AccountData['email'],
        $AccountData['userlevel'],
        $AccountData['alternativeEmail'],
        $AccountData['contactNumber'],
        $accountID);
        return $stmt->execute();

    }

    public function updateUserAccount($password, $recoveryEmail, $contactNumber, $accountID){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE {$this->table_account} SET varPassword = ?, textPassword = ?, varRecoveryEmail =?, varContactNumber = ? WHERE intAccountID  = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $hashedPassword, $password, $recoveryEmail, $contactNumber, $accountID);
        return $stmt->execute();
    }

    //Generate Random Password
    public function generateSecurePassword($length = 8) {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        //$symbols = '!@#$%^&*()-_=+[]{}|;:,.<>?';

        $allCharacters = $lowercase . $uppercase . $numbers;
        $password = '';

        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        //$password .= $symbols[random_int(0, strlen($symbols) - 1)];

        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        return str_shuffle($password);
    }
    
    //Update Employment Status
    public function updateEmployementStatus($EmploymentStatus, $employeeID = null){
        $query = "UPDATE {$this->table_employee} SET enumEmploymentStatus = ? WHERE intEmployeeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $EmploymentStatus, $employeeID);
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
    
    // -------------------------------Board Resolution------------------------------------------------//
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

    //Board Resolution Exists
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

    //Check Resolution File Exists
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

    
    public function getBoardResolution($boardResolutionID) {
        $query = "SELECT resolutionFile FROM {$this->table_board_resolution} WHERE intBoardResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $boardResolutionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //Delete Board Resolution
    public function deleteBoardResolution($boardResolutionID) {
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
    // -------------------------------End Board Resolution------------------------------------------------//

    // -------------------------------Academic Resolution------------------------------------------------//
    public function addAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile){
        $AcademicdocumentVerifyID = date('Ymd') . mt_rand(1000000000, 9999999999);
        $query = "INSERT INTO {$this->table_academic_resolution} (varAcademicResolution, varAcademicResolutionCode, AcademicResolutionYear, AcademicDateUpload, AcadResolutionFile, AcademicdocumentVerifyID) VALUES (?, ?, ?, NOW(),?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile, $AcademicdocumentVerifyID);
        return $stmt->execute();
    }
    //Update Academic resolution
    public function updateAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID, $academicResolutionFile = NULL){
        $acadFile = isset($academicResolutionFile) ? ", AcadResolutionFile = ?" : '';
        $params = isset($academicResolutionFile) ? "ssisi" : 'ssis';
        $query = "UPDATE {$this->table_academic_resolution} 
            SET varAcademicResolution = ?, varAcademicResolutionCode = ?, AcademicResolutionYear = ?$acadFile 
            WHERE intAcademicResolutionID = ?";
        $stmt = $this->conn->prepare($query);        
        if(isset($academicResolutionFile)){
            $stmt->bind_param($params, $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile, $academicResolutionID);
        }else {
             $stmt->bind_param($params, $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
        }       
        return $stmt->execute();
    }
    //Check Academic Resolution Exists
    public function AcademicResolutionExists($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_academic_resolution} WHERE varAcademicResolution = ? AND varAcademicResolutionCode = ? AND AcademicResolutionYear = ?";
        if (!empty($academicResolutionID)) {
            $sql .= " AND intAcademicResolutionID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($academicResolutionID)){
            $stmt->bind_param('sssi', $academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
        }else{
            $stmt->bind_param('ssi', $academicResolution, $academicResolutionCode, $academicResolutionYear);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

       //Check Academic Resolution File Exists
    public function AcademicResolutionFileExists($academicResolutionFile, $academicResolutionID = null) {
        $sql = "SELECT COUNT(*) FROM {$this->table_academic_resolution} WHERE AcadResolutionFile = ?";
        if (!empty($academicResolutionID)) {
            $sql .= " AND intAcademicResolutionID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($academicResolutionID)) {
            $stmt->bind_param('si', $academicResolutionFile, $academicResolutionID);
        } else {
            $stmt->bind_param('s', $academicResolutionFile);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function getAcademicResolution($academicResolutionID) {
        $query = "SELECT AcadResolutionFile FROM {$this->table_academic_resolution} WHERE intAcademicResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $academicResolutionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //Delete Board Resolution
    public function deleteAcademicResolution($academicResolutionID) {
        $query = "DELETE FROM {$this->table_academic_resolution} WHERE intAcademicResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $academicResolutionID);
        return $stmt->execute();
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
    // -------------------------------End Academic Resolution------------------------------------------------//

    // --------------------------------------City Resolution------------------------------------------------//
            //Add City Resolution 
    public function addCityResolution($cityResolution, $cityResolutionCode, $cityResolutionYear, $cityResolutionFile){
            $citydocumentVerifyID = date('Ymd') . mt_rand(100000000, 999999999);
            $query = "INSERT INTO {$this->table_city_resolution} (varCityResolution, varCityResolutionCode, CityResolutionYear, CityDateUpload, CityResolutionFile, CitydocumentVerifyID) VALUES (?, ?, ?, NOW(),?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssiss", $cityResolution, $cityResolutionCode, $cityResolutionYear, $cityResolutionFile, $citydocumentVerifyID);
            return $stmt->execute();
    }

        //Update City Resolution
    public function updateCityResolution($CityResolution, $CityResolutionCode, $CityResolutionYear, $CityResolutionID, $cityResolutionFile = NULL){
        $file = isset($cityResolutionFile) ? ", cityResolutionFile = ?" : '';
        $params = isset($cityResolutionFile) ? "ssisi" : 'ssis';
        $query = "UPDATE {$this->table_city_resolution} 
                SET varCityResolution = ?, varCityResolutionCode = ?, CityResolutionYear = ?$file 
                WHERE intCityResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        if (isset($cityResolutionFile)) {
            $stmt->bind_param($params, $CityResolution, $CityResolutionCode, $CityResolutionYear, $cityResolutionFile, $CityResolutionID);
        } else {
            $stmt->bind_param($params, $CityResolution, $CityResolutionCode, $CityResolutionYear, $CityResolutionID);
        }
        return $stmt->execute();
    }

    //City Resolution Exists
     public function CityResolutionExists($CityResolution, $CityResolutionCode, $CityResolutionYear, $CityResolutionID = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_city_resolution} WHERE varCityResolution = ? AND varCityResolutionCode = ? AND CityResolutionYear = ?";        
        if (!empty($CityResolutionID)) {
            $sql .= " AND intCityResolutionID != ?";
        }

        $stmt = $this->conn->prepare($sql);        
        if (!empty($CityResolutionID)){
            // Corrected: Only one 'i' for the last int ID
            $stmt->bind_param('sssi', $CityResolution, $CityResolutionCode, $CityResolutionYear, $CityResolutionID);
        } else {
            $stmt->bind_param('ssi', $CityResolution, $CityResolutionCode, $CityResolutionYear);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    //Check City Resolution File Exists
    public function cityResolutionFileExists($cityResolutionFile, $CityResolutionID = null) {
    $sql = "SELECT COUNT(*) FROM {$this->table_city_resolution} WHERE CityResolutionFile = ?";
    if (!empty($CityResolutionID)) {
        $sql .= " AND intCityResolutionID != ?";
    }

    $stmt = $this->conn->prepare($sql);
    if (!empty($CityResolutionID)) {
        $stmt->bind_param('si', $cityResolutionFile, $CityResolutionID);
    } else {
        $stmt->bind_param('s', $cityResolutionFile);
    }
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

    //For Delete
    public function getCityResolution($CityResolutionID) {
        $query = "SELECT CityResolutionFile FROM {$this->table_city_resolution} WHERE intCityResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $CityResolutionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //Delete Board Resolution
    public function deleteCityResolution($CityResolutionID) {
        $query = "DELETE FROM {$this->table_city_resolution} WHERE intCityResolutionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $CityResolutionID);
        return $stmt->execute();
    }

    public function getAllCityResolution(){
        $query = "SELECT * FROM {$this->table_city_resolution} ORDER BY CityResolutionYear DESC";
        $result = $this->conn->query($query);
        $board_resolution = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $board_resolution[] = $row;
            }
        }return $board_resolution;
    }
    // --------------------------------------End City Resolution------------------------------------------------//

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



    public function addAccreditation($accreditation, $accreditationCode){
        $query ="INSERT INTO {$this->table_accreditation} (varAccredittaionName, varAccredCode) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $accreditation, $accreditationCode);
        return $stmt->execute();
    }

    public function updateAccreditation($accreditation, $accreditationCode, $accreditationID = null){
        $query = "UPDATE {$this->table_accreditation} SET varAccredittaionName = ?, varAccredCode = ? WHERE intAccredID =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $accreditation, $accreditationCode, $accreditationID);
        return $stmt->execute();
    }

    //Check duplicate Accreditation
    public function accreditationExist($accreditation, $accreditationCode, $accreditationID = null){
        $sql = "SELECT COUNT(*) FROM {$this->table_accreditation} WHERE (varAccredittaionName = ? AND varAccredCode = ?)";
        if (!empty($accreditationID)) {
            $sql .= " AND intAccredID != ?";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($accreditationID)){
            $stmt->bind_param('ssi', $accreditation, $accreditationCode, $accreditationID);
        }else{
            $stmt->bind_param('ss', $accreditation, $accreditationCode);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

    public function getAllArea(){
         $query = "SELECT * FROM {$this->table_area}";
        $result = $this->conn->query($query);
        $area = [];

        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $area[] = $row;
            }
        }return $area;
    }

    public function addArea($areaCode, $areaDescription){
        $query ="INSERT INTO {$this->table_area} (varAreaCode, varAreaDescription) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $areaCode, $areaDescription);
        return $stmt->execute();
    }

    public function updateArea($areaCode, $areaDescription, $AreaID = null){
        $query = "UPDATE {$this->table_area} SET varAreaCode = ?, varAreaDescription = ? WHERE intAreaID =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $areaCode, $areaDescription, $AreaID);
        return $stmt->execute();
    }

    //Check duplicate Accreditation
    public function areaExist($areaCode, $areaDescription, $AreaID = null){
        $query = "SELECT COUNT(*) FROM {$this->table_area} WHERE (varAreaCode = ? AND varAreaDescription = ?)";
        if (!empty($AreaID)) {
            $query .= " AND intAreaID != ?";
        }

        $stmt = $this->conn->prepare($query);
        if (!empty($AreaID)){
            $stmt->bind_param('ssi', $areaCode, $areaDescription, $AreaID);
        }else{
            $stmt->bind_param('ss', $areaCode, $areaDescription);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

     //Select All Child Per User
    public function getAllChild($employeeID) {       
        $child = []; // Initialize array    
        // Use prepared statement
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_child} WHERE varEmployeeID = ?");
        $stmt->bind_param("s", $employeeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $child[] = $row;
            }
        }
        
        $stmt->close(); 
        return $child;
    }

    public function addChild($employeeNumber, $childName, $childBirthday){
        $query ="INSERT INTO {$this->table_child} (varEmployeeID, varChildName, dateChildBirthday) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $employeeNumber, $childName, $childBirthday);
        return $stmt->execute();
    }

    public function updateChild($childName, $childBirthday, $childID = null){
        $query = "UPDATE {$this->table_child} SET varChildName = ?, dateChildBirthday = ? WHERE intChildID  =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $childName, $childBirthday, $childID);
        return $stmt->execute();
    }

    //Delete Child
    public function deletechild($childID) {
        $query = "DELETE FROM {$this->table_child} WHERE intChildID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $childID);
        return $stmt->execute();
    }

   // Check if child name OR child name + birthday exists
    public function childExists($employeeNumber, $childName, $childBirthday, $childID = null) {
       
        $query = "SELECT COUNT(*) 
            FROM {$this->table_child} 
            WHERE (
                (varChildName = ? AND varEmployeeID = ?) 
                OR (varChildName = ? AND dateChildBirthday = ? AND varEmployeeID = ?))";

        if (!empty($childID)) {
            $query .= " AND intChildID != ?";
        }

        $stmt = $this->conn->prepare($query);

        if (!empty($childID)) {
            // Bind parameters with exclusion
            $stmt->bind_param(
                'ssssis',
                $childName,
                $employeeNumber,
                $childName,
                $childBirthday,
                $employeeNumber,
                $childID
            );
        } else {
            $stmt->bind_param(
                'sssss',
                $childName,
                $employeeNumber,
                $childName,
                $childBirthday,
                $employeeNumber
            );
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    public function getAllContract($employeeID){
        $contract = []; // ✅ Initialize
        $query = "SELECT a.*, b.* 
        FROM {$this->table_contract} a 
        INNER JOIN {$this->table_position} b ON b.intPositionID  = a.intPositionID  WHERE a.intEmployeeID = ? LIMIT 1";
       
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("SQL prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $employeeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contract[] = $row;
            }
        }
        
        $stmt->close(); 
        return $contract;
    }

    public function getAllEducation($employeeID){
        $education = []; // ✅ Initialize
        $query = "SELECT *
        FROM {$this->table_educational} WHERE intEmployeeID = ? LIMIT 1";
       
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("SQL prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $employeeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $education[] = $row;
            }
        }
        
        $stmt->close(); 
        return $education;
    }




}// --/EmployeeModel---

?>