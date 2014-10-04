<?php 
session_start(); 
session_unset($_SESSION['usuario']);
header("location: ../index.html");
?>
