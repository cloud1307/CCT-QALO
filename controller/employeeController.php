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
if (isset($_GET['action']) && $_GET['action'] == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST'
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



if (isset($_GET['action']) && $_GET['action'] === 'addSchool' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $schName = strtoupper(trim($_POST['schoolName'])); // Convert to Uppercase
    $schCode = strtoupper(trim($_POST['schoolCodeName'])); // Check for duplicates
    $category = trim($_POST['deptCategory']);
    $schid = $_POST['school_id'] ?? null;

    //Validate User Input
    if (empty($schName) || empty($schCode) || empty($category)) {
        echo json_encode(['status' => 'warning', 'message' => 'All fields are required.']);
        exit;
    }

    $model = new EmployeeModel();

    // Check for duplicates
    if ($model->schoolExists($schName, $schCode, $schid)) {
        echo json_encode(['status' => 'warning', 'message' => 'School already exists.']);
        exit;
    }

    $success = false;
    $message = '';

    if (!empty($schid)) {
        $success = $model->updateSchool($schid, $schName, $schCode, $category);
        $message = 'School updated successfully.';
    } else {
        $success = $model->addSchool($schName, $schCode, $category);
        $message = 'School added successfully.';
    }

    echo json_encode([
        'status' => $success ? 'success' : 'error',
        'message' => $success ? $message : 'Database operation failed.'
    ]);
    exit;
}


?>

