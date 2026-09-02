<?php

require "../../config/conexao.php";
require "../../models/Materia.php";

$materia = new Materia($conexao);

$materias = $materia->listarMaterias();

header('Content-Type: application/json');

echo json_encode($materias);
?>