<?php

session_start();
require "../config/conexao.php";

if (!isset($_SESSION['id_pessoa'], $_SESSION['perfil'])) {
    header("Location: ../index.php");
    exit;
}

try {

    $id_pessoa = $_SESSION['id_pessoa'];
    $perfil = $_SESSION['perfil'];

    if ($perfil === "aluno") {

        require "../models/Aluno.php";
        require "../models/Resposta.php";
        require "../models/Atividade.php";

        $aluno = new Aluno($conexao);
        $resposta = new Resposta($conexao);
        $atividade = new Atividade($conexao);

        $dados = $aluno->buscarAluno($id_pessoa);

        $nome = $dados['nome'] ?? '';
        $id_aluno = $dados['id_aluno'];

        $respostas = $resposta->listarRespostasAluno($id_aluno);
        $atividades = $atividade->listarAtividadeAluno($id_aluno);

        $jsTela = "../acoes/Aluno/TelaAluno.js";
        

        
    }

elseif ($perfil === "professor") {

    require "../models/Professor.php";
    require "../models/Atividade.php";
    require "../models/Resposta.php";
require "../models/Turma.php";


$turma = new Turma($conexao);
    $professor = new Professor($conexao);
    $atividade = new Atividade($conexao);
    $resposta = new Resposta($conexao);

    $dados = $professor->buscarProf($id_pessoa);
$turmas = $turma->listarTurmasProfessor($id_professor);
    $nome = $dados['nome'] ?? '';
    $id_professor = $dados['id_professor'];

    $_SESSION['id_professor'] = $id_professor;

    $atividades = $atividade->listarAtividadeProfessor($id_professor);
    $respostas = $resposta->listarRespostasProfessor($id_professor);

    $jsTela = "../acoes/Professor/TelaProfessor.js";
    $jsFuncoes = [
        "../acoes/Professor/menuProf.js",
  "../acoes/Professor/cadastrarAtividade.js"
    ];
}
    elseif ($perfil === "admin") {

        require "../models/Admin.php";

        $admin = new Admin($conexao);
        $dados = $admin->buscarAdm($id_pessoa);

        $nome = $dados['nome'] ?? '';

 }

}

catch (PDOException $e) {

    echo "Erro ao carregar os dados: " . $e->getMessage();
    exit;
}