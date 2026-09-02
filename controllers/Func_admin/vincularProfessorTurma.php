<?php
session_start();
require "../../config/conexao.php";
require "../../models/Turma.php";

$turma = new Turma($conexao);

$sucesso = $turma->vincularProfessorTurma(
    $_POST['id_professor'],
        $_POST['id_turma']

);

if ($sucesso) {
    header("Location: ../../pages/admin.php?sucesso=turma");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;
