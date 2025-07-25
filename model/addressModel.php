<?php
require_once '../config/config.php';

class AddressModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getCitiesByProvince($provCode) {
        $stmt = $this->conn->prepare("SELECT citymunCode, txtCityMunDesc FROM tbl_refcitymun WHERE varProvCode = ?");
        // die(var_dump($stmt));
        $stmt->bind_param("s", $provCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBarangaysByCity($cityMunCode) {
        $stmt = $this->conn->prepare("SELECT intBrgyID, txtBrgyDesc FROM tbl_refbarangay WHERE varCitymunCode = ?");
        $stmt->bind_param("s", $cityMunCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
