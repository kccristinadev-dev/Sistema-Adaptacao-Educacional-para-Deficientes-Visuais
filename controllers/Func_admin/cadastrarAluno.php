
<?php

// Inicia a sessão com configurações mais seguras
session_start();

require_once "../config/conexao.php";
require_once "../models/Pessoa.php";

// Aceita somente requisições POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Método não permitido.");
}

// Recebe e valida os dados
$perfil = $_GET['perfil'] ?? '';
$usuario = trim($_POST['usuario'] ?? '');
$senha = $_POST['senha'] ?? '';

// Verifica se os campos foram preenchidos
if ($usuario === '' || $senha === '') {
    exit("Preencha todos os campos.");
}

// Verifica se o perfil é válido
$perfisPermitidos = ['aluno', 'professor', 'admin'];

if (!in_array($perfil, $perfisPermitidos, true)) {
    http_response_code(400);
    exit("Perfil inválido.");
}

try {

    $pessoa = new Pessoa($conexao);

    // Realiza a autenticação conforme o perfil
    switch ($perfil) {

        case 'aluno':
            $resultado = $pessoa->loginAluno($usuario, $senha);
            break;

        case 'professor':
            $resultado = $pessoa->loginProfessor($usuario, $senha);
            break;

        case 'admin':
            $resultado = $pessoa->loginAdmin($usuario, $senha);
            break;

        default:
            $resultado = false;
            break;
    }

    // Verifica se as credenciais são válidas
    if (!$resultado || !isset($resultado['id_pessoa'], $resultado['tipo'])) {
        exit("Usuário ou senha incorretos.");
    }

    // Confere se o perfil retornado corresponde ao solicitado
    if ($resultado['tipo'] !== $perfil) {
        exit("Usuário ou senha incorretos.");
    }

    // Evita fixação de sessão
    session_regenerate_id(true);

    // Armazena os dados necessários na sessão
    $_SESSION['id_pessoa'] = $resultado['id_pessoa'];
    $_SESSION['perfil'] = $resultado['tipo'];

    // Redireciona conforme o tipo de usuário
    if ($resultado['tipo'] === 'admin') {
        header("Location: ../pages/admin.php");
    } else {
        header("Location: ../pages/dashboard.php");
    }

    exit;

} catch (PDOException $e) {

    // Registra o erro internamente, sem expor detalhes ao usuário
    error_log("Erro no login: " . $e->getMessage());

    http_response_code(500);
    exit("Não foi possível realizar o login. Tente novamente.");

}
