<?php
class Turma {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}

// Cadastrar turmas
public function cadastrarTurma($nome) {
    
    $sql = "INSERT INTO turmas
    (nome)
    VALUES
    (:nome)";
        $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':nome' => $nome
    ]);

    return $this->conn->lastInsertId();
}

//Listar as turmas existentes 
public function listarTurmas()
{
    $sql = "SELECT *
            FROM turmas
            ORDER BY nome";

    $stmt = $this->conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// cadastrar aluno a turma
public function vincularAlunoTurma($id_aluno, $id_turma) {
     
       try {
    $sql = "INSERT INTO aluno_turma
    (id_aluno, id_turma)
    VALUES
    (:id_aluno, :id_turma)
    ";
    
   $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id_aluno' => $id_aluno, 
        ':id_turma' => $id_turma 
    ]);

    return true;
} catch (PDOException $e) {

        return false;
    }
    
}

//Cadastra professor  a turma
public function vincularProfessorTurma(){
           try {
    $sql = "INSERT INTO professor_turma
    (id_professor, id_turma)
    VALUES
    (:id_professor, :id_turma)
    ";
    
   $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id_professor' => $id_professor, 
        ':id_turma' => $id_turma 
    ]);

    return true;
} catch (PDOException $e) {

        return false;
    }
    
}

//buscar alunos da turma 
public function buscarAlunoTurma($id_turma){
    
  $sql = "SELECT p.*, a.id_aluno, at.id_turma
        FROM aluno_turma at
        
        INNER JOIN alunos a
            ON a.id_aluno = at.id_aluno
            
        INNER JOIN pessoas p
            ON p.id_pessoa = a.id_pessoa
WHERE at.id_turma = :id_turma
";
   
   
   $stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_turma', $id_turma, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

    
}

//buscar professores da turma
public function buscarProfTurma(){
    
    $sql = "SELECT p.*, pr.id_professor, at.id_turma
        FROM professor_turma at
        
        INNER JOIN professor pr
            ON pr.id_professor = at.id_aluno
            
        INNER JOIN pessoas p
            ON p.id_pessoa = pr.id_pessoa
WHERE at.id_turma = :id_turma
";
   
   $stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_turma', $id_turma, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

    
}


//deletar alunos da turma 
public function deletarAlunoTurma($id_aluno,  $id_turma){

    $sql ="DELETE FROM aluno_turma
    WHERE id_aluno = :id_aluno AND  id_turma = :id_turma
    ";
    
    
  $stmt = $this->conn->prepare($sql);

    $stmt->execute([
      ':id_aluno'  => $id_aluno,
      ':id_turma'  => $id_turma
               ]);

    return true;
}

}