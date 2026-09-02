<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "../config/conexao.php";

$perfil = $_GET['perfil'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Configuração básica -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <meta name="description" content="Descrição do projeto">
    <meta name="keywords" content="sistema, web, projeto">
    <meta name="author" content="Dorina">

 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=local_library,mic,school">
 
    <!-- CSS -->
<link rel="stylesheet" href="../css/login.css">

    <!-- Título -->
    <title>DORINA- login</title>


</head>

<body>
  <main id="conteudo">
      
      
  </main>  
  <script src="../acoes/login.js" defer></script>
</body>
</html>

