<?php
require_once '../model/addressModel.php';

class AddressController {
    private $model;

    public function __construct() {
        $this->model = new AddressModel();
    }

    public function getCities($provCode) {
        $cities = $this->model->getCitiesByProvince($provCode);
        header('Content-Type: application/json');
        echo json_encode($cities);
    }

    public function getBarangays($cityMunCode) {
        $barangays = $this->model->getBarangaysByCity($cityMunCode);
        header('Content-Type: application/json');
        echo json_encode($barangays);
    }
}
?>