function mostrarTela(id, botao) {

    document.querySelectorAll(".tela")
        .forEach(tela => tela.classList.remove("ativa"));

    document.getElementById(id).classList.add("ativa");


    document.querySelectorAll(".menu-aluno button")
        .forEach(btn => {
            btn.classList.remove("ativo");
            btn.removeAttribute("aria-current");
        });

    botao.classList.add("ativo");
    botao.setAttribute("aria-current", "page");
}


// Início
document.getElementById("btnInicio").addEventListener("click", function() {
    mostrarTela("resumo", this);
});


// Atividades
document.getElementById("btnAtividades").addEventListener("click", function() {
    mostrarTela("atividades", this);
});


// Minhas respostas
document.getElementById("btnRespostas").addEventListener("click", function() {
    mostrarTela("respostas", this);
});


// Acessibilidade
document.getElementById("btnAcessibilidade").addEventListener("click", function() {
    mostrarTela("acessibilidade", this);
});