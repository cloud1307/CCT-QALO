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
            $success = $this->model->addSchoolProgram($schid, $schProgram, $progCode);
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
            $message = 'Major Program added Successfully.';
        }else{
            $success = $this->model->addMajorProgram($progid, $majorcourse);
            $message = 'Major Program added Successfully.';
        }
        return[
                'status' => $success ? 'success' : 'error',
                'message' => $success ? $message : 'Database operation failed.'
            ];
    }

    public function AcademicResolutions($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID = null){
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

        // Check for duplicates
            // if ($this->model->academicResolutionExists($academicReslution, $academicResolutionCode, $academicResolutionYear, !empty($academicResolutionID) ? $academicResolutionID : null)) {
            //     return [
            //         'status' => 'warning',
            //         'message' => 'Academic Resolution already exists.'
            //     ];
            // }

            $success = false;
            $message = '';

            if(!empty($schProgid)){
                    $success = $this->model->updateAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
                    $message = 'Academic Resolution updated successfully.';
            }else{
                    $success = $this->model->addAcademicResolution($academicResolution, $academicResolutionCode, $academicResolutionYear);
                    $message = 'Academic Resolution added successfully.';
            }

            return[
                'status' => $success ? 'success' : 'error',
                'message' => $success ? $message : 'Database operation failed.'
                ];


    }

    public function BoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID = null, $isDeleteResolution = false, $resolutionFile = NULL){
        $boardResolution = strtoupper(trim($boardResolution));
        $boardResolutionCode = strtoupper(trim($boardResolutionCode));
        $boardResolutionYear = trim($boardResolutionYear);

        if ($isDeleteResolution && !empty($boardResolutionID)) {
            $success = $this->model->deleteBoardResolution($boardResolutionID);
            return [
                'status' => $success ? 'success' : 'error',
                'message' => $success ? 'Board Resolution deleted successfully.' : 'Failed to delete Board Resolution.'
            ];
        }

        if (empty($boardResolution) || empty($boardResolutionCode) || empty($boardResolutionYear)) {
            return ['status' => 'warning', 'message' => 'All fields are required.'];
        }

        $success = false;
        $message = '';

        if (!empty($boardResolutionID)) {
            $success = $this->model->updateBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID);
            $message = 'Board Resolution updated successfully.';
        } else {
            $success = $this->model->addBoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $resolutionFile);
            $message = 'Board Resolution added successfully.';
        }

        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? $message : 'Database operation failed'
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

handleAjaxAction('BoardResolution', function(){
    $boardResolution = $_POST['boardResolution'] ?? '';
    $boardResolutionCode = $_POST['resolutionCode'] ?? '';
    $boardResolutionYear = $_POST['resolutionYear'] ?? '';
    $boardResolutionID = $_POST['board_resolution_id'] ?? null;
    $isDeleteResolution = isset($_POST['deleteResolution']) && $_POST['deleteResolution'] === 'delete';
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileBoardResolution"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    // if ($_FILES["fileBoardResolution"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    if($imageFileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileBoardResolution"]["tmp_name"], $target_file)) {
            $controller = new EmployeeController();   
            return $controller->BoardResolution($boardResolution, $boardResolutionCode, $boardResolutionYear, $boardResolutionID, $isDeleteResolution, basename( $_FILES["fileBoardResolution"]["name"]));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
});

handleAjaxAction('AcademicResolution', function(){
    $academicResolution = $_POST['academicResolution'] ?? '';
    $academicResolutionCode = $_POST['academicresolutionCode'] ?? '';
    $academicResolutionYear = $_POST['academicResolutionYear'] ?? '';
    $academicResolutionID = $_POST['academic_resolution_id'] ?? null;
    $controller = new EmployeeController();    
    return $controller->AcademicResolutions($academicResolution, $academicResolutionCode, $academicResolutionYear, $academicResolutionID);
});
?>

