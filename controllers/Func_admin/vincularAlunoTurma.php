<?php
session_start();
require "../../config/conexao.php";
require "../../models/Turma.php";

$turma = new Turma($conexao);

$sucesso = $turma->vincularAlunoTurma(
    $_POST['id_aluno'],
        $_POST['id_turma']

);

if ($sucesso) {
    header("Location: ../../pages/admin.php?sucesso=turma");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;

?>