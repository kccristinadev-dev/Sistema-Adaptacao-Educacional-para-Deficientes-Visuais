<?php

session_start();

require "../../config/conexao.php";
require "../../models/Materia.php";
require "../../models/Atividade.php";

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

$materia = new Materia($conexao);
$atividade = new Atividade($conexao);


/* LISTAR MATÉRIAS DO PROFESSOR */
if ($acao === 'listar_materias') {

    $materias = $materia->listarMateriasProfessor(
        $_SESSION['id_professor']
    );

    foreach ($materias as $materia) {
        echo "<option value='{$materia['id_materia']}'>
                {$materia['nome']}
              </option>";
    }

    exit;
}


/* CADASTRAR ATIVIDADE */
if ($acao === 'cadastrar_atividade') {

    $sucesso = $atividade->cadastrarAtividade(
        $_POST['titulo'],
        $_POST['descricao'],
        $_FILES['arquivo'] ?? null,
        $_POST['id_materia'],
        $_POST['id_turma']
    );

    if ($sucesso) {
        header("Location: ../../pages/professor.php?sucesso=atividade");
        exit;
    }

    header("Location: ../../pages/professor.php?erro=cadastro");
    exit;
}