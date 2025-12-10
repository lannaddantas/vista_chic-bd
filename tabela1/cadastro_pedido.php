<?php

require_once "..\BD\conexaoBD.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
	$clientes = $_POST['cliente'] ?? '';
	$produtos = $_POST['produto'] ?? '';
	try{
		$sql = "INSERT INTO pedidos (cod_cliente, cod_produto) VALUES (:cliente, :produto)";
		$stmt = $conexao->prepare($sql);
		$stmt->execute([
			':cliente' => $clientes,
			':produto'  => $produtos,
		]);

		echo "<p>Registro cadastrado com sucesso!</p>";
	} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
	}
}

else {
	echo "<p>Requisição inválida.</p>";
} 	

?>

