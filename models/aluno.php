<?php
class Aluno {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}
public function listarAluno(){

$sql = "SELECT * FROM alunos";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function buscarAluno() {

$sql = "SELECT * FROM alunos where id_aluno : id_aluno";

$stmt = $this->conn->prepare($sql);
$stmt->blindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
$stmt->execute;

return $stmt->fetchAll(PDO::FETCH_ASSOC);


}

}

}



?>
