<?php 
	require_once "..\BD\conexaoBD.php";

	if (isset($_GET['id'])) {
		$id = (int) $_GET['id'];

		try {
			$stmt = $conexao->prepare("DELETE FROM pedido WHERE cod_pedido = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				header("Location: consulta_pedido.php"); 
				exit;
			} else {
				echo "Erro ao excluir o registro.";
			}

		} catch (PDOException $e) {
			echo "Erro ao excluir o pedido: " . $e->getMessage();
		}

	} else {
		echo "ID não fornecido.";
	}
?>
