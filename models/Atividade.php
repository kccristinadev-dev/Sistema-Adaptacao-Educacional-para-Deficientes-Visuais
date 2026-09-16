
<?php
class Atividade {

private $conn;

public function __construct($conexao){
    $this->conn = $conexao;
}


// Cadastrar atividade
public function cadastrarAtividade($status, $titulo, $descrição, $id_materia, $id_turma)
{
    // Cria o comando SQL para cadastrar a atividade
    $sql = "INSERT INTO atividades
    (status, titulo, descrição, id_materia)
    VALUES
    (:status, :titulo, :descrição, :id_materia)";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa o cadastro passando os valores
    $stmt->execute([
        ':status' => $status,
        ':titulo' => $titulo,
        ':descrição' => $descrição,
        ':id_materia' => $id_materia
    ]);

    // Pega o ID da atividade cadastrada
    $id_atividade = $this->conn->lastInsertId();


    // Cadastra a relação entre atividade e turma
    $sql = "
    INSERT INTO atividade_turma (id_atividade, id_turma)
    VALUES (:id_atividade, :id_turma)
    ";

    // Prepara o comando SQL da relação
    $stmt = $this->conn->prepare($sql);

    // Executa o cadastro da relação
    $stmt->execute([
        ':id_atividade' => $id_atividade,
        ':id_turma' => $id_turma
    ]);

    // Retorna o ID da atividade cadastrada
    return $id_atividade;
}


// Listar atividades
public function listarAtividade(){

    // Cria o comando SQL para buscar as atividades
    $sql = "SELECT *
            FROM atividades";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa a consulta
    $stmt->execute();

    // Retorna todas as atividades encontradas
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Deletar atividade
public function deletarAtividade($id_atividade)
{
    // Cria o comando SQL para excluir uma atividade específica
    $sql = "
    DELETE FROM atividades
    WHERE id_atividade = :id_atividade
    ";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa a exclusão usando o ID informado
    $stmt->execute([
        ':id_atividade' => $id_atividade
    ]);
}


// Editar atividade
public function editarAtividade($id_atividade, $status, $titulo, $descrição, $id_materia)
{
    // Cria o comando SQL para atualizar uma atividade
    $sql = "
    UPDATE atividades
    SET
        status = :status,
        titulo = :titulo,
        descrição = :descrição,
        id_materia = :id_materia
    WHERE id_atividade = :id_atividade
    ";

    // Prepara o comando SQL
    $stmt = $this->conn->prepare($sql);

    // Executa a atualização passando os novos valores
    $stmt->execute([
        ':id_atividade' => $id_atividade,
        ':status' => $status,
        ':titulo' => $titulo,
        ':descrição' => $descrição,
        ':id_materia' => $id_materia
    ]);
}

}