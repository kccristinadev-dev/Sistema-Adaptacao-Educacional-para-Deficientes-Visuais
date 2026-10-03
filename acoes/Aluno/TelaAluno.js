const app = document.getElementById("app");

app.innerHTML = `
    <nav class="menu-aluno" aria-label="Menu principal">

        <button type="button" id="btnInicio">
            <span aria-hidden="true">⌂</span>
            <span>Início</span>
        </button>

        <button type="button" id="btnAtividades">
            <span aria-hidden="true">▣</span>
            <span>Atividades</span>
        </button>

        <button type="button" id="btnRespostas">
            <span aria-hidden="true">✓</span>
            <span>Minhas respostas</span>
        </button>

        <button type="button" id="btnAcessibilidade">
            <span aria-hidden="true">⚙</span>
            <span>Acessibilidade</span>
        </button>

    </nav>



        <!-- TELA INÍCIO -->
        <section id="resumo" class="tela ativa">

            <h1>Início</h1>

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

                <button type="button" id="leitorTela">
                    leitura
                </button>

            </div>

        </section>

`;


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
                    ${atividade.titulo}
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
                    ${atividade.materia}
                </p>

                <p>
                    <strong>Turmas:</strong>
                    ${atividade.turmas}
                </p>

                <p>
                    <strong>Publicada em:</strong>
                    ${atividade.created_at}
                </p>

            </div>


            <div
                id="${idDetalhes}"
                class="detalhes-atividade"
                hidden
            >





                <p>
                    <strong>Status:</strong>
                    ${atividade.status}
                </p>


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

    console.log("ID do botão:", idAtividade);

    abrirTelaResposta({
        ...atividade,
        id_atividade: idAtividade
    });

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

function abrirTelaResposta(atividade) {

    const telaResposta = document.createElement("section");

    telaResposta.id = "telaResposta";
    telaResposta.classList.add("tela-resposta");

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
                ${atividade.materia}
            </h4>


            <h1>
                ${atividade.titulo}
            </h1>


            <div class="enunciado-resposta">


                <p>
                    ${atividade.descricao}
                </p>

            </div>


            ${
                atividade.arquivo
                ? `
                    <div class="arquivo-resposta">

                        <h2>Arquivo da atividade</h2>

                        <a
                            href="../uploads/atividades/${atividade.arquivo}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            ${atividade.arquivo}
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
</div>
    `;


document.body.appendChild(telaResposta);

const formResposta = telaResposta.querySelector("#formResposta");

formResposta.addEventListener("submit", async (event) => {

    event.preventDefault();

    const dados = new FormData(formResposta);

   
dados.append("id_atividade", atividade.id_atividade);

    console.log("ATIVIDADE:", atividade);
    console.log("ID DA ATIVIDADE:", atividade.id_atividade);
    console.log("ID ENVIADO:", dados.get("id_atividade"));

    const respostaServidor = await fetch(
        "../controllers/Func_Respostas/enviarResposta.php",
        {
            method: "POST",
            body: dados
        }
    );

    const resultado = await respostaServidor.json();

    console.log(resultado);
});

    // ==============================
    // BOTÃO SAIR
    // ==============================

    const botaoSair =
        document.getElementById("btnSairResposta");

    botaoSair.addEventListener("click", () => {

        telaResposta.remove();

    });

}


