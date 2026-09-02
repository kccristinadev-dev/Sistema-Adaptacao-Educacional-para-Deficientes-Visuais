<?php
session_start();
require "../../config/conexao.php";
require "../../models/Materia.php";

$materia = new Materia($conexao);

$materias = $materia->cadastrarMateria(
    $_POST['nome']
);

if ($materias) {
    header("Location: ../../pages/admin.php?sucesso=materia");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;

?>