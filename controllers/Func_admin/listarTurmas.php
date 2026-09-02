<?php

require "../../config/conexao.php";
require "../../models/Turma.php";

$turma = new Turma($conexao);

$turmas = $turma->listarTurmas();

header('Content-Type: application/json');

echo json_encode($turmas);
?>