<?php
	require_once "../BD/conexaoBD.php";

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$id = $_POST['cod_produto'];
		$tNome  = $_POST['tNome'];
		$tPreco   = $_POST['tPreco'];
		$tMarca  = $_POST['tMarca'];
		$tTipo = $_POST['tTipo'];
		$tTamanho  = $_POST['tTamanho'];
		$tQuantidade = $_POST['tQuantidade'];
	

		$stmt = $conexao->prepare("UPDATE produto SET nome = :tNome, 
		preco = :tPreco, marca = :tMarca, tipo = :tTipo, tamanho = :tTamanho, quantidade = :tQuantidade WHERE cod_produto = :id");
		$stmt->execute([
			':tNome' => $tNome,
			':tPreco' => $tPreco,
			':tMarca' => $tMarca,
			':tTipo' => $tTipo,
			':tTamanho' => $tTamanho,
			':tQuantidade' => $tQuantidade,
			':id' => $id
		]);

		header("Location: consulta_produto.php");
		exit;
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conexao->prepare("SELECT * FROM produto WHERE cod_produto = :id");
		$stmt->execute([':id' => $id]);
		$registro = $stmt->fetch();

		if (!$registro) {
			echo "Registro não encontrado.";
			exit;
		}
	} else {
		echo "ID não fornecido.";
		exit;
	}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualização de Registros</title>
  
</head>
<body>

  <main>
    <h1>Editar Registro</h1>

    <form method="POST">
	  <input type="hidden" name="cod_produto" value="<?= $registro['cod_produto'] ?>">
      <label for="tNome">Nome:</label>
      <input type="text" id="tNome" name="tNome" maxlength="100" required value="<?= htmlspecialchars($registro['nome']) ?>"><br><br>

      <label for="tPreco">Preço:</label>
      <input type="number" id="tPreco" name="tPreco" step="0.01" required value="<?= htmlspecialchars($registro['preco']) ?>"><br><br>

      <label for="tMarca">Marca:</label>
      <input type="text" id="tMarca" name="tMarca" maxlength="20" value="<?= htmlspecialchars($registro['marca']) ?>"><br><br>

      <label for="tTipo">Tipo:</label>
      <input type="text" id="tTipo" name="tTipo" maxlength="20" value="<?= htmlspecialchars($registro['tipo']) ?>"><br><br>

      <label for="tTamanho">Tamanho:</label>
      <input type="number" id="tTamanho" name="tTamanho" value="<?= htmlspecialchars($registro['tamanho']) ?>"><br><br>

      <label for="tQuantidade">Quantidade:</label>
      <input type="text" id="tQuantidade" name="tQuantidade" maxlength="20" required value="<?= htmlspecialchars($registro['quantidade']) ?>"><br><br>

      <button type="submit">Salvar alterações no registro</button>
    </form>
  </main>

</body>
</html>
