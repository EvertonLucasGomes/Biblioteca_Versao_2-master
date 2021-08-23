<?php
session_start();
if(!$_SESSION['user'] ){
    header('Location: ../index.php');
    exit();
}

if($_SESSION['cargo'] != "GERENTE"){
    header('Location: ../pages/home.php');
    exit();
}