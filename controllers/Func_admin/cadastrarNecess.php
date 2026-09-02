<?php
session_start();
require "../../config/conexao.php";
require "../../models/Necessidade.php";

$necessidade = new Necessidade($conexao);

$idNecessidade = $necessidade->cadastrarNecessidade(
    $_POST['nome']
);

if ($idNecessidade) {
    header("Location: ../../pages/admin.php?sucesso=necessidade");
    exit;
}

header("Location: ../../pages/admin.php?erro=cadastro");
exit;

?>