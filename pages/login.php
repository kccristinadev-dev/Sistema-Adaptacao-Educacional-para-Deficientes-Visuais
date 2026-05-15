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
    <!-- Título -->
    <title>DORINA</title>

  

    <!-- CSS -->
    <link rel="stylesheet" href="../css/index.css">

   
    <!-- Scripts do head -->
    <script src="../assets/js/script.js" defer></script>

</head>
<body>

    <div class="container">

        <div class="logo">
            DORINA
        </div>

        <h1>Login</h1>

        <form action="controllers/login.php" method="POST">


            <label for="email">E-mail</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                placeholder="Digite seu e-mail"
                required
            >

            <label for="senha">Senha</label>
            <input 
                type="password" 
                name="senha" 
                id="senha"
                placeholder="Digite sua senha"
                required
            >

            <button type="submit">
                Entrar
            </button>

        </form>

    </div>

</body>
</html>