<?php
class Professor {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}


// Pega todos os professores do banco
public function listarProf(){

$sql = "SELECT p.*, pr.id_professor FROM pessoas p JOIN professores pr ON pr.id_pessoa = p.id_pessoa";

$stmt = $this->conn->query($sql);


return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Pega somente um professor específico 
public function buscarProf($id_pessoa) {

  $sql = "SELECT p.*,a.id_professor
            FROM pessoas p
            INNER JOIN professores a
                ON a.id_pessoa = p.id_pessoa
            WHERE p.id_pessoa = :id_pessoa";
            
$stmt = $this->conn->prepare($sql);
$stmt->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_INT);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);




}

}



?>