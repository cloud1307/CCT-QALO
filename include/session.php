<?php 
session_start();
include 'include/config.php';

	if (!isset($_SESSION['cct-qalo-id']) && !isset($_SESSION['enumUser_Level'])){
		header('location: login.php');
	}

    $id_session = $_SESSION['cct-qalo-id'];
    $userlevel = $_SESSION['enumUser_Level'];

    $sql ="SELECT * FROM tbl_account WHERE intAccount_ID '".$_SESSION['cct-qalo-id']."' ";
    $query = $conn -> query($sql);
    $acctnt_user = $query->fetch_assoc();
?>