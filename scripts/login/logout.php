<?php
include("../../scripts/util/util.php");
session_start();

util::generateLogLogout('Logout de usuário.');

session_destroy();
header('Location: ../../index.php');
