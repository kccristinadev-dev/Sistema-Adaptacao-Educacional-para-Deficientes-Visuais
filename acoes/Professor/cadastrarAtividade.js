
function formatarData(data) {
    const dataObj = new Date(data.replace(" ", "T"));

    return dataObj.toLocaleDateString("pt-BR") +
        " às " +
        dataObj.toLocaleTimeString("pt-BR", {
            hour: "2-digit",
            minute: "2-digit"
        });
}
const lista = document.getElementById("listaAtividades");

atividades.forEach(atividade => {

    const item = document.createElement("div");
    item.classList.add("card-atividade");

    item.innerHTML = `
        <div class="cabecalho-atividade">
            <h3>${atividade.titulo}</h3>

            <span class="seta-atividade">⌄</span>
        </div>

        <div class="resumo-atividade">
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
        ${formatarData(atividade.created_at)}
    </p>
        </div>

<div class="detalhes-atividade">
    <div>
        <strong>Descrição</strong>
        <p>${atividade.descricao}</p>
    </div>


${
    atividade.arquivo
    ? `
        <div>
            <strong>Arquivo</strong>
            <p>
                <a 
                    class="arquivo-atividade"
                    href="../uploads/atividades/${atividade.arquivo}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    📎 ${atividade.arquivo}
                </a>
            </p>
        </div>
    `
    : ''
}

    <p>
        <strong>Status:</strong>
        ${atividade.status}
    </p>

</div>
    `;

const linkArquivo = item.querySelector(".arquivo-atividade");

if (linkArquivo) {
    linkArquivo.addEventListener("click", (evento) => {
        evento.stopPropagation();
    });
}

item.addEventListener("click", () => {
    item.classList.toggle("aberto");
});


    lista.appendChild(item);
});


const formularioAtividade = document.getElementById("formularioAtividade");
formularioAtividade.innerHTML = "";
document.getElementById("btnCriarAtividade").addEventListener("click", () => {

    formularioAtividade.classList.add("ativo");

  
    const formulario = document.createElement("form");

    formulario.action = "../controllers/Func_atividades/Atividade.php";
    formulario.method = "POST";
    formulario.enctype = "multipart/form-data";

formulario.innerHTML = `
<button type="button" id="fecharFormulario">Fechar</button>
    <h3>Criar atividade</h3>

    <input type="hidden" name="acao" value="cadastrar_atividade">

    <label for="titulo">Título da atividade</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descricao">Descrição</label>
    <textarea id="descricao" name="descricao" required></textarea>

    <label for="materia">Matéria</label>
    <select id="materia" name="id_materia" required>
        <option value="">Selecione uma matéria</option>
    </select>

    <label for="turmas">Turmas</label>
    <select id="turmas" name="id_turma[]" multiple required>
    </select>

    <label for="arquivo">Arquivo</label>
    <input type="file" id="arquivo" name="arquivo">

    <button type="submit">Criar atividade</button>
`;
    formularioAtividade.appendChild(formulario);
document.getElementById("fecharFormulario").addEventListener("click", () => {
    formularioAtividade.classList.remove("ativo");
    formularioAtividade.innerHTML = "";

});
    carregarMateriasProfessor();
    carregarturmasProfessor();

});


async function carregarMateriasProfessor() {

    try {

        const resposta = await fetch(
            "../controllers/Func_atividades/Atividade.php?acao=listar_materias"
        );

        console.log("Matérias - status:", resposta.status);
        console.log("Matérias - URL:", resposta.url);

        if (!resposta.ok) {
            throw new Error(
                `Erro HTTP ao carregar matérias: ${resposta.status}`
            );
        }

        const materias = await resposta.text();

        console.log("Matérias - resposta:", materias);

        document.getElementById("materia").innerHTML += materias;

    } catch (erro) {

        console.error("ERRO AO CARREGAR MATÉRIAS:", erro);

    }
}


async function carregarturmasProfessor() {

    try {

        const resposta = await fetch(
            "../controllers/Func_atividades/Atividade.php?acao=listar_turmas"
        );

        console.log("Turmas - status:", resposta.status);
        console.log("Turmas - URL:", resposta.url);

        if (!resposta.ok) {
            throw new Error(
                `Erro HTTP ao carregar turmas: ${resposta.status}`
            );
        }

        const turmas = await resposta.text();

        console.log("Turmas - resposta:", turmas);

        document.getElementById("turmas").innerHTML = turmas;

    } catch (erro) {

        console.error("ERRO AO CARREGAR TURMAS:", erro);

    }
}