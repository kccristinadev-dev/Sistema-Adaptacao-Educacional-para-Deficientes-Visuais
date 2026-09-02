const painel = document.getElementById("painel");



document.getElementById("btn-alunos").addEventListener("click", () => {
    painel.innerHTML = `
        <h2>Alunos</h2>
<section id="area-alunos">


  <button type="button" data-form="form-aluno" id="btn-cadastrar-aluno">
        + Cadastrar aluno
    </button>



  <form id="form-aluno" action="../controllers/Func_admin/cadastrarAluno.php" method="POST" hidden>

        <input type="text" name="nome" placeholder="Nome" required>

        <input type="email" name="email" placeholder="E-mail" required>

        <input type="text" name="cpf" placeholder="CPF" required>

        <input type="text" name="telefone" placeholder="Telefone" required>

        <input type="text" name="matricula" placeholder="Matrícula" required>
        <fieldset>
    <legend>Necessidades do aluno</legend>

    <div id="necessidades">
    </div>
</fieldset>
<select name="id_turma" class="select-turma" required>
    <option value="">Selecione uma turma</option>
</select>
        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit">Cadastrar</button>

<button type="button" data-cancelar-form="form-aluno">
    Cancelar
</button>

    </form>
        <h3>Alunos cadastrados</h3>

    <div id="lista-alunos">
        <!-- lista -->
    </div>
</section>
    `;
  
carregarTurmas();
carregarNecessidades();
listarAlunos();
});



document.getElementById("btn-professores").addEventListener("click", () => {
    painel.innerHTML = `
        <h2>Professores</h2>
<section id=area-professor">


    <button type="button" data-form="form-professor" id="btn-cadastrar-professsor">
        + Cadastrar aluno
    </button>


<form id="form-professor" action="../controllers/Func_admin/cadastrarProfessor.php" method="POST" hidden>

        <input type="text" name="nome" placeholder="Nome" required>

        <input type="email" name="email" placeholder="E-mail" required>

        <input type="text" name="cpf" placeholder="CPF" required>

        <input type="text" name="telefone" placeholder="Telefone" required>


<select name="id_turma" class="select-turma" required>
    <option value="">Selecione uma turma</option>
</select>
        <input type="password" name="senha" placeholder="Senha">
        <button type="submit">Cadastrar</button>

     <button type="button" data-cancelar-form="form-professor">
    Cancelar
</button>

    </form>
        <h3>Professores cadastrados</h3>
    <div id="professor">
        <!-- lista -->
    </div>
</section>    `;

carregarTurmas();

});




document.getElementById("btn-turmas").addEventListener("click", () => {
    painel.innerHTML = `
        <h2>Turmas</h2>
<section id=area-Turma">


    <button type="button" data-form="form-turma" id="btn-cadastrar-turma">
        + Cadastrar aluno
    </button>



<form id="form-turma"
      action="../controllers/Func_admin/cadastrarTurma.php"
      method="POST"
      hidden>
        <input type="text" name="nome" placeholder="Nome" required>
        <fieldset>
    <legend>Materias da turma</legend>

    <div id="materias">
    </div>
</fieldset>

        <button type="submit">Cadastrar</button>

     <button type="button" data-cancelar-form="form-turma">
    Cancelar
</button>

    </form>
        <h3>Turmas cadastrados</h3>
    <div id="Turmas">
        <!-- lista -->
    </div>
</section>      `;
listarTurmas();
carregarMaterias();
    
});




document.getElementById("btn-necessidades").addEventListener("click", () => {
    painel.innerHTML = `
        <h2>Necessidades</h2>
        <button data-form="form-necessidade">Cadastrar necesscessidade</button>
        
        <form id="form-necessidade" 
      action="../controllers/Func_admin/cadastrarNecess.php"
      method="POST"
      hidden>
        <input type="text" name="nome" placeholder="Nome" required>


        <button type="submit">Cadastrar</button>

     <button type="button" data-cancelar-form="form-necessidade">
    Cancelar
</button>

    </form>
        
        `;
        
});





document.getElementById("btn-materia").addEventListener("click", () => {
    painel.innerHTML = `
        <h2>Matérias</h2>
        <button data-form="form-materia">Cadastrar Matérias</button>
        
        <form id="form-materia" 
      action="../controllers/Func_admin/cadastrarMateria.php"
      method="POST"
      hidden>
        <input type="text" name="nome" placeholder="Nome" required>


        <button type="submit">Cadastrar</button>

     <button type="button" data-cancelar-form="form-materia">
    Cancelar
</button>

    </form>
        
        `;
        
});
