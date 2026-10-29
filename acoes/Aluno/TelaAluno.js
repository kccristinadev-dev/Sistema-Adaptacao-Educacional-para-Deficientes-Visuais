const app = document.getElementById("app");

app.innerHTML = `
    <a class="skip-link" href="#tituloInicio">Pular para o conteúdo principal</a>

    <nav class="menu-aluno" aria-label="Menu principal">

        <button type="button" id="btnInicio" aria-controls="resumo" aria-current="page">
            <span aria-hidden="true">⌂</span>
            <span>Início</span>
        </button>

        <button type="button" id="btnAtividades" aria-controls="atividades">
            <span aria-hidden="true">▣</span>
            <span>Atividades</span>
        </button>

        <button type="button" id="btnRespostas" aria-controls="respostas">
            <span aria-hidden="true">✓</span>
            <span>Minhas respostas</span>
        </button>

        <button type="button" id="btnAcessibilidade" aria-controls="acessibilidade">
            <span aria-hidden="true">⚙</span>
            <span>Acessibilidade</span>
        </button>

    </nav>



        <!-- TELA INÍCIO -->
        <section id="resumo" class="tela ativa">

            <h1 id="tituloInicio">Início</h1>

            <p>Bem-vindo ao sistema DORINA.</p>

            <div id="resumoAluno">

                <h2>Resumo</h2>

                <p>
                    Confira suas atividades e respostas.
                </p>

            </div>

        </section>


        <!-- TELA ATIVIDADES -->
        <section
            id="atividades"
            class="tela"
            aria-labelledby="tituloAtividades"
        >

            <h1 id="tituloAtividades">Atividades</h1>

            <div
                id="listaAtividades"
                aria-live="polite"
                aria-label="Lista de atividades"
            ></div>

        </section>


        <!-- TELA MINHAS RESPOSTAS -->
        <section
            id="respostas"
            class="tela"
            aria-labelledby="tituloRespostas"
        >

            <h1 id="tituloRespostas">Minhas respostas</h1>

            <div id="listaRespostas">

                <p>
                    Aqui serão exibidas suas respostas.
                </p>

            </div>

        </section>


        <!-- TELA ACESSIBILIDADE -->
        <section
            id="acessibilidade"
            class="tela"
            aria-labelledby="tituloAcessibilidade"
        >

            <h1 id="tituloAcessibilidade">Acessibilidade</h1>

            <p>
                Os recursos de acessibilidade disponíveis para você
                são aplicados de acordo com suas necessidades.
            </p>

            <div
                class="opcoes-acessibilidade"
                aria-label="Recursos de acessibilidade"
            >

                <button type="button" id="aumentarFonte">
                    Aumentar fonte
                </button>

                <button type="button" id="diminuirFonte">
                    Diminuir fonte
                </button>

                <button type="button" id="altoContraste">
                    Alto contraste
                </button>

                <button type="button" id="leitorTela" aria-pressed="false">
                    Ativar leitura em voz alta
                </button>

            </div>

            <p>
                A estrutura da página é compatível com leitores de tela.
                Use o leitor de tela instalado no dispositivo para navegar.
            </p>
            <p id="adaptacoesAtivas" aria-live="polite"></p>
            <p id="statusAcessibilidade" class="visually-hidden" aria-live="polite"></p>

        </section>

`;

const classesAdaptacao = document.body.classList;
const preferenciasAtribuidas = {
    altoContraste: classesAdaptacao.contains("adaptacao-alto-contraste"),
    fonteAmpliada: classesAdaptacao.contains("adaptacao-ampliacao-texto"),
    leitura: classesAdaptacao.contains("adaptacao-text-to-speech") ||
        classesAdaptacao.contains("adaptacao-audio-descricao")
};

const escalaInicial = Number.parseFloat(
    getComputedStyle(document.body).getPropertyValue("--escala-inicial-texto")
);
let escalaFonte = Number.isFinite(escalaInicial) ? escalaInicial : 1;
const botaoContraste = document.getElementById("altoContraste");
const botaoLeitura = document.getElementById("leitorTela");
const statusAcessibilidade = document.getElementById("statusAcessibilidade");
const adaptacoesAtivas = document.getElementById("adaptacoesAtivas");

