
<?php
class Atividade {

private $conn;

public function __construct($conexao){
    $this->conn = $conexao;
}


// Cadastrar atividade
public function cadastrarAtividade(
    $titulo,
    $descricao,
    $arquivo,
    $id_materia,
    $id_turma
) {

    // Caminho onde os arquivos serão salvos
    $pasta = dirname(__DIR__) . "/uploads/atividades/";

    $nomeArquivo = null;

    // Verifica se foi enviado algum arquivo
    if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) {

        if (!is_dir($pasta) && !mkdir($pasta, 0775, true) && !is_dir($pasta)) {
            return false;
        }

        $nomeOriginal = basename($arquivo['name']);

        // Evita problemas com caracteres no nome
        $nomeArquivo = time() . "_" . $nomeOriginal;

        $destino = $pasta . $nomeArquivo;

        if (!move_uploaded_file(
            $arquivo['tmp_name'],
            $destino
        )) {
            return false;
        }
    }


    // Cadastra a atividade
    $sql = "INSERT INTO atividades
            (status, titulo, descricao, id_materia, arquivo)
            VALUES
            (:status, :titulo, :descricao, :id_materia, :arquivo)";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':status' => 'publicada',
        ':titulo' => $titulo,
        ':descricao' => $descricao,
        ':id_materia' => $id_materia,
        ':arquivo' => $nomeArquivo
    ]);

    $id_atividade = $this->conn->lastInsertId();


    // Vincula a atividade às turmas
    $sql = "INSERT INTO atividades_turmas
            (id_atividade, id_turma)
            VALUES
            (:id_atividade, :id_turma)";

    $stmt = $this->conn->prepare($sql);

    foreach ($id_turma as $turma) {

        $stmt->execute([
            ':id_atividade' => $id_atividade,
            ':id_turma' => $turma
        ]);
    }

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
// Listar atividades do aluno
public function listarAtividadeAluno($id_aluno)
{
    $sql = "
    SELECT
        atividades.*,
        materias.nome AS materia,
        (
            SELECT GROUP_CONCAT(DISTINCT turmas.nome SEPARATOR ', ')
            FROM atividades_turmas
            INNER JOIN turmas
                ON atividades_turmas.id_turma = turmas.id_turma
            INNER JOIN aluno_turma
                ON atividades_turmas.id_turma = aluno_turma.id_turma
            WHERE atividades_turmas.id_atividade = atividades.id_atividade
              AND aluno_turma.id_aluno = :id_aluno_turmas
        ) AS turmas,
        CASE
            WHEN entregas.id_resposta IS NOT NULL THEN 'entregue'
            ELSE atividades.status
        END AS status_aluno
    FROM atividades
    INNER JOIN materias
        ON atividades.id_materia = materias.id_materia
    LEFT JOIN (
        SELECT id_atividade, MAX(id_resposta) AS id_resposta
        FROM respostas
        WHERE id_aluno = :id_aluno_resposta
        GROUP BY id_atividade
    ) AS entregas
        ON atividades.id_atividade = entregas.id_atividade
    WHERE EXISTS (
        SELECT 1
        FROM atividades_turmas
        INNER JOIN aluno_turma
            ON atividades_turmas.id_turma = aluno_turma.id_turma
        WHERE atividades_turmas.id_atividade = atividades.id_atividade
          AND aluno_turma.id_aluno = :id_aluno_turma
    )
    ORDER BY atividades.created_at DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':id_aluno_resposta' => $id_aluno,
        ':id_aluno_turmas' => $id_aluno,
        ':id_aluno_turma' => $id_aluno
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Listar atividades do professor
public function listarAtividadeProfessor($id_professor)
{
    $sql = "
SELECT 
    atividades.id_atividade,
    atividades.titulo,
    atividades.descricao,
    atividades.status,
    atividades.arquivo,
    atividades.created_at,
    materias.nome AS materia,
    GROUP_CONCAT(DISTINCT turmas.nome SEPARATOR ', ') AS turmas
            
        FROM atividades

        INNER JOIN professor_materia
            ON atividades.id_materia = professor_materia.id_materia

        INNER JOIN materias
            ON atividades.id_materia = materias.id_materia

        INNER JOIN atividades_turmas
            ON atividades.id_atividade = atividades_turmas.id_atividade

        INNER JOIN turmas
            ON atividades_turmas.id_turma = turmas.id_turma

        WHERE professor_materia.id_professor = :id_professor

GROUP BY 
    atividades.id_atividade,
    atividades.titulo,
    atividades.descricao,
    atividades.status,
    atividades.arquivo,
    atividades.created_at,
    materias.nome

        ORDER BY atividades.id_atividade DESC
    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id_professor' => $id_professor
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Deletar atividade
public function deletarAtividade($id_atividade)
{
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
public function editarAtividade(
    $id_atividade,
    $status,
    $titulo,
    $descricao,
    $id_materia
) {
    $sql = "
        UPDATE atividades
        SET
            status = :status,
            titulo = :titulo,
            descricao = :descricao,
            id_materia = :id_materia
        WHERE id_atividade = :id_atividade
    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id_atividade' => $id_atividade,
        ':status' => $status,
        ':titulo' => $titulo,
        ':descricao' => $descricao,
        ':id_materia' => $id_materia
    ]);
}
}