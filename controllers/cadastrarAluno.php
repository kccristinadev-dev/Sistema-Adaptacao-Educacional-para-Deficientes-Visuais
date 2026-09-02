<?php
session_start();
require "../../config/conexao.php";
require "../../models/Admin.php";

$admin = new Admin($conexao);


$sucesso = $admin->cadastrarAluno(
    $_POST['nome'],
    $_POST['email'],
    $_POST['cpf'],
    $_POST['telefone'],
    $_POST['senha'],
    $_POST['matricula'],
        $_POST['id_turma'],
    $_POST['necessidades'] ?? []
);
if ($sucesso) {
    header("Location: ../../pages/admin.php?sucesso=aluno");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;

?>