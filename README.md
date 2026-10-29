# Sistema-Adaptativo-Educacional-para-Deficientes-Visuais
Desenvolvimento de um sistema web adaptativo com a finalidade de converter atividades pedagógicas em formatos acessíveis para estudantes com deficiência visual, em conformidade com a meta 4.5 da ODS 4 (Educação de Qualidade).

## Atividades e acessibilidade

As respostas enviadas pelos alunos ficam vinculadas à atividade e aparecem no painel do professor com o status **Entregue**. O status da atividade é calculado por aluno, sem marcar como entregue para os demais estudantes da turma.

Na área do aluno, as adaptações cadastradas em `adaptacoes` e as necessidades vinculadas em `alunos_necessidades` são traduzidas para classes CSS pelo controlador `controllers/Func_aluno/adaptacoesAluno.php`, usando o catálogo em `config/adaptacoes.php`. O catálogo relaciona necessidades como cegueira, baixa visão e daltonismo a recursos visuais/de interação. Os controles também permitem ajustar contraste e tamanho do texto durante o uso. A interface inclui navegação por teclado, foco visível, estrutura semântica e mensagens anunciadas por leitores de tela. O leitor de tela propriamente dito deve estar instalado e habilitado no dispositivo. Para necessidades cadastradas com nomes próprios, acrescente uma chave normalizada em `necessidades` no catálogo.
