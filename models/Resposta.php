<?php

class Resposta {

    private $conn;

    public function __construct($conexao){
        $this->conn = $conexao;
    }


    // Cadastrar resposta
    public function cadastrarResposta($resposta, $arquivo, $id_atividade, $id_aluno)
    {
        // Cria o comando SQL para cadastrar a resposta
        $sql = "INSERT INTO respostas
        (resposta, arquivo, id_atividade, id_aluno)
        VALUES
        (:resposta, :arquivo, :id_atividade, :id_aluno)";

        // Prepara o comando SQL
        $stmt = $this->conn->prepare($sql);

        // Executa o cadastro passando os valores
        $stmt->execute([
            ':resposta' => $resposta,
            ':arquivo' => $arquivo,
            ':id_atividade' => $id_atividade,
            ':id_aluno' => $id_aluno
        ]);

        // Retorna o ID da resposta cadastrada
        return $this->conn->lastInsertId();
    }


    // Listar respostas
    public function listarRespostas()
    {
        // Cria o comando SQL para buscar as respostas
        $sql = "SELECT *
                FROM respostas";

        // Prepara o comando SQL
        $stmt = $this->conn->prepare($sql);

        // Executa a consulta
        $stmt->execute();

        // Retorna todas as respostas
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Listar respostas do aluno
public function listarRespostasAluno($id_aluno)
{
    // Cria o comando SQL para buscar as respostas do aluno
    $sql = "
    SELECT respostas.*
    FROM respostas
    WHERE respostas.id_aluno = :id_aluno
    ";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa a consulta passando o ID do aluno
    $stmt->execute([
        ':id_aluno' => $id_aluno
    ]);

    // Retorna as respostas encontradas
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Listar respostas do professor
public function listarRespostasProfessor($id_professor)
{
    // Cria o comando SQL para buscar as respostas das atividades do professor
    $sql = "
    SELECT respostas.*
    FROM respostas
    INNER JOIN atividades
        ON respostas.id_atividade = atividades.id_atividade
    INNER JOIN professor_materia
        ON atividades.id_materia = professor_materia.id_materia
    WHERE professor_materia.id_professor = :id_professor
    ";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa a consulta passando o ID do professor
    $stmt->execute([
        ':id_professor' => $id_professor
    ]);

    // Retorna as respostas encontradas
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // Editar resposta
    public function editarResposta($id_resposta, $resposta, $arquivo)
    {
        // Cria o comando SQL para atualizar a resposta
        $sql = "
        UPDATE respostas
        SET
            resposta = :resposta,
            arquivo = :arquivo
        WHERE id_resposta = :id_resposta
        ";

        // Prepara o comando SQL
        $stmt = $this->conn->prepare($sql);

        // Executa a atualização
        $stmt->execute([
            ':id_resposta' => $id_resposta,
            ':resposta' => $resposta,
            ':arquivo' => $arquivo
        ]);
    }


    // Deletar resposta
    public function deletarResposta($id_resposta)
    {
        // Cria o comando SQL para excluir uma resposta específica
        $sql = "
        DELETE FROM respostas
        WHERE id_resposta = :id_resposta
        ";

        // Prepara o comando SQL
        $stmt = $this->conn->prepare($sql);

        // Executa a exclusão
        $stmt->execute([
            ':id_resposta' => $id_resposta
        ]);
    }
}