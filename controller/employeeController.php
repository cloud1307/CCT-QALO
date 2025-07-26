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

    // public function addSchool($schName, $schCode, $schid = null){
    //     $schName = strtoupper(trim($schName));
    //     $schCode = strtoupper(trim($schCode));

    //     $this->model->addSchool($schName, $schCode);

    // }

    public function addPosition($positionName, $id = null) {
        $positionName = ucwords(trim($positionName)); // Convert to Proper Case

        // Validate input
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
            $message = 'Position added successfully.';
        }

        if ($success) {
            return [
                'status' => 'success',
                'message' => $message
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Database operation failed.'
            ];
        }
    }
}

// ✅ Handle AJAX or form request
if (
    isset($_GET['action']) && 
    $_GET['action'] == 'add' && 
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    $positionName = $_POST['position'] ?? '';
    $id = $_POST['position_id'] ?? null;

    $controller = new EmployeeController();
    $response = $controller->addPosition($positionName, $id);

    if ($response['status'] === 'error') {
        http_response_code(500);
    }

    echo json_encode($response);
    exit;
}




if (isset($_GET['action']) && 
    $_GET['action'] == 'addSchool' && 
    $_SERVER['REQUEST_METHOD'] === 'POST') {
    $schName = strtoupper(trim($_POST['schoolName']));
    $schCode = strtoupper(trim($_POST['schoolCodeName']));
    $schid = $_POST['school_id'] ?? null;


    $model = new EmployeeModel();

    if (!empty($schid)) {
        $model->updateSchool($schid, $schName, $schCode); 
    } else {
        $model->addSchool($schName, $schCode);
    }
    exit;
}

?>

