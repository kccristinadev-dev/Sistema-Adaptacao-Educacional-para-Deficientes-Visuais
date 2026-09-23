function mostrarTela(id, botao) {

    document.querySelectorAll(".tela")
        .forEach(tela => tela.classList.remove("ativa"));

    document.getElementById(id).classList.add("ativa");


    document.querySelectorAll(".menu-professor button")
        .forEach(btn => btn.classList.remove("ativo"));

    botao.classList.add("ativo");
    

}
    document.getElementById("btnInicio").addEventListener("click", function() {
    mostrarTela("resumo", this);
});

document.getElementById("btnAtividades").addEventListener("click", function() {
    mostrarTela("atividades", this);
});

document.getElementById("btnRespostas").addEventListener("click", function() {
    mostrarTela("respostas", this);
});

document.getElementById("btnTurmas").addEventListener("click", function() {
    mostrarTela("turmas", this);
});