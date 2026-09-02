

painel.addEventListener("click", (event) => {

    /* =========================
       ABRIR FORMULÁRIO
    ========================= */

    const abrir = event.target.closest("[data-form]");

    if (abrir) {

        const form = document.getElementById(
            abrir.dataset.form
        );

        if (!form) return;

        /*
           Guarda o local original do formulário.
           Assim podemos devolver ele para lá depois.
        */

        const paiOriginal = form.parentElement;

        const marcador = document.createComment(
            "local-original-form"
        );

        paiOriginal.insertBefore(marcador, form);

        /* Cria o fundo escuro */

        const overlay = document.createElement("div");

        overlay.className = "form-overlay";

        /* Cria o bottom sheet */

        const sheet = document.createElement("div");

        sheet.className = "form-sheet";

        sheet.setAttribute("role", "dialog");
        sheet.setAttribute("aria-modal", "true");

        /* Barrinha */

        const handle = document.createElement("div");

        handle.className = "form-handle";
        handle.setAttribute("aria-hidden", "true");

        sheet.appendChild(handle);

        /* Move o formulário ORIGINAL */

        sheet.appendChild(form);

        form.hidden = false;

        overlay.appendChild(sheet);

        document.body.appendChild(overlay);

        /*
           Título acessível
        */

        const titulo = document.createElement("h2");

        const titulos = {
            "form-aluno": "Cadastrar aluno",
            "form-professor": "Cadastrar professor",
            "form-turma": "Cadastrar turma",
            "form-necessidade": "Cadastrar necessidade",
            "form-materia": "Cadastrar matéria"
        };

        titulo.textContent =
            titulos[form.id] || "Cadastro";

        titulo.id = "titulo-formulario";

        sheet.setAttribute(
            "aria-labelledby",
            "titulo-formulario"
        );

        sheet.insertBefore(titulo, form);

        /*
           Organiza os botões
        */

        const botoesAcao = form.querySelectorAll(
            'button[type="submit"], button[data-cancelar-form]'
        );

        if (botoesAcao.length > 0) {

            const acoes = document.createElement("div");

            acoes.className = "form-acoes";

            botoesAcao.forEach(botao => {
                acoes.appendChild(botao);
            });

            form.appendChild(acoes);
        }

        /*
           Animação
        */

        requestAnimationFrame(() => {
            overlay.classList.add("ativo");
        });

        /*
           Guarda qual elemento abriu o formulário
        */

        const botaoOrigem = abrir;

        /*
           Coloca foco no primeiro campo
        */

        const primeiroCampo = form.querySelector(
            "input, select, textarea"
        );

        if (primeiroCampo) {

            setTimeout(() => {
                primeiroCampo.focus();
            }, 300);
        }

        /*
           Função para fechar
        */

        function fecharFormulario() {

            overlay.classList.remove("ativo");

            setTimeout(() => {

                /*
                   Devolve o formulário ao lugar original
                */

                marcador.parentNode.insertBefore(
                    form,
                    marcador.nextSibling
                );

                form.hidden = true;

                marcador.remove();

                overlay.remove();

                /*
                   Devolve o foco para o botão
                */

                if (botaoOrigem) {
                    botaoOrigem.focus();
                }

            }, 300);
        }

        /*
           Cancelar
        */

        const cancelar =
            form.querySelector("[data-cancelar-form]");

        if (cancelar) {

            cancelar.addEventListener(
                "click",
                fecharFormulario,
                { once: true }
            );
        }

        /*
           Clicar fora do formulário
        */

        overlay.addEventListener("click", (event) => {

            if (event.target === overlay) {
                fecharFormulario();
            }

        });

        /*
           ESC fecha
        */

        function pressionarEsc(event) {

            if (event.key === "Escape") {

                fecharFormulario();

                document.removeEventListener(
                    "keydown",
                    pressionarEsc
                );
            }
        }

        document.addEventListener(
            "keydown",
            pressionarEsc
        );

        return;
    }

});
// mostrar a turmas no select
async function carregarTurmas() {
    const resposta = await fetch("../controllers/Func_admin/listarTurmas.php");
    const turmas = await resposta.json();

const selects = document.querySelectorAll(".select-turma");

   selects.forEach(select => {
    turmas.forEach(turma => {
        const option = document.createElement("option");

        option.value = turma.id_turma;
        option.textContent = turma.nome;

        select.appendChild(option);
    });
});
}


// Listar alunos
async function listarAlunos() {
    console.log("1. listarAlunos iniciou");

    const resposta = await fetch("../controllers/Func_admin/listarAlunos.php");

    console.log("2. resposta:", resposta.status);

    const alunos = await resposta.json();

    console.log("3. alunos:", alunos);

    const container = document.getElementById("lista-alunos");

    console.log("4. container:", container);

    container.innerHTML = "";

    const tabela = document.createElement("table");

    tabela.innerHTML = `
        <thead>
            <tr>
                <th>Nome do aluno</th>
              <th>turma</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
    `;

    const corpo = document.createElement("tbody");

    alunos.forEach(aluno => {
        const linha = document.createElement("tr");

        linha.innerHTML = `
            <td>${aluno.nome}</td>
            <td>${aluno.turma}</td>
            <td>
                <button type="button" onclick="editarAluno(${aluno.id_aluno})">
                    Editar
                </button>
            </td>

            <td>
                <button type="button" onclick="excluirAluno(${aluno.id_aluno})">
                    Excluir
                </button>
            </td>
        `;

        corpo.appendChild(linha);
    });

    tabela.appendChild(corpo);
    container.appendChild(tabela);
}





