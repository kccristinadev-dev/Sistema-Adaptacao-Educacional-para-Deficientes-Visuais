<?php
class Aluno {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}


// Cadastra alunos
public function cadastrarAluno($nome, $email, $cpf, $telefone, $senha, $matricula, $id_turma, $id_necessidade)
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

$sql = "INSERT INTO alunos_necessidades (id_aluno, id_necessidade)
        VALUES (:id_aluno, :id_necessidade)";
$stmt = $this->conn->prepare($sql);

$stmt->execute([
    ':id_aluno' => $id_aluno,
    ':id_necessidade' => $id_necessidade 
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



// Pega todos os alunos do banco
public function listarAluno(){

$sql = "

SELECT p.*, a.id_aluno, t.nome AS turma
FROM pessoas p

JOIN alunos a 
ON a.id_pessoa = p.id_pessoa
     
      JOIN aluno_turma at 
      ON at.id_aluno = a.id_aluno
      
      JOIN turmas t
      ON t.id_turma = at.id_turma
";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pega somente um aluno específico 
public function buscarAluno($id_pessoa) {

  $sql = "SELECT p.*, a.id_aluno
            FROM pessoas p
            INNER JOIN alunos a
                ON a.id_pessoa = p.id_pessoa
            WHERE p.id_pessoa = :id_pessoa";
            
$stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);




}


}
