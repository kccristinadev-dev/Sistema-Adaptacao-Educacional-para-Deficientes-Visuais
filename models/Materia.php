<?php
class Materia {
private $conn;
public function __construct($conexao){
$this->conn = $conexao;
}
// Cadastrar matérias 
public function cadastrarMateria($nome) {
            $sql = "INSERT INTO materias
    (nome)
    VALUES
    (:nome)";
        $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':nome' => $nome
    ]);

    return $this->conn->lastInsertId();
}

// Vincula professor à matéria
public function vincularProfMateria($id_professor, $id_materia)
{
    try {

        $sql = "INSERT INTO professor_materia
                (id_professor, id_materia)
                VALUES
                (:id_professor, :id_materia)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id_professor' => $id_professor,
            ':id_materia' => $id_materia
        ]);

        return true;

    } catch (PDOException $e) {

        return false;
    }
}

// Vincula matéria à turma
public function vincularTurmaMateria($id_turma, $id_materia)
{
    try {

        $sql = "INSERT INTO turma_materia
                (id_turma, id_materia)
                VALUES
                (:id_turma, :id_materia)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id_turma' => $id_turma,
            ':id_materia' => $id_materia
        ]);

        return true;

    } catch (PDOException $e) {

        return false;
    }
}


// listar todas matérias 
 public function listarMaterias(){
    $sql = "SELECT id_materia, nome
            FROM materias
            ORDER BY nome";

    $stmt = $this->conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// listar matérias do professor especifico
public function listarMateriasProfessor($id_professor)
{
    $sql = "SELECT m.id_materia, m.nome
            FROM materias m
            JOIN professor_materia pm
                ON pm.id_materia = m.id_materia
            WHERE pm.id_professor = :id_professor
            ORDER BY m.nome";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id_professor' => $id_professor
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}



