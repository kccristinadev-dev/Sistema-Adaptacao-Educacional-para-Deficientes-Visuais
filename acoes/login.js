const parametros = new URLSearchParams(window.location.search);

const perfil = parametros.get("perfil");

const conteudo = document.getElementById("conteudo");

if (perfil === "aluno") {
    conteudo.innerHTML = `
<form class="form-login" method="POST" action="../controllers/login.php?perfil=aluno">

    <label for="ra">Número do RA:</label>
    <input 
    type="text" 
    id="ra" 
    name="usuario"
    placeholder="Digite seu RA">


    <label for="senha">Senha:</label>
    <input 
    type="password" 
    id="senha"
    name="senha"
    placeholder="Digite sua senha">


    <button type="submit">
        Entrar
    </button>

</form>
    `;
}


else if (perfil === "professor") {
    conteudo.innerHTML = `
<form class="form-login" method="POST" action="../controllers/login.php?perfil=professor">

<label>E-mail institucional:</label>
<input 
type="email" 
name="usuario"
placeholder="Digite seu e-mail">

<label>Senha:</label>
<input 
type="password"
name="senha">

<button type="submit">
Entrar
</button>

</form>
    `;
}

else if (perfil === "admin") {
    conteudo.innerHTML = `
<form class="form-login" method="POST" action="../controllers/login.php?perfil=admin">

    <label for="ra">Email: </label>
    <input 
    type="text" 
    id="ra" 
    name="usuario"
    placeholder="Digite seu e-mail">


    <label for="senha">Senha:</label>
    <input 
    type="password" 
    id="senha"
    name="senha"
    placeholder="Digite sua senha">


    <button type="submit">
        Entrar
    </button>

</form>
    `;
}

else {
    conteudo.innerHTML = `
        <h2>Perfil não encontrado.</h2>
    `;
}