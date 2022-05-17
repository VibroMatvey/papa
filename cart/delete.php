<?php

session_start();
unset($_SESSION['cart']);
header('location: main_cart.php');

?>