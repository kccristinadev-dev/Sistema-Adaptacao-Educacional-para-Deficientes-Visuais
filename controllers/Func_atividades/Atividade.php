<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require "../../config/conexao.php";
require "../../models/Materia.php";
require "../../models/Atividade.php";
require "../../models/Turma.php";

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';
$turma = new Turma($conexao);
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
if ($acao === 'listar_turmas') {

    $turmas = $turma->listarTurmasProfessor(
        $_SESSION['id_professor']
    );

    foreach ($turmas as $turmaItem) {
        echo "<option value='{$turmaItem['id_turma']}'>
                {$turmaItem['nome']}
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
        header("Location: ../../pages/dashboard.php?sucesso=atividade");
        exit;
    }

    header("Location: ../../pages/dashboard.php.php?erro=cadastro");
    exit;
}
