<?php
class Pessoa {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}


// login Aluno
public function loginAluno($matricula, $senha)
{
    $sql = "SELECT p.*
            FROM pessoas p
            INNER JOIN alunos a
                ON a.id_pessoa = p.id_pessoa
            WHERE a.matricula = :matricula
            AND p.senha = :senha";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':matricula' => $matricula,
        ':senha' => $senha
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// login Professor 
public function loginProfessor($email, $senha)
{
    $sql = "SELECT p.*
            FROM pessoas p
            INNER JOIN professores pr
                ON pr.id_pessoa = p.id_pessoa
            WHERE p.email = :email
            AND p.senha = :senha";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':senha' => $senha
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}




//login Admin
public function loginAdmin($email, $senha)
{
    $sql = "SELECT *
            FROM pessoas
            WHERE email = :email
            AND senha = :senha
            AND tipo = 'admin'";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':senha' => $senha
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}

?>