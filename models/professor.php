<?php
class Professor {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}


// Pega todos os professores do banco
public function listarProf(){

$sql = "SELECT * FROM professores";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Pega somente um professor específico 
public function buscarProf($id_professor) {

$sql = "SELECT * FROM professores where id_professor = :id_professor";

$stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);




}

}



?>