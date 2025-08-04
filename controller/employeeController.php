<?php
require_once '../model/employeeModel.php';

class EmployeeController
{
    private $model;

    public function __construct() {
        $this->model = new EmployeeModel(); 
    }

    public function showForm() {
            $positions = $this->model->getAllPosition();
            $schools = $this->model->getAllSchool();
            $provinces = $this->model->getAllProvince();
            include '../view/employee.php'; // Load the view
        }
    public function addSchool($schName, $schCode, $category, $schid = null){
            $schName = strtoupper(trim($schName)); // Convert to Uppercase
            $schCode = strtoupper(trim($schCode)); // Check for duplicates
            $category = trim($category);


            //Validate User Input
        if (empty($schName) || empty($schCode) || empty($category)) {
            return[
                'status' => 'warning', 
                'message' => 'All fields are required.'
            ];
        }
        // Check for duplicates
        if ($this->model->schoolExists($schName, $schCode, !empty($schid) ?$schid : null )) {
            return[
                'status' => 'warning', 
                'message' => 'School already exists.'
            ];
        }
            $success = false;
            $message = '';
        
        if (!empty($schid)) {
            $success = $this->model->updateSchool($schid, $schName, $schCode, $category);
            $message = 'School updated successfully.';
        } else {
            $success = $this->model->addSchool($schName, $schCode, $category);
            $message = 'School added successfully.';
        }

        if ($success) {
            return[
        'status' => $success ? 'success' : 'error',
        'message' => $success ? $message : 'Database operation failed.'
        ];
        }
    }


    public function addSchoolProgram($schid, $schProgram, $progCode, $schProgid = null){
            $schid = trim($schid); 
            $schProgram = strtoupper(trim($schProgram)); // Convert to Uppercase
            $progCode = strtoupper(trim($progCode)); // Convert to Uppercase
            
            //Validate User Input
            if (empty($schid) || empty($schProgram) || empty($progCode)){
                return [
                    'status' => 'warning',
                    'message' => 'All fields are required.'
                ];
            }

            // Check for duplicates
            if ($this->model->schoolProgramExists($schProgram, $progCode, !empty($schProgid) ? $schProgid : null)) {
                return [
                    'status' => 'warning',
                    'message' => 'School Program already exists.'
                ];
            }

                $success = false;
                $message = '';

            if(!empty($schProgid)){
                    $success = $this->model->updateSchoolProgram($schProgid, $schid, $schProgram, $progCode);
                    $message = 'School Program updated successfully.';
            }else{
                    $success = $this->model->addSchoolProgram($schid, $schProgram, $progCode);
                    $message = 'School Program added successfully.';
            }

            return[
                'status' => $success ? 'success' : 'error',
                'message' => $success ? $message : 'Database operation failed.'
                ];
            
    }

    public function addPosition($positionName, $id = null) {
        $positionName = ucwords(trim($positionName)); // Convert to Proper Case
        // Validate user input
        if (empty($positionName)) {
            return [
                'status' => 'warning',
                'message' => 'Position field is required.'
            ];
        }

        // Check for duplicates
        if ($this->model->positionExists($positionName, !empty($id) ? $id : null)) {
            return [
                'status' => 'warning',
                'message' => 'Position already exists.'
            ];
        }

        $success = false;
        $message = '';

        if (!empty($id)) {
            // Update
            $success = $this->model->updatePosition($id, $positionName);
            $message = 'Position updated successfully.';
        } else {
            // Insert
            $success = $this->model->addPosition($positionName);            
            $message = 'Positon added successfully.';
        }
     
        return[
        'status' => $success ? 'success' : 'error',
        'message' => $success ? $message : 'Database operation failed.'
        ];
        

    }

    public function MajorProgram($progid, $majorcourse, $majorid = null){
        $progid = trim($progid);
        $majorcourse = strtoupper(trim($majorcourse));

        //Validate User Input
        if (empty($progid) || empty($majorcourse)){
            return [
                'status' => 'warning',
                'message' => 'All Fields are Required.'
            ];
        }

        //check for duplicates
        if ($this->model->majorProgramExists($progid, $majorcourse, !empty($majorid) ? $majorid : null)){
            return[
                'status' => 'warning',
                'message' => 'Major Program Already exists.'
            ];
        }

        $success = false;
        $message = '';

        if (!empty($majorid)){
            $success = $this->model->updateMajorProgram($progid, $majorcourse, $majorid);
            $message = 'Major Program updated Successfully.';
        }else{
            $success = $this->model->addMajorProgram($progid, $majorcourse);
            $message = 'Major Program added Successfully.';
        }
        return[
                'status' => $success ? 'success' : 'error',
                'message' => $success ? $message : 'Database operation failed.'
            ];
    }

    public function AcademicResolutions($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID = null, $academicResolutionFile = NULL){
        $academicResolution = strtoupper(trim($academicResolution));
        $academicResolutionCode = strtoupper(trim($academicResolutionCode));
        $academicResolutionYear = trim($academicResolutionYear);

        //Validate User Input
        if (empty($academicResolution) || empty($academicResolutionCode) || empty($academicResolutionYear)){
            return [
                'status' => 'warning',
                'message' => 'All Fields are required.'
            ];
        }

        //Check for duplicates
            if ($this->model->AcademicResolutionExists($academicResolution, $academicResolutionCode, $academicResolutionYear, !empty($academicResolutionID) ? $academicResolutionID : null)) {
                return [
                    'status' => 'warning',
                    'message' => 'Academic Resolution already exists.'
                ];
            }

            $success = false;
            $message = '';

            if(!empty($academicResolutionID)){
                    $success = $this->model->updateAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
                    $message = 'Academic Resolution updated successfully.';
            }else{
                    $success = $this->model->addAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionFile);
                    $message = 'Academic Resolution added successfully.';
            }

            return[
                'status' => $success ? 'success' : 'error',
                'message' => $success ? $message : 'Database operation failed.'
                ];


    }

   

    public function BoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID = null, $resolutionFile = null) {
        $boardResolution = strtoupper(trim($boardResolution));
        $boardResolutionCode = strtoupper(trim($boardResolutionCode));
        $boardResolutionYear = trim($boardResolutionYear);

        $target_dir = "../uploads/botupload/";
        $fileName = null;

        // Validation: required fields
        if (empty($boardResolution) || empty($boardResolutionCode) || empty($boardResolutionYear)) {
            return ['status' => 'warning', 'message' => 'All fields are required.'];
        }

        // Validation: check for duplicates
        if ($this->model->BoardResolutionExists($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID)) {
            return ['status' => 'warning', 'message' => 'Board Resolution already exists.'];
        }

        // File validation (only if uploading new file or filename changed)
        if (!empty($resolutionFile["name"])) {
            $fileName = basename($resolutionFile["name"]);
            $target_file = $target_dir . $fileName;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($fileType !== "pdf") {
                return ['status' => 'warning', 'message' => 'Invalid file type. Only PDF files are allowed.'];
            }

            // Check filename conflict with other records
            if ($this->model->ResolutionFileExists($fileName, $boardResolutionID)) {
                return ['status' => 'warning', 'message' => 'File name already used in another record. Please rename the file.'];            
            }

            // Upload new file
            if (!move_uploaded_file($resolutionFile["tmp_name"], $target_file)) {
                return ['status' => 'warning', 'message' => 'There was an error uploading your file.'];
            }
        }

    // Perform insert or update
    if (!empty($boardResolutionID)) {
        $existing = $this->model->getBoardResolution($boardResolutionID);
        $existingFile = $existing['resolutionFile'] ?? '';

        // Delete old file if a new file was uploaded and names differ
        if ($fileName !== $existingFile && file_exists($target_dir . $existingFile)) {
            unlink($target_dir . $existingFile);
        }

        $success = $this->model->updateBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID, $fileName);
        $message = 'Board Resolution updated successfully.';
    } else {
        $success = $this->model->addBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $fileName);
        $message = 'Board Resolution added successfully.';
    }

    return [
        'status' => $success ? 'success' : 'error',
        'message' => $success ? $message : 'Database operation failed.'
    ];
}

    ///Update Employment Status
    public function UpdateEmploymentStatus($EmploymentStatus, $employeeID = null) {
        $EmploymentStatus = trim($EmploymentStatus);

        // Validate User Input
        if (empty($EmploymentStatus)) {
            return [
                'status' => 'warning',
                'message' => 'Employment Status required.'
            ];
        }

        $success = false;
        $message = '';

        if (!empty($employeeID)) {
            $success = $this->model->updateEmployementStatus($EmploymentStatus, $employeeID);
            $message = 'Employment Status updated successfully.';
        }

        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? $message : 'Database operation failed.'
        ];
    }


    public function addEmployee() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeData = [
                'employeeNumber'   => $_POST['EmployeeNumber'],
                'lastName'         => strtoupper(trim($_POST['lastName'])),
                'firstName'        => strtoupper(trim($_POST['firstName'])),
                'middleName'       => strtoupper(trim($_POST['middleName'])),
                'extension'        => strtoupper(trim($_POST['extension'])),
                'gender'           => $_POST['gender'],
                'civilStatus'      => $_POST['civilStatus'],
                'dateOfBirth'      => $_POST['dateOfBirth'],
                'placeOfBirth'     => strtoupper(trim($_POST['placeofBirth'])),
                'houseNo'          => strtoupper(trim($_POST['houseNo'])),
                'street'           => strtoupper(trim($_POST['street'])),
                'province'         => $_POST['province'],
                'cityMun'          => $_POST['citymun'],
                'barangay'         => $_POST['barangay'],
                'school'           => $_POST['school'],
                'position'         => $_POST['position'],
                'employmentDate'   => $_POST['employmentDate'],
                'jobStatus'        => $_POST['jobStatus'],
                'jobCategory'      => $_POST['jobCategory'],
                'userlevel'        => $_POST['userlevel']
            ];

            $model = new EmployeeModel($this->db);
            $result = $model->addEmployee($employeeData);

             if ($result) {
                    $_SESSION['success'] = 'Employee added successfully.';
            } else {
                    $_SESSION['error'] = 'Failed to add employee.';
            }
                header('Location: ../view/view_employee.php');
                exit;

        }
    }

    public function deleteBoardResolution($board_resolution_id)
    {
        $existing = $this->model->getBoardResolution($board_resolution_id);
        $existingFile = $existing['resolutionFile'] ?? '';
        $filePath = '../uploads/botupload/' . $existingFile;

        $success = $this->model->deleteBoardResolution($board_resolution_id);
    
        if ($success) {
            if (file_exists($filePath)) unlink($filePath);
            echo json_encode(['status' => 'success', 'message' => 'Board Resolution deleted successfully.']);
            return ['status' => 'success', 'message' => 'Board Resolution deleted successfully.'];        
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Board Resolution.']);
            return ['status' => 'error', 'message' => 'Failed to delete Board Resolution.'];  
        }
    }

    public function Accreditation($accreditation, $accreditationCode, $accreditationID = null){
        $accreditation = strtoupper(trim($accreditation));
        $accreditationCode = strtoupper(trim($accreditationCode));

        //Validate User Input
        if (empty($accreditation) || empty($accreditationCode)){
            return [
                'status' => 'warning',
                'message' => 'All fields are required.'
            ];
        }

        //check for duplicates

        if($this->model->accreditationExist($accreditation, $accreditationCode, !empty($accreditationID) ? $accreditationID : null )){
            return [
                'status' => 'warning',
                'message' => 'Accreditation Already Exists.'
            ];
        }

        $success = false;
        $message = '';

        if(!empty($accreditationID)){
            //Update Accreditation
            $success = $this->model->updateAccreditation($accreditation, $accreditationCode, $accreditationID);
            $message = 'Accreditation update Successfully.';
        }else {
            $success = $this->model->addAccreditation($accreditation, $accreditationCode);
            $message = 'Accreditation added Successfully.';
        }

        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? $message : 'Database operation failed.'
        ];
    }


    public function Area($areaCode, $areaDescription, $AreaID = null){
        $areaCode = strtoupper(trim($areaCode));
        $areaDescription = strtoupper(trim($areaDescription));

        //Validate User Input
        if (empty($areaCode) || empty($areaDescription)){
            return [
                'status' => 'warning',
                'message' => 'All fields are required.'
            ];
        }

        //check for duplicates

        if($this->model->areaExist($areaCode, $areaDescription, !empty($AreaID) ? $AreaID : null )){
            return [
                'status' => 'warning',
                'message' => 'Area Already Exists.'
            ];
        }

        $success = false;
        $message = '';

        if(!empty($AreaID)){
            //Update Accreditation
            $success = $this->model->updateArea($areaCode, $areaDescription, $AreaID);
            $message = 'Area update Successfully.';
        }else {
            $success = $this->model->addArea($areaCode, $areaDescription);
            $message = 'Area added Successfully.';
        }

        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? $message : 'Database operation failed.'
        ];
    }
    

}

