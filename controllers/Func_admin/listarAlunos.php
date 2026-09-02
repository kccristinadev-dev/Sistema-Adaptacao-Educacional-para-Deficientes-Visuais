<?php
require "../../config/conexao.php";
require "../../models/Aluno.php";

$aluno = new Aluno($conexao);

$alunos = $aluno->listarAluno();

header('Content-Type: application/json');

echo json_encode($alunos);
?>