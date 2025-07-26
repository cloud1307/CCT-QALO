<?php
require_once '../model/employeeModel.php';


class EmployeeController
{
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        //$this->model = new EmployeeModel($db);
    }

    public function showForm() {
        $positions = $this->model->getAllPosition();
        $schools = $this->model->getAllSchool();
        $provinces = $this->model->getAllProvince();
        include '../view/employee.php'; // Load the view
    }
    
}

if (
    isset($_GET['action']) && 
    $_GET['action'] == 'add' && 
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    $positionName = ucwords(trim($_POST['position']));
    $id = $_POST['position_id'];

    $model = new EmployeeModel();

    // Check for duplicate
    if ($model->positionExists($positionName, !empty($id) ? $id : null)) {
        echo json_encode([
            'status' => 'warning',
            'message' => 'Position already exists.'
        ]);
        exit;
    }

    $success = false;
    $message = '';

    if (!empty($id)) {
        // Update
        $success = $model->updatePosition($id, $positionName);
        $message = 'Position updated successfully.';
    } else {
        // Insert
        $success = $model->addPosition($positionName);
        $message = 'Position added successfully.';
    }

    if ($success) {
        echo json_encode([
            'status' => 'success',
            'message' => $message
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Database operation failed.'
        ]);
    }
    exit;
}


?>