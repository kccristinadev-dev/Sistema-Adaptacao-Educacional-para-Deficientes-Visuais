<?php
class Admin {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}

// Busca o adimistrador no banco
public function buscarAdm($id_pessoa) {

  $sql = "SELECT *
        FROM pessoas
        WHERE id_pessoa = :id_pessoa
        AND tipo = 'admin'";
            
$stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);
}



// Pega todos os alunos do banco
public function listarAluno(){

$sql = "SELECT p.*, a.id_aluno FROM pessoas p JOIN alunos a ON a.id_pessoa = p.id_pessoa";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




// Pega todos os professores do banco
public function listarProfessor(){

$sql = "SELECT p.*, pr.id_professor FROM pessoas p JOIN professores pr ON pr.id_pessoa = p.id_pessoa";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




// Cadastra pessoa
private function cadastrarPessoa($nome, $email, $cpf, $telefone, $senha, $tipo)
{

    $sql = "INSERT INTO pessoas
            (nome, email, cpf, telefone, senha, tipo)
            VALUES
            (:nome, :email, :cpf, :telefone, :senha, :tipo)";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':senha' => $senha,
        ':tipo' => $tipo
    ]);

    return $this->conn->lastInsertId();
   
        } 



// Cadastra alunos
public function cadastrarAluno($nome, $email, $cpf, $telefone, $senha, $matricula, $id_turma, $necessidades)
{
    try {
        $this->conn->beginTransaction();

        $id_pessoa = $this->cadastrarPessoa(
            $nome,
            $email,
            $cpf,
            $telefone,
            $senha,
            'aluno'
        );
        

        $sql = "INSERT INTO alunos (matricula, id_pessoa)
                VALUES (:matricula, :id_pessoa)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':matricula' => $matricula,
            ':id_pessoa' => $id_pessoa
        ]);

   $id_aluno = $this->conn->lastInsertId();

$sql = "INSERT INTO aluno_turma (id_aluno, id_turma)
        VALUES (:id_aluno, :id_turma)";

$stmt = $this->conn->prepare($sql);

$stmt->execute([
    ':id_aluno' => $id_aluno,
    ':id_turma' => $id_turma
]);
// Vincula as necessidades do aluno
$sql = "INSERT INTO alunos_necessidades
        (id_aluno, id_necessidade)
        VALUES (:id_aluno, :id_necessidade)";

$stmt = $this->conn->prepare($sql);

foreach ($necessidades as $id_necessidade) {

    $stmt->execute([
        ':id_aluno' => $id_aluno,
        ':id_necessidade' => $id_necessidade
    ]);
}
$this->conn->commit();

return true;
    } catch (PDOException $e) {

    if ($this->conn->inTransaction()) {
        $this->conn->rollBack();
    }

    die("Erro no cadastro: " . $e->getMessage());
}
}



// Cadastra professores
public function cadastrarProfessor($nome, $email, $cpf, $telefone, $senha, $id_turma)
{
        try {

        $this->conn->beginTransaction();
        
          $id_pessoa = $this->cadastrarPessoa(
            $nome,
            $email,
            $cpf,
            $telefone,
            $senha,
            'professor',
        );
        

        $sql = "INSERT INTO professores (id_pessoa)
                VALUES (:id_pessoa)";
                
$stmt = $this->conn->prepare($sql);

$stmt->execute([
    ':id_pessoa' => $id_pessoa
]);

 $id_professor = $this->conn->lastInsertId();

$sql = "INSERT INTO professor_turma (id_professor, id_turma)
        VALUES (:id_professor, :id_turma)";

$stmt = $this->conn->prepare($sql);

$stmt->execute([
    ':id_professor' => $id_professor,
    ':id_turma' => $id_turma
]);

$this->conn->commit();

return true;

} catch (PDOException $e) {

    if ($this->conn->inTransaction()) {
        $this->conn->rollBack();
    }

    return false;
}

}





}


?>

