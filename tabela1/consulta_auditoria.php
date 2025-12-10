<?php
require_once "../BD/conexaoBD.php";

try {
    // Consulta a tabela auditoria
    $sql = "SELECT * FROM auditoria ORDER BY id DESC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $auditoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar auditoria: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Auditoria do Sistema</title>

    <style>
        table, th, td {
      border: 1px solid black;
		border-collapse: collapse;
	}
    #tabelaTarefas, #tabelaResumo , #tabelaPadroes1,#tabelaPadroes2{
    margin: 60px auto;
    border-collapse: collapse;
    width: 80%;     
        }   
        
        table{border-collapse: collapse;} th,td{border: 2px solid black; text-align: center;}
    </style>
</head>

<body>

<h1>Registro de Auditoria</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Mensagem</th>
            <th>Data do Evento</th>
        </tr>
    </thead>

    <tbody>
        <?php if (count($auditoria) > 0): ?>
            <?php foreach ($auditoria as $linha): ?>
                <tr>
                    <td><?= $linha['id'] ?></td>
                    <td><?= $linha['mensagem'] ?></td>
                    <td><?= $linha['data_evento'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
