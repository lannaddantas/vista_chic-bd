<?php 
	require_once "..\BD\conexaoBD.php";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conexao->prepare("DELETE FROM cliente WHERE cod_cliente = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			header("Location: consulta_cliente.php"); 
			exit;
		} else {
			echo "Erro ao excluir o registro.";
		}
	} else {
		echo "ID não fornecido.";
	}
?>

