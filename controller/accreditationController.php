<?php 
require_once '../model/accreditationModel.php';

class accreditationModel
{
    private $model;

    public function __construct() {
        $this->model = new AccreditationModel();
    }

}

?>