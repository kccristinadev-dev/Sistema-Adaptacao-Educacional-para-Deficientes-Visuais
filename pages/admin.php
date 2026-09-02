<?php

session_start();
require "../config/conexao.php";
require "../controllers/usuarioLogado.php";

if ($_SESSION['perfil'] !== 'admin') {
    header("Location: ../pages/dashboard.php");
    exit;
}

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
    <link rel="stylesheet" href="../css/admInicio.css">
    <link rel="stylesheet" href="../css/corPadrao.css">

    <!-- Título -->
    <title>DORINA_Tela_admin</title>

   
   
    
</head>

<body class="<?= $necessidade ?>">
<header>
<img class="logo_dorina" src="imagens/logo.jpg" alt="logo dorina" />
        <?php include "menuAdm.php"; ?>
    <h3>Olá, <?= htmlspecialchars($nome) ?>! essa é sua área administrativa</h3>

</header>
    <main>

        <!-- CONTEÚDO PRINCIPAL -->
        <section id="conteudo-admin">
  
        <!-- SELEÇÃO DE CONTEUDO-->
        
  <button id="btn-alunos" class="bnt"><h3>Alunos</h3></button>
  
    <button id="btn-professores" class="bnt"><h3>Professores</h3></button>
    
    <button id="btn-turmas" class="bnt">
        <h3>Turmas</h3></button>
     <button id="btn-necessidades" class="bnt"><h3>Necessidades</h3></button>
     
              <button id="btn-materia" class="bnt">
        <h3>Matérias</h3></button> 

           <!--CONTEUDO-->
    <div id="painel"></div>       

</section>
      
    </main>
        <script src="../acoes/telaforms.js" defer></script>

    <script src="../acoes/admFuncoes.js" defer></script>

        </body>
</html>
