const app = document.getElementById("app");
app.innerHTML = "";

function escaparHtml(valor) {
    return String(valor ?? "").replace(/[&<>"']/g, caractere => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    })[caractere]);
}

app.innerHTML = `
    <a class="skip-link" href="#resumo">Pular para o conteúdo principal</a>
    <aside class="menu-professor">

        <h1>DORINA</h1>

        <nav aria-label="Menu principal">
            <button type="button" id="btnInicio" class="ativo" aria-controls="resumo">Início</button>
            <button type="button" id="btnAtividades" aria-controls="atividades">Atividades</button>
            <button type="button" id="btnRespostas" aria-controls="respostas">Respostas</button>
            <button type="button" id="btnTurmas" aria-controls="turmas">Turmas</button>
        </nav>

    </aside>

<header>
    <p>Olá,</p>
    <h1>${escaparHtml(nome)}</h1>
    <span>Área do professor</span>
</header>
<section id="resumo" class="tela ativa" aria-labelledby="tituloResumo">
    <h2 id="tituloResumo">Resumo</h2>

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

    <section id="atividades" class="tela" aria-labelledby="tituloAtividades">
        <h2 id="tituloAtividades">Minhas atividades</h2>

        <button type="button" id="btnCriarAtividade">
            Criar atividade
        </button>
<div id="formularioAtividade"></div>
        <div id="listaAtividades">
        </div>
    </section>

    <section id="respostas" class="tela" aria-labelledby="tituloRespostas">
        <h2 id="tituloRespostas">Respostas dos alunos</h2>

        <div id="listaRespostas" aria-live="polite">
        </div>
    </section>

    <section id="turmas" class="tela" aria-labelledby="tituloTurmas">
        <h2 id="tituloTurmas">Minhas turmas</h2>

        <div id="listaTurmas">
        </div>
    </section>
`;

const listaRespostas = document.getElementById("listaRespostas");
if (respostas.length === 0) {
    const vazio = document.createElement("p");
    vazio.textContent = "Nenhuma resposta foi entregue ainda.";
    listaRespostas.appendChild(vazio);
} else {
    respostas.forEach(resposta => {
        const card = document.createElement("article");
        card.className = "card-resposta";

        const titulo = document.createElement("h3");
        titulo.textContent = resposta.titulo;
        const aluno = document.createElement("p");
        aluno.textContent = `Aluno: ${resposta.nome_aluno}`;
        const materia = document.createElement("p");
        materia.textContent = `Matéria: ${resposta.materia}`;
        const status = document.createElement("p");
        status.className = "status-entrega";
        status.textContent = `Status: ${resposta.status}`;
        const conteudo = document.createElement("p");
        conteudo.textContent = resposta.resposta;

        card.append(titulo, aluno, materia, status, conteudo);

        if (resposta.arquivo) {
            const arquivo = document.createElement("a");
            arquivo.href = `../uploads/respostas/${encodeURIComponent(resposta.arquivo)}`;
            arquivo.textContent = `Baixar arquivo: ${resposta.arquivo}`;
            arquivo.target = "_blank";
            arquivo.rel = "noopener noreferrer";
            card.appendChild(arquivo);
        }

        const data = document.createElement("p");
        data.textContent = `Entregue em: ${resposta.created_at}`;
        card.appendChild(data);
        listaRespostas.appendChild(card);
    });
}