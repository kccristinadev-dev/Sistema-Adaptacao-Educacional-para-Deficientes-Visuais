<?php

session_start();

require "../../config/conexao.php";
require "../../models/Turma.php";
require "../../models/Materia.php";

$turma = new Turma($conexao);
$materia = new Materia($conexao);

$idTurma = $turma->cadastrarTurma(
    $_POST['nome']
);

if ($idTurma) {

    // Pega as matérias selecionadas
    $materias = $_POST['materias'] ?? [];

    // Cria os relacionamentos
    foreach ($materias as $idMateria) {

        $materia->vincularTurmaMateria(
            $idTurma,
            $idMateria
        );
    }

    header("Location: ../../pages/admin.php?sucesso=turma");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;

?>