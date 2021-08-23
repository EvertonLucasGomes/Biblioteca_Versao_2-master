<?php
session_start();
include('../scripts/persistencia/persistencia.php');

if (empty($_POST['user']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$funcionario = persistencia::getInstance()->validarLogin($_POST['user'], $_POST['password']);

if ($funcionario != false) {
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['cargo'] = $funcionario->getCargo();

    if($funcionario->getCargo() == "GERENTE"){
        header('Location: gerenteHome.php');
    }else{
        header('Location: Home.php');
    }
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../index.php');
    exit();
}
