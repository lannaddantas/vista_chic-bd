<?php

require_once "..\BD\conexaoBD.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
	$campo2  = $_POST['tNome'] ?? '';
	$campo3  = $_POST['tPreco'] ?? '';
	$campo4  = $_POST['tMarca'] ?? '';
	$campo5  = $_POST['tTipo'] ?? '';
	$campo6 = isset($_POST['tTamanho']) ? strtoupper(trim($_POST['tTamanho'])) : '';
	$campo7  = $_POST['tQuantidade'] ?? '';
	
	try{
		$sql = "INSERT INTO produto (nome, preco, marca, tipo, tamanho, quantidade) VALUES (:tNome, :tPreco, :tMarca, :tTipo, :tTamanho, :tQuantidade)";
		$stmt = $conexao->prepare($sql);
		$stmt->execute([
			':tNome'  => $campo2,
			':tPreco'   => $campo3,
			':tMarca'  => $campo4,
			':tTipo'  => $campo5,
			':tTamanho'   => $campo6,
			':tQuantidade'  => $campo7
		]);

		echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../cadastroproduto.html';</script>";
	} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
	}
}

else {
	echo "<p>Requisição inválida.</p>";
} 	

?>

