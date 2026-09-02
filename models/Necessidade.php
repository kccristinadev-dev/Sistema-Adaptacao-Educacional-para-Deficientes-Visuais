<?php
class Necessidade {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}

// Cadastrar Necessidade
public function cadastrarNecessidade($nome){
    
        $sql = "INSERT INTO necessidades
    (nome)
    VALUES
    (:nome)";
        $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':nome' => $nome
    ]);

    return $this->conn->lastInsertId();
}



// listar necessidade 
public function listarNecessidades()
{
    $sql = "SELECT id_necessidade, nome
            FROM necessidades
            ORDER BY nome";

    $stmt = $this->conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
