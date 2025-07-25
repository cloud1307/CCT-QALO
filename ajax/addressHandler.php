<?php
require_once '../config/config.php';
require_once '../controller/addressController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new AddressController();

    if ($_POST['action'] === 'getCities' && isset($_POST['provCode'])) {
        $controller->getCities($_POST['provCode']);
    } elseif ($_POST['action'] === 'getBarangays' && isset($_POST['cityMunCode'])) {
        $controller->getBarangays($_POST['cityMunCode']);
    }
}

?>