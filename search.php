<?php
session_start();

require_once 'include/connect.php';

if (!$_POST['search_value']) {
	header('location: index.php');
	die();
}	




$_SESSION['search'] = $_POST['search_value'];







	
	

	header('location: index.php');
	


?>