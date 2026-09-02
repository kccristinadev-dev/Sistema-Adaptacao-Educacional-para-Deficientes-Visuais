
<?php

session_start();
require "../config/conexao.php";
if (!isset($_SESSION['id_pessoa'], $_SESSION['perfil'])) {
    header("Location: ../index.php");
    exit;
}


$id_pessoa = $_SESSION['id_pessoa'];
$perfil = $_SESSION['perfil'];

if ($perfil === "aluno") {
    require "../models/Aluno.php";

    $aluno = new Aluno($conexao);
    $dados = $aluno->buscarAluno($id_pessoa);

    $nome = $dados['nome'] ?? '';
}

elseif ($perfil === "professor") {
    require "../models/Professor.php";

    $professor = new Professor($conexao);
    $dados = $professor->buscarProf($id_pessoa);

    $nome = $dados['nome'] ?? '';
}


elseif ($perfil === "admin") {
    require "../models/Admin.php";

    $admin = new Admin($conexao);
    $dados = $admin->buscarAdm($id_pessoa);

    $nome = $dados['nome'] ?? '';
}