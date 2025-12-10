<?php

require_once "..\BD\conexaoBD.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
	$campo2  = $_POST['tNome'] ?? '';
	$campo3   = $_POST['tEmail'] ?? '';
	$campo4  = $_POST['tSenha'] ?? '';
	try{
		$sql = "INSERT INTO cliente (nome, email, senha) VALUES (:tNome, :tEmail, :tSenha)";
		$stmt = $conexao->prepare($sql);
		$stmt->execute([
			':tNome'  => $campo2,
			':tEmail'   => $campo3,
			':tSenha'  => $campo4
		]);

		echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../cadastro.html';</script>";
	} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
	}
}

else {
	echo "<p>Requisição inválida.</p>";
} 	

?>