const nomesAdaptacoes = [
    ["adaptacao-alto-contraste", "Alto contraste"],
    ["adaptacao-ampliacao-texto", "Ampliação do texto"],
    ["adaptacao-text-to-speech", "Leitura em voz alta"],
    ["adaptacao-audio-descricao", "Descrição em áudio"],
    ["adaptacao-leitor-de-tela", "Suporte a leitor de tela"],
    ["adaptacao-indicadores-textuais", "Indicadores que não dependem apenas de cores"]
];

const adaptacoesAplicadas = nomesAdaptacoes
    .filter(([classe]) => classesAdaptacao.contains(classe))
    .map(([, nome]) => nome);

adaptacoesAtivas.textContent = adaptacoesAplicadas.length
    ? `Adaptações aplicadas conforme suas necessidades: ${adaptacoesAplicadas.join(", ")}.`
    : "Nenhuma adaptação específica está cadastrada. Os recursos de teclado e leitor de tela continuam disponíveis.";

function aplicarPreferencias() {
    classesAdaptacao.toggle(
        "adaptacao-alto-contraste",
        botaoContraste.getAttribute("aria-pressed") === "true"
    );
    document.documentElement.style.fontSize = `${Math.round(escalaFonte * 100)}%`;
}

function escapeHtml(valor) {
    return String(valor ?? "").replace(/[&<>"']/g, caractere => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    })[caractere]);
}

    function formatarStatus(status) {
        const texto = String(status || "publicada");
        return texto.charAt(0).toLocaleUpperCase("pt-BR") + texto.slice(1);
    }
botaoContraste.setAttribute(
    "aria-pressed",
    String(preferenciasAtribuidas.altoContraste)
);
botaoLeitura.setAttribute("aria-pressed", String(preferenciasAtribuidas.leitura));
botaoLeitura.textContent = preferenciasAtribuidas.leitura
    ? "Desativar leitura em voz alta"
    : "Ativar leitura em voz alta";
aplicarPreferencias();

document.getElementById("aumentarFonte").addEventListener("click", () => {
    escalaFonte = Math.min(2, escalaFonte + 0.1);
    aplicarPreferencias();
    statusAcessibilidade.textContent = `Tamanho do texto aumentado para ${Math.round(escalaFonte * 100)}%.`;
});

document.getElementById("diminuirFonte").addEventListener("click", () => {
    escalaFonte = Math.max(1, escalaFonte - 0.1);
    aplicarPreferencias();
    statusAcessibilidade.textContent = `Tamanho do texto ajustado para ${Math.round(escalaFonte * 100)}%.`;
});

botaoContraste.addEventListener("click", () => {
    const ativo = botaoContraste.getAttribute("aria-pressed") !== "true";
    botaoContraste.setAttribute("aria-pressed", String(ativo));
    aplicarPreferencias();
    statusAcessibilidade.textContent = ativo
        ? "Alto contraste ativado."
        : "Alto contraste desativado.";
});

botaoLeitura.addEventListener("click", () => {
    const ativo = botaoLeitura.getAttribute("aria-pressed") !== "true";
    botaoLeitura.setAttribute("aria-pressed", String(ativo));
    botaoLeitura.textContent = ativo
        ? "Desativar leitura em voz alta"
        : "Ativar leitura em voz alta";
    const botaoLeituraAtividade = document.querySelector("#telaResposta .btn-ler-atividade");
    if (botaoLeituraAtividade) {
        botaoLeituraAtividade.hidden = !ativo;
    }
    statusAcessibilidade.textContent = ativo
        ? "Leitura em voz alta ativada. O botão de leitura aparece ao abrir uma atividade."
        : "Leitura em voz alta desativada.";
});

const listaRespostas = document.getElementById("listaRespostas");
listaRespostas.replaceChildren();

if (respostas.length === 0) {
    const vazio = document.createElement("p");
    vazio.textContent = "Você ainda não enviou respostas.";
    listaRespostas.appendChild(vazio);
} else {
    respostas.forEach(resposta => {
        const item = document.createElement("article");
        item.className = "card-resposta";
        const titulo = document.createElement("h2");
        titulo.textContent = resposta.titulo || "Resposta enviada";
        const status = document.createElement("p");
        status.textContent = "Status: Entregue";
        const conteudo = document.createElement("p");
        conteudo.textContent = resposta.resposta;
        item.append(titulo, status, conteudo);
        listaRespostas.appendChild(item);
    });
}

// ==============================
// LISTA DE ATIVIDADES
// ==============================

const lista = document.getElementById("listaAtividades");

atividades.forEach((atividade, indice) => {

    try {

        const item = document.createElement("article");

        item.classList.add("card-atividade");

        const idDetalhes = `detalhes-atividade-${indice}`;

        item.innerHTML = `

            <button
                type="button"
                class="cabecalho-atividade"
                aria-expanded="false"
                aria-controls="${idDetalhes}"
            >

                <span>
                    ${escapeHtml(atividade.titulo)}
                </span>

                <span
                    class="seta-atividade"
                    aria-hidden="true"
                >
                    ⌄
                </span>

            </button>


            <div
                class="resumo-atividade"
                aria-label="Resumo da atividade"
            >

                <p>
                    <strong>Matéria:</strong>
                    ${escapeHtml(atividade.materia)}
                </p>

                <p>
                    <strong>Turmas:</strong>
                    ${escapeHtml(atividade.turmas)}
                </p>

                <p>
                    <strong>Publicada em:</strong>
                    ${escapeHtml(atividade.created_at)}
                </p>

            </div>


            <div
                id="${idDetalhes}"
                class="detalhes-atividade"
                hidden
            >





                <p>
                    <strong>Status:</strong>
                    <span class="status-atividade">${escapeHtml(formatarStatus(atividade.status_aluno || atividade.status))}</span>
                </p>


                <p class="status-envio" role="status"></p>

                <div class="acoes-atividade">

      <button
         type="button"
         class="btn-responder"
 data-id-atividade="${atividade.id_atividade}"
                    >
                        Ver atividade
                    </button>

                </div>

            </div>
        `;


        // ==============================
        // ABRIR / FECHAR ATIVIDADE
        // ==============================

        const botaoAtividade =
            item.querySelector(".cabecalho-atividade");

        const detalhes =
            item.querySelector(".detalhes-atividade");


        botaoAtividade.addEventListener("click", () => {

            const aberto =
                botaoAtividade.getAttribute("aria-expanded") === "true";

            botaoAtividade.setAttribute(
                "aria-expanded",
                String(!aberto)
            );

            detalhes.hidden = aberto;

            item.classList.toggle("aberto", !aberto);

        });


        // ==============================
        // RESPONDER ATIVIDADE
        // ==============================

const botaoResponder =
    item.querySelector(".btn-responder");

botaoResponder.addEventListener("click", () => {

    const idAtividade =
        botaoResponder.dataset.idAtividade;

    abrirTelaResposta({
        ...atividade,
        id_atividade: idAtividade
    }, item);

});
        lista.appendChild(item);

    } catch (erro) {

        console.error(
            "Erro ao criar atividade:",
            atividade
        );

        console.error(
            "Detalhes do erro:",
            erro
        );

    }

});
// ==============================
// TELA DE RESPOSTA
// ==============================

function abrirTelaResposta(atividade, itemAtividade) {

    const telaResposta = document.createElement("section");

    telaResposta.id = "telaResposta";
    telaResposta.classList.add("tela-resposta");
    telaResposta.setAttribute("role", "dialog");
    telaResposta.setAttribute("aria-modal", "true");
    telaResposta.setAttribute("aria-labelledby", "tituloResposta");

    telaResposta.innerHTML = `

        <button
            type="button"
            class="btn-sair-resposta"
            id="btnSairResposta"
        >
            ← Sair
        </button>


        <div class="conteudo-resposta">

            <h4 class="materia-resposta">
                ${escapeHtml(atividade.materia)}
            </h4>


            <h1 id="tituloResposta">
                ${escapeHtml(atividade.titulo)}
            </h1>


            <div class="enunciado-resposta">


                <p>
                    ${escapeHtml(atividade.descricao)}
                </p>

            </div>

            <button type="button" class="btn-ler-atividade">
                Ler descrição em voz alta
            </button>

            ${
                atividade.arquivo
                ? `
                    <div class="arquivo-resposta">

                        <h2>Arquivo da atividade</h2>

                        <a
                            href="../uploads/atividades/${encodeURIComponent(atividade.arquivo)}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            ${escapeHtml(atividade.arquivo)}
                        </a>

                    </div>
                `
                : ''
            }


<form
    id="formResposta"
    action="../controllers/Func_Respostas/enviarResposta.php"
    method="POST"
    enctype="multipart/form-data"
>

    <div class="campo-resposta">

        <label for="respostaAluno">
            Sua resposta
        </label>

        <textarea
            id="respostaAluno"
            name="resposta"
            rows="10"
            placeholder="Digite sua resposta..."
            required
        ></textarea>

    </div>


    <div class="campo-resposta">

        <label for="arquivoResposta">
            Anexar arquivo
        </label>

        <input
            type="file"
            id="arquivoResposta"
            name="arquivo"
        >

    </div>


    <button
        type="submit"
        class="btn-enviar-resposta"
    >
        Enviar resposta
    </button>

</form>

<p class="status-envio" role="status" aria-live="polite"></p>
</div>
    `;


document.body.appendChild(telaResposta);
const botaoLerAtividade = telaResposta.querySelector(".btn-ler-atividade");
botaoLerAtividade.hidden = botaoLeitura.getAttribute("aria-pressed") !== "true";
const campoResposta = telaResposta.querySelector("#respostaAluno");
campoResposta.focus();

botaoLerAtividade.addEventListener("click", () => {
    if (!("speechSynthesis" in window)) {
        const status = telaResposta.querySelector(".status-envio");
        status.textContent = "Leitura em voz alta não está disponível neste navegador.";
        return;
    }

    window.speechSynthesis.cancel();
    const fala = new SpeechSynthesisUtterance(atividade.descricao);
    fala.lang = "pt-BR";
    window.speechSynthesis.speak(fala);
});

const formResposta = telaResposta.querySelector("#formResposta");

formResposta.addEventListener("submit", async (event) => {

    event.preventDefault();
    const statusEnvio = telaResposta.querySelector(".status-envio");
    statusEnvio.textContent = "Enviando resposta...";

    const dados = new FormData(formResposta);

    dados.append("id_atividade", atividade.id_atividade);

    try {
        const respostaServidor = await fetch(
            "../controllers/Func_Respostas/enviarResposta.php",
            {
                method: "POST",
                body: dados
            }
        );
        const resultado = await respostaServidor.json();

        if (!respostaServidor.ok || !resultado.sucesso) {
            throw new Error(resultado.mensagem || "Não foi possível enviar a resposta.");
        }

        statusEnvio.textContent = resultado.mensagem;
        atividade.status_aluno = "entregue";
        itemAtividade.querySelector(".status-atividade").textContent = "Entregue";
        itemAtividade.querySelector(".status-envio").textContent = resultado.mensagem;
        formResposta.querySelector(".btn-enviar-resposta").disabled = true;
    } catch (erro) {
        statusEnvio.textContent = erro.message;
    }
});

    // ==============================
    // BOTÃO SAIR
    // ==============================

    const botaoSair =
        document.getElementById("btnSairResposta");

    botaoSair.addEventListener("click", () => {

        if ("speechSynthesis" in window) {
            window.speechSynthesis.cancel();
        }
        telaResposta.remove();
        itemAtividade.querySelector(".btn-responder").focus();

    });

    telaResposta.addEventListener("keydown", evento => {
        if (evento.key === "Escape") {
            botaoSair.click();
            return;
        }

        if (evento.key === "Tab") {
            const elementos = Array.from(telaResposta.querySelectorAll(
                'button:not([disabled]):not([hidden]), input:not([disabled]), textarea:not([disabled]), a[href]'
            )).filter(elemento => elemento.getClientRects().length > 0);
            const primeiro = elementos[0];
            const ultimo = elementos[elementos.length - 1];

            if (evento.shiftKey && document.activeElement === primeiro) {
                evento.preventDefault();
                ultimo.focus();
            } else if (!evento.shiftKey && document.activeElement === ultimo) {
                evento.preventDefault();
                primeiro.focus();
            }
        }
    });

}
