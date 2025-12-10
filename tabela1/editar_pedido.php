<?php
	require_once "..\BD\conexaoBD.php";

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$id = $_POST['cod_pedido'];
		$cod_cliente = $_POST['cod_cliente'];
		$cod_produto = $_POST['cod_produto'];

		$stmt = $conexao->prepare("UPDATE pedido SET cod_cliente = :cod_cliente, 
		cod_produto = :cod_produto WHERE cod_pedido = :id");
		$stmt->execute([
			':cod_cliente' => $cod_cliente,
			':cod_produto' => $cod_produto,
			':id' => $id
		]);

		header("Location: consulta_pedido.php");
		exit;
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conexao->prepare("SELECT * FROM pedido WHERE cod_pedido = :id");
		$stmt->execute([':id' => $id]);
		$registro = $stmt->fetch();

		if (!$registro) {
			echo "Registro não encontrado.";
			exit;
		}

		// Buscar lista de clientes e produtos para as opções
		$stmtClientes = $conexao->query("SELECT cod_cliente, nome FROM cliente ORDER BY nome");
		$clientes = $stmtClientes->fetchAll();

		$stmtProdutos = $conexao->query("SELECT cod_produto, nome, preco FROM produto ORDER BY nome");
		$produtos = $stmtProdutos->fetchAll();

	} else {
		echo "ID não fornecido.";
		exit;
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualização de Pedido</title>
</head>
<body>

  <main>
    <h1>Editar Pedido</h1>

    <form method="POST">
	  <input type="hidden" name="cod_pedido" value="<?= $registro['cod_pedido'] ?>">
      
      <label for="cod_cliente">Cliente:</label>
      <select id="cod_cliente" name="cod_cliente" required>
        <option value="">-- Selecione um cliente --</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente['cod_cliente'] ?>" <?= $cliente['cod_cliente'] == $registro['cod_cliente'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($cliente['nome']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="cod_produto">Produto:</label>
      <select id="cod_produto" name="cod_produto" required>
        <option value="">-- Selecione um produto --</option>
        <?php foreach ($produtos as $produto): ?>
          <option value="<?= $produto['cod_produto'] ?>" <?= $produto['cod_produto'] == $registro['cod_produto'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($produto['nome']) ?> - R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit">Salvar alterações no pedido</button>
      <p><a href="consulta_pedido.php">Voltar à lista de pedidos</a></p>
    </form>
  </main>

</body>
</html>
