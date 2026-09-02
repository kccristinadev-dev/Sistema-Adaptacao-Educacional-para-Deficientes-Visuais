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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/corPadrao.css">

    <!-- Título -->
    <title>DORINA</title>

   
   
    
</head>

<body>


    <!-- CONTEÚDO PRINCIPAL -->
    <main>

        <!-- Seção principal -->
        <section class= "inicio">
       <div class="logo">
               <img src="imagens/logo.jpg" alt="Logotipo da DORINA, sistema inteligente de gestão escolar" />
</div>
            <h1>DORINA</h1>
            <p>Sistema Escolar Acessível</p>
            

        </section>
        <section class="inicio">
         <h2>Bem vindo(a)!</h2>
     <p>Selecione um perfil para entrar</p> 

        </section>

        <!-- Cards / conteúdo -->
     <section id= "cards" class="cards"> 


            <!-- Card / Opção de comando por voz-->
<article class="card-voz">
<a class="voz" onclick="ouvir()">
<h2>
<span class="material-symbols-outlined">
mic
</span>
  Ativar comando por voz</h2>
        <p>Converse com Dorina</p>
    </a>
</article>



        <!-- Card / Alunos -->
<a class="card-opcao" href="pages/login.php?perfil=aluno">      

            <article>
<span class="material-symbols-outlined">
local_library
</span>
             <h2>  ALUNO  </h2>
<p>Acesse atividades, materiais e avaliações.</p>

            </article>
 </a>
           
       <!-- Card / Professores -->
<a class="card-opcao" href="pages/login.php?perfil=professor">

            <article>
                 <span class="material-symbols-outlined">
school
</span>
            <h2>PROFESSOR</h2>
<p>Gerencie turmas, atividades e desempenho.</p>           
            </article>
    </a>
        

        </section>
             <p id="resposta"></p>

    </main>

    <!-- SIDEBAR -->
<footer>
    <h3>Informações adicionais</h3>
    <br>
    <nav>
        <a href="#">Sobre</a>
        <a href="#">Contato</a>
        <a href="#">Suporte</a>
  
    </nav>
     <br>
<a href="pages/login.php?perfil=admin">Acesso administrativo</a>
<br>
     <br>
    <p>&copy; 2026 Dorina</p>

</footer>
<script src="acoes/inicio.js" defer></script>
</body>
</html>