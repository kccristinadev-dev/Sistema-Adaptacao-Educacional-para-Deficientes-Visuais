
<?php

class Pessoa {

    private $conn;

    public function __construct($conexao) {
        $this->conn = $conexao;
    }

    // Login de aluno
    public function loginAluno($matricula, $senha) {

        $sql = "SELECT
                    p.id_pessoa,
                    p.nome,
                    p.email,
                    p.tipo,
                    p.senha
                FROM pessoas p
                INNER JOIN alunos a
                    ON a.id_pessoa = p.id_pessoa
                WHERE a.matricula = :matricula
                AND p.tipo = 'aluno'";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':matricula' => $matricula
        ]);

        $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pessoa || !password_verify($senha, $pessoa['senha'])) {
            return false;
        }

        unset($pessoa['senha']);

        return $pessoa;
    }


    // Login de professor
    public function loginProfessor($email, $senha) {

        $sql = "SELECT
                    p.id_pessoa,
                    p.nome,
                    p.email,
                    p.tipo,
                    p.senha
                FROM pessoas p
                INNER JOIN professores pr
                    ON pr.id_pessoa = p.id_pessoa
                WHERE p.email = :email
                AND p.tipo = 'professor'";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pessoa || !password_verify($senha, $pessoa['senha'])) {
            return false;
        }

        unset($pessoa['senha']);

        return $pessoa;
    }


    // Login de administrador
    public function loginAdmin($email, $senha) {

        $sql = "SELECT
                    id_pessoa,
                    nome,
                    email,
                    tipo,
                    senha
                FROM pessoas
                WHERE email = :email
                AND tipo = 'admin'";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pessoa || !password_verify($senha, $pessoa['senha'])) {
            return false;
        }

        unset($pessoa['senha']);

        return $pessoa;
    }

}

?>
