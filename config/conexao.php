<?php

$servername = "sql208.infinityfree.com";
$username   = "if0_41571166";
$password   = "sua_senha";
$dbname     = "if0_41571166_adapta_system";

try {
    $conexao = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erro na conexão.";
}
?>