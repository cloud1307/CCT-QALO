<?php
require_once '../model/employeeModel.php';


class EmployeeController
{
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new EmployeeModel($db);
    }

    public function showForm() {
        $positions = $this->model->getAllPosition();
        $schools = $this->model->getAllSchool();
        $provinces = $this->model->getAllProvince();
        //$citymun = $this->model->getAllCityMun();
        //$barangay = $this->model->getAllBarangay();

        include '../view/employee.php'; // Load the view
    }

    // public function fetchCityMunicipalityByProvince($provCode) {
    //     $cities = $this->model->getCityMunicipalityByProvince($provCode);
    //     header('Content-Type: application/json');
    //     echo json_encode($cities);
    // }

    // public function fetchBarangayByCityMunicipality($cityMunCode) {
    //     $barangays = $this->model->getBarangayByCityMunicipality($cityMunCode);
    //     header('Content-Type: application/json');
    //     echo json_encode($barangays);
    // }
}

// ✅ THIS SHOULD BE OUTSIDE THE CLASS
// if (isset($_POST['action'])) {
//     $controller = new EmployeeController(null);

//     if ($_POST['action'] === 'getCities' && isset($_POST['provCode'])) {
//         $controller->fetchCityMunicipalityByProvince($_POST['provCode']);
//     } elseif ($_POST['action'] === 'getBarangays' && isset($_POST['cityMunCode'])) {
//         $controller->fetchBarangayByCityMunicipality($_POST['cityMunCode']);
//     }
//     exit;
// }



// ADD THIS AT THE BOTTOM OF employeeController.php (outside the class)
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
//     require_once '../model/employeeModel.php';
//     require_once '../config/config.php'; // If not yet included

//     $db = new Database();
//     $conn = $db->connect();
//     $controller = new EmployeeController($conn);

//     if ($_POST['action'] === 'getCities' && isset($_POST['provCode'])) {
//         $controller->fetchCityMunicipalityByProvince($_POST['provCode']);
//     } elseif ($_POST['action'] === 'getBarangays' && isset($_POST['cityMunCode'])) {
//         $controller->fetchBarangayByCityMunicipality($_POST['cityMunCode']);
//     }
//     exit;
// }


?>