// Listar Turmas
async function listarTurmas() {
    const resposta = await fetch("../controllers/Func_admin/listarTurmas.php");
    const turmas = await resposta.json();

    const container = document.getElementById("Turmas");
    container.innerHTML = "";

    const tabela = document.createElement("table");

    const cabecalho = document.createElement("thead");
    cabecalho.innerHTML = `
        <tr>
            <th>Nome turma</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    `;

    tabela.appendChild(cabecalho);

    const corpo = document.createElement("tbody");

    turmas.forEach(turma => {
        const linha = document.createElement("tr");

        // Nome da turma
        const nome = document.createElement("td");
        nome.textContent = turma.nome;

        // Editar
        const editar = document.createElement("td");
        const btnEditar = document.createElement("button");

        btnEditar.textContent = "Editar";
        btnEditar.dataset.idTurma = turma.id_turma;

        btnEditar.addEventListener("click", () => {
            editarTurma(turma.id_turma);
        });

        editar.appendChild(btnEditar);

        // Excluir
        const excluir = document.createElement("td");
        const btnExcluir = document.createElement("button");

        btnExcluir.textContent = "Excluir";
        btnExcluir.dataset.idTurma = turma.id_turma;

        btnExcluir.addEventListener("click", () => {
            excluirTurma(turma.id_turma);
        });

        excluir.appendChild(btnExcluir);

        linha.appendChild(nome);
        linha.appendChild(editar);
        linha.appendChild(excluir);

        corpo.appendChild(linha);
    });

    tabela.appendChild(corpo);
    container.appendChild(tabela);
}



// Listar Materias
async function listarMaterias() {
    const resposta = await fetch(
        "../controllers/Func_admin/listarMaterias.php"
    );

    const materias = await resposta.json();

    const container = document.getElementById("Materias");

    container.innerHTML = "";

    const tabela = document.createElement("table");

    const cabecalho = document.createElement("thead");

    cabecalho.innerHTML = `
        <tr>
            <th>Nome da matéria</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    `;

    tabela.appendChild(cabecalho);

    const corpo = document.createElement("tbody");

    materias.forEach(materia => {

        const linha = document.createElement("tr");

        // Nome da matéria
        const nome = document.createElement("td");

        nome.textContent = materia.nome;

        // Editar
        const editar = document.createElement("td");

        const btnEditar = document.createElement("button");

        btnEditar.type = "button";
        btnEditar.textContent = "Editar";

        btnEditar.addEventListener("click", () => {
            editarMateria(materia.id_materia);
        });

        editar.appendChild(btnEditar);

        // Excluir
        const excluir = document.createElement("td");

        const btnExcluir = document.createElement("button");

        btnExcluir.type = "button";
        btnExcluir.textContent = "Excluir";

        btnExcluir.addEventListener("click", () => {
            excluirMateria(materia.id_materia);
        });

        excluir.appendChild(btnExcluir);

        linha.appendChild(nome);
        linha.appendChild(editar);
        linha.appendChild(excluir);

        corpo.appendChild(linha);
    });

    tabela.appendChild(corpo);

    container.appendChild(tabela);
}


// selecionar necessidade 
async function carregarNecessidades() {
    const resposta = await fetch("../controllers/Func_admin/listarNecess.php");

    console.log("Status necessidades:", resposta.status);

    const necessidades = await resposta.json();

    console.log("Necessidades:", necessidades);

    const container = document.getElementById("necessidades");

    container.innerHTML = "";

    necessidades.forEach(necessidade => {

        const label = document.createElement("label");

        const checkbox = document.createElement("input");

        checkbox.type = "checkbox";
        checkbox.name = "necessidades[]";
 checkbox.value = necessidade.id_necessidade;

        label.appendChild(checkbox);
        label.appendChild(
            document.createTextNode(" " + necessidade.nome)
        );

        container.appendChild(label);
        container.appendChild(document.createElement("br"));
    });
}





// carrega as materias no chekbox
async function carregarMaterias() {
    const resposta = await fetch("../controllers/Func_admin/listarMaterias.php");

    console.log("Status materias:", resposta.status);

    const materias = await resposta.json();

    console.log("Materias: ", materias);

    const container = document.getElementById("materias");

    container.innerHTML = "";

    materias.forEach(materia => {

        const label = document.createElement("label");

        const checkbox = document.createElement("input");

        checkbox.type = "checkbox";
        checkbox.name = "materias[]";
 checkbox.value = materia.id_materia;

        label.appendChild(checkbox);
        label.appendChild(
            document.createTextNode(" " + materia.nome)
        );

        container.appendChild(label);
        container.appendChild(document.createElement("br"));
    });
}