<?php

session_start();

require_once 'include/connect.php';



foreach($_SESSION['cart'] as $key => $value){
    if ($value == $_GET['id_item']){

     
      unset($_SESSION['cart'][$key]);
    }

   

    header('location: main_cart.php');
}


?>