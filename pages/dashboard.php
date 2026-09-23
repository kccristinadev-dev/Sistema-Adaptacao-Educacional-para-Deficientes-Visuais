<?php
session_start();
require "../controllers/usuarioLogado.php";
require "../config/conexao.php";
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
<link rel="stylesheet" href="../css/TelaProfessor.css">
    <link rel="stylesheet" href="../css/corPadrao.css">

    <!-- Título -->
    <title>DORINA_Tela</title>

   
   
    
</head>

<body class="<?= htmlspecialchars($adptacao ?? '') ?>">        <!-- CONTEÚDO PRINCIPAL -->
<main id="app">
    <h1>Olá, <?= htmlspecialchars($nome) ?>!</h1>  

</main> 
<script>
    const nome = <?= json_encode($nome) ?>;
    const atividades = <?= json_encode($atividades ?? []) ?>;
    const respostas = <?= json_encode($respostas ?? []) ?>;
    const turmas = <?= json_encode($turmas ?? []) ?>;
</script>

<script src="<?= $jsTela ?>" defer></script>

<?php foreach ($jsFuncoes as $arquivo): ?>
    <script src="<?= htmlspecialchars($arquivo) ?>" defer>
        
    </script>
<?php endforeach; ?>
</body>
</html>
        
        
        
    </main>
        </body>
</html>
