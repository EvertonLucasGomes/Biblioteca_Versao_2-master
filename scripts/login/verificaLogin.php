<?php
session_start();
if(!$_SESSION['user']){
    header('Location: ../index.php');
    exit();
}

if($_SESSION['cargo'] != "FUNCIONARIO"){
    header('Location: ../pages/gerenteHome.php');
    exit();
}