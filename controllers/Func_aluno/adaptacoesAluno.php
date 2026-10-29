<?php

function carregarAdaptacoesAluno(PDO $conexao, int $idAluno): array
{
    $catalogo = require __DIR__ . '/../../config/adaptacoes.php';
    $classes = [];

    $adaptacoes = $conexao->prepare(
        'SELECT DISTINCT tipo FROM adaptacoes WHERE id_aluno = :id_aluno'
    );
    $adaptacoes->execute([':id_aluno' => $idAluno]);

    foreach ($adaptacoes->fetchAll(PDO::FETCH_COLUMN) as $tipo) {
        $configuracao = $catalogo['tipos'][$tipo] ?? null;
        if ($configuracao !== null) {
            $classes = array_merge($classes, $configuracao['classes']);
        }
    }

    $necessidades = $conexao->prepare(
        'SELECT DISTINCT necessidades.nome
         FROM alunos_necessidades
         INNER JOIN necessidades
             ON alunos_necessidades.id_necessidade = necessidades.id_necessidade
         WHERE alunos_necessidades.id_aluno = :id_aluno'
    );
    $necessidades->execute([':id_aluno' => $idAluno]);

    foreach ($necessidades->fetchAll(PDO::FETCH_COLUMN) as $necessidade) {
        $chave = normalizarChaveAdaptacao($necessidade);
        $configuracao = $catalogo['necessidades'][$chave] ?? null;
        if ($configuracao !== null) {
            $classes = array_merge($classes, $configuracao['classes']);
        }
    }

    return array_values(array_unique($classes));
}

function normalizarChaveAdaptacao(string $valor): string
{
    $valor = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $valor);
    $valor = strtolower($valor === false ? '' : $valor);
    $valor = preg_replace('/[^a-z0-9]+/', ' ', $valor);

    return trim($valor);
}
