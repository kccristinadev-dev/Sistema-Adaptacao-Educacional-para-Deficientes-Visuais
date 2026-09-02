<?php

session_start();

require "../../config/conexao.php";
require "../../models/Admin.php";

$admin = new Admin($conexao);

$sucesso = $admin->cadastrarProfessor(
    $_POST['nome'],
    $_POST['email'],
    $_POST['cpf'],
    $_POST['telefone'],
    $_POST['senha'],
            $_POST['id_turma']

);

if ($sucesso) {
    header("Location: ../../pages/admin.php?sucesso=professor");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;
?>