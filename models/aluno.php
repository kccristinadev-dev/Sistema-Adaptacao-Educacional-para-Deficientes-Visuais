<?php
class Aluno {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}


// Pega todos os alunos do banco
public function listarAluno(){

$sql = "SELECT p.* FROM pessoas p JOIN alunos a ON a.id_pessoa = p.id_pessoa";.

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Pega somente um aluno específico 
public function buscarAluno($id_aluno) {

$sql = "SELECT * FROM alunos where id_aluno = :id_aluno";

$stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);




}

}



?>
