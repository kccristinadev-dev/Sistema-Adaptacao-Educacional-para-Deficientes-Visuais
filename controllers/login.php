<?php

session_start();

require "../config/conexao.php";
require "../models/Pessoa.php";

$perfil = $_GET['perfil'] ?? '';

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

try {

    $pessoa = new Pessoa($conexao);

    if ($perfil === 'aluno') {

        $resultado = $pessoa->loginAluno($usuario, $senha);

    } elseif ($perfil === 'professor') {

        $resultado = $pessoa->loginProfessor($usuario, $senha);

    } elseif ($perfil === 'admin') {

        $resultado = $pessoa->loginAdmin($usuario, $senha);

    } else {

        die("Perfil inválido.");
    }

    if (!$resultado) {
        die("Usuário ou senha incorretos.");
    }

    $_SESSION['id_pessoa'] = $resultado['id_pessoa'];
    $_SESSION['perfil'] = $resultado['tipo'];

    if ($resultado['tipo'] === 'admin') {
        header("Location: ../pages/admin.php");
    } else {
      header("Location: ../pages/dashboard.php");
    }

    exit;

} catch (PDOException $e) {

    die("Erro ao realizar login.");
}