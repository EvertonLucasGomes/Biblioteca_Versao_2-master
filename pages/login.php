<?php
session_start();
include('../scripts/persistencia/persistencia.php');
include("../scripts/facade/conexao.php");

if (empty($_POST['user']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$funcionario = persistencia::getInstance()->validarLogin($_POST['user'], $_POST['password']);

if ($funcionario) {
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['cargo'] = $funcionario->getCargo();

    if($funcionario->getCargo() == "GERENTE"){
        header('Location: gerenteHome.php');
        util::generateLog('Usuário Gerente logado.');
    }else{
        header('Location: Home.php');
        util::generateLog('Usuário Funcionário logado.');
    }
    exit();
} else {
    util::generateLog('Falha na autenticação.');
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../index.php');
    exit();
}
