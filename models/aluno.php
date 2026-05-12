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


}



?>
