<?php

require "../../config/conexao.php";
require "../../models/Necessidade.php";

$necessidade = new Necessidade($conexao);

$necessidades = 
$necessidade->listarNecessidades();

header('Content-Type: application/json');

echo json_encode($necessidades);



