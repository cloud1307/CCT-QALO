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
        $citymun = $this->model->getAllCityMun();
        $barangay = $this->model->getAllBarangay();

        include '../view/employee.php'; // Load the view
    }

}


?>