<?php
	require_once "..\BD\conexaoBD.php";

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$id = $_POST['cod_cliente'];
		$tNome  = $_POST['tNome'];
		$tEmail   = $_POST['tEmail'];
		$tSenha  = $_POST['tSenha'];
	

		$stmt = $conexao->prepare("UPDATE cliente SET nome = :tNome, 
		email = :tEmail, senha = :tSenha WHERE cod_cliente = :id");
		$stmt->execute([
			':tNome' => $tNome,
			':tEmail' => $tEmail,
			':tSenha' => $tSenha,
			':cod_cliente' => $id
		]);

		header("Location: consulta_cliente.php");
		exit;
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conexao->prepare("SELECT * FROM cliente WHERE cod_cliente = :id");
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
	  <input type="hidden" name="id" value="<?= $registro['id'] ?>">
      <label for="nome">Nome:</label>
      <input type="text" id="tNome" name="tNome" maxlength="20" required value="<?= htmlspecialchars($registro['tNome']) ?>"><br><br>

      <label for="tEmail">Email:</label>
      <input type="text" id="tEmail" name="tEmail" maxlength="20" value="<?= htmlspecialchars($registro['tEmail']) ?>"><br><br>

      <label for="tSenha">Senha:</label>
      <input type="text" id="tSenha" name="tSenha" maxlength="20" value="<?= htmlspecialchars($registro['tSenha']) ?>"><br><br>


      <button type="submit">Salvar alterações no registro</button>
    </form>
  </main>

</body>
</html>
