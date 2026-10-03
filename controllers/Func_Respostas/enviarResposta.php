<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require "../../config/conexao.php";
require "../../models/Resposta.php";

$respostaModel = new Resposta($conexao);


// ==============================
// ENVIAR RESPOSTA
// ==============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


echo json_encode([
    "id_atividade" => $_POST['id_atividade'] ?? null,
    "resposta" => $_POST['resposta'] ?? null,
    "arquivo" => $_FILES['arquivo']['name'] ?? null
]);
exit;

    $id_atividade = $_POST['id_atividade'] ?? null;
    $resposta = $_POST['resposta'] ?? '';
    $id_aluno = $_SESSION['id_aluno'] ?? null;

    $arquivo = null;


    // ==============================
    // VERIFICAR LOGIN
    // ==============================

    if (!$id_aluno || ($_SESSION['perfil'] ?? '') !== 'aluno') {

        http_response_code(403);

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Acesso não permitido."
        ]);

        exit;
    }


    // ==============================
    // VERIFICAR RESPOSTA
    // ==============================

    if (!$id_atividade) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "A atividade não foi identificada."
    ]);

    exit;
}


if (trim($resposta) === '') {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Digite uma resposta antes de enviar a atividade."
    ]);

    exit;
}


    // ==============================
    // ARQUIVO
    // ==============================

    if (
        isset($_FILES['arquivo']) &&
        $_FILES['arquivo']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        if ($_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {

            http_response_code(400);

            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Erro ao enviar o arquivo."
            ]);

            exit;
        }


        $nomeOriginal = basename(
            $_FILES['arquivo']['name']
        );

        $extensao = strtolower(
            pathinfo(
                $nomeOriginal,
                PATHINFO_EXTENSION
            )
        );


        $extensoesPermitidas = [
            'pdf',
            'doc',
            'docx',
            'odt',
            'txt',
            'jpg',
            'jpeg',
            'png',
            'mp3',
            'brf'
        ];


        if (!in_array($extensao, $extensoesPermitidas)) {

            http_response_code(400);

            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Tipo de arquivo não permitido."
            ]);

            exit;
        }


        $pasta = "../../uploads/respostas/";


        if (!is_dir($pasta)) {
            mkdir($pasta, 0775, true);
        }


        $nomeArquivo =
            time() . "_" . $nomeOriginal;


        $destino =
            $pasta . $nomeArquivo;


        if (
            !move_uploaded_file(
                $_FILES['arquivo']['tmp_name'],
                $destino
            )
        ) {

            http_response_code(500);

            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Erro ao salvar o arquivo."
            ]);

            exit;
        }


        $arquivo = $nomeArquivo;
    }


    // ==============================
    // CADASTRAR RESPOSTA
    // ==============================

    try {

        $id_resposta =
            $respostaModel->cadastrarResposta(
                $resposta,
                $arquivo,
                $id_atividade,
                $id_aluno
            );


        echo json_encode([
            "sucesso" => true,
            "id_resposta" => $id_resposta,
            "mensagem" => "Resposta enviada com sucesso."
        ]);

    } catch (PDOException $e) {

        http_response_code(500);

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Erro ao cadastrar resposta."
        ]);
    }
}
