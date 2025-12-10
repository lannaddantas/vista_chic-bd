<?php 
	require_once "..\BD\conexaoBD.php";

	if (isset($_GET['id'])) {
		$id = (int) $_GET['id'];

		// Verifica se o cliente possui pedidos cadastrados
		try {
			$check = $conexao->prepare("SELECT COUNT(*) FROM pedido WHERE cod_cliente = :id");
			$check->bindParam(':id', $id, PDO::PARAM_INT);
			$check->execute();
			$count = (int) $check->fetchColumn();

			if ($count > 0) {
				// Aviso: não é possível excluir cliente com pedidos
				echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Não é possível excluir</title>';
				echo '<link rel="stylesheet" href="../cadastro.css">';
				echo '</head><body>';
				echo '<div style="max-width:600px;margin:40px auto;padding:20px;border:1px solid #ddd;background:#fff;border-radius:6px;">';
				echo '<h2>Exclusão não permitida</h2>';
				echo '<p>Este cliente não pode ser excluído porque possui <strong>' . $count . '</strong> pedido(s) cadastrados.</p>';
				echo '<p>Remova os pedidos relacionados antes de excluir o cliente.</p>';
				echo '<p><a href="consulta_cliente.php">Voltar à lista de clientes</a></p>';
				echo '</div>';
				echo '</body></html>';
				exit;
			}

			// Se não há pedidos, prossegue com exclusão
			$stmt = $conexao->prepare("DELETE FROM cliente WHERE cod_cliente = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				header("Location: consulta_cliente.php"); 
				exit;
			} else {
				echo "Erro ao excluir o registro.";
			}

		} catch (PDOException $e) {
			echo "Erro ao verificar/excluir o cliente: " . $e->getMessage();
		}

	} else {
		echo "ID não fornecido.";
	}
?>