// Generic handler for AJAX/form actions
function handleAjaxAction($expectedAction, $handlerCallback) {
    if (isset($_GET['action']) && $_GET['action'] === $expectedAction && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = $handlerCallback();
        if ($response['status'] === 'error') {
            http_response_code(500);
        }
        echo json_encode($response);
        exit;
    }
}

// ✅ Handle Add/Update Position
handleAjaxAction('add', function () {
    $positionName = $_POST['position'] ?? '';
    $id = $_POST['position_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->addPosition($positionName, $id);
});

//Handle Add/Employee
if (isset($_GET['action']) && $_GET['action'] === 'addEmployee') {
    $controller = new EmployeeController($conn);
    $controller->addEmployee();
}

// ✅ Handle Add/Update School
handleAjaxAction('addSchool', function () {
    $schName = $_POST['schoolName'] ?? '';
    $schCode = $_POST['schoolCodeName'] ?? '';
    $category = $_POST['deptCategory'] ?? '';
    $schid = $_POST['school_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->addSchool($schName, $schCode, $category, $schid);
});

// ✅ Handle Add/Update School Program
handleAjaxAction('SchoolProgram', function(){
    $schid = $_POST['schoolProgram'] ?? '';
    $schProgram = $_POST['programDescription'] ?? '';
    $progCode = $_POST['programCode'] ?? '';
    $schProgid = $_POST['school_program_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->addSchoolProgram($schid, $schProgram, $progCode, $schProgid);
});

// ✅ Handle Add/Update major Program
handleAjaxAction('MajorProgram', function(){
    $progid = $_POST['ProgramDescription'] ?? '';
    $majorcourse = $_POST['majorProgram'] ?? '';
    $majorid = $_POST['major_program_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->MajorProgram($progid, $majorcourse, $majorid);
});

handleAjaxAction('BoardResolution', function () {
    $boardResolution = $_POST['boardResolution'] ?? '';
    $boardResolutionCode = $_POST['resolutionCode'] ?? '';
    $boardResolutionYear = $_POST['resolutionYear'] ?? '';
    $boardResolutionID = $_POST['board_resolution_id'] ?? null;
    $resolutionFile = $_FILES['fileBoardResolution'] ?? null;

    $controller = new EmployeeController();
    return $controller->BoardResolution(
        $boardResolution,
        $boardResolutionCode,
        $boardResolutionYear,
        $boardResolutionID,
        $resolutionFile
    );
});


handleAjaxAction('UpdateEmploymentStatus', function () {
    $EmploymentStatus = $_POST['employmentStatus'] ?? '';
    $employeeID = $_POST['employee_status_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->UpdateEmploymentStatus($EmploymentStatus, $employeeID);
});

// ✅ Handle Add/Update accreditation
handleAjaxAction('Accreditation', function () {
    $accreditation = $_POST['accreditation'] ?? '';
    $accreditationCode = $_POST['AccreditationCodeName'] ?? '';
    $accreditationID = $_POST['accreditation_id'] ?? null;
    $controller = new EmployeeController();
    //var_dump($controller);
    return $controller->Accreditation($accreditation, $accreditationCode, $accreditationID);
});


// ✅ Handle Add/Update Area
handleAjaxAction('Area', function () {
    $areaCode = $_POST['areaCode'] ?? '';
    $areaDescription = $_POST['areaDescription'] ?? '';
    $AreaID = $_POST['area_id'] ?? null;
    $controller = new EmployeeController();
    return $controller->Area($areaCode, $areaDescription, $AreaID);
});


handleAjaxAction('AcademicResolution', function () {
    $academicResolution = $_POST['academicResolution'] ?? '';
    $academicResolutionCode = $_POST['academicresolutionCode'] ?? '';
    $academicResolutionYear = $_POST['academicResolutionYear'] ?? '';
    $academicResolutionID = $_POST['academic_resolution_id'] ?? null;

    $target_dir = "../uploads/acadupload/";
    $fileName = basename($_FILES["academicFileResolution"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        return ['status' => 'error', 'message' => 'File already exists. Please rename and try again.'];
    }

    if ($imageFileType != "pdf") {
        return ['status' => 'error', 'message' => 'Invalid file type. Only PDF files are allowed.'];
    }

    if (!move_uploaded_file($_FILES["academicFileResolution"]["tmp_name"], $target_file)) {
        return ['status' => 'error', 'message' => 'There was an error uploading your file.'];
    }

    $controller = new EmployeeController();
    return $controller->AcademicResolutions($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID, $fileName);
});


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'deleteBoardResolution') {
    $boardResolutionID = intval($_POST['board_resolution_id']);
    $controller = new EmployeeController();
    return $controller->deleteBoardResolution($boardResolutionID);
}




?>

