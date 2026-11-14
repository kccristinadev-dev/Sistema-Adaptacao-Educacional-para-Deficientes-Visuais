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
<link rel="stylesheet" href="<?= htmlspecialchars($cssTela ?? '../css/TelaProfessor.css') ?>">
    <link rel="stylesheet" href="../css/corPadrao.css">

    <!-- Título -->
    <title>DORINA_Tela</title>

   
   
    
</head>

<body class="<?= htmlspecialchars(implode(' ', $classesAdaptacao ?? []), ENT_QUOTES, 'UTF-8') ?>">
<main id="app" tabindex="-1">
    <h1>Olá, <?= htmlspecialchars($nome) ?>!</h1>  

</main> 
<script>
    const nome = <?= json_encode($nome, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    const atividades = <?= json_encode($atividades ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    const respostas = <?= json_encode($respostas ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    const turmas = <?= json_encode($turmas ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
</script>

<script src="../acoes/exportarBrf.js" defer></script>
<script src="<?= $jsTela ?>" defer></script>

<?php foreach ($jsFuncoes as $arquivo): ?>
    <script src="<?= htmlspecialchars($arquivo) ?>" defer>
        
    </script>
<?php endforeach; ?>
</body>
</html>
