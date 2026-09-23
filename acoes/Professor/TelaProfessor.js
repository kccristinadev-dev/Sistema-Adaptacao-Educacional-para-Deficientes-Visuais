const app = document.getElementById("app");
app.innerHTML = "";

app.innerHTML = `
    <aside class="menu-professor">

        <h1>DORINA</h1>

        <nav>
<button id="btnInicio" class="ativo">Início</button>
<button id="btnAtividades">Atividades</button>
            <button id="btnRespostas">Respostas</button>
            <button id="btnTurmas">Turmas</button>
        </nav>

    </aside>

<header>
    <p>Olá,</p>
    <h1>${nome}</h1>
    <span>Área do professor</span>
</header>
<section id="resumo" class="tela ativa">
        <h2>Resumo</h2>

        <div class="card-resumo">
            <h3>Atividades</h3>
            <strong>${atividades.length}</strong>
            <p>Total de atividades cadastradas</p>
        </div>

        <div class="card-resumo">
            <h3>Respostas</h3>
            <strong>${respostas.length}</strong>
            <p>Total de respostas</p>
        </div>

        <div class="card-resumo">
            <h3>Turmas</h3>
            <strong>${turmas.length}</strong>
            <p>Total de turmas</p>
        </div>

    </section>

    <section id="atividades" class="tela">
        <h2>Minhas atividades</h2>

        <button id="btnCriarAtividade">
            Criar atividade
        </button>
<div id="formularioAtividade"></div>
        <div id="listaAtividades">
        </div>
    </section>

    <section id="respostas" class="tela">
        <h2>Respostas dos alunos</h2>

        <div id="listaRespostas">
        </div>
    </section>

    <section id="turmas" class="tela">
        <h2>Minhas turmas</h2>

        <div id="listaTurmas">
        </div>
    </section>
`;