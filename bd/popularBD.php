<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'vista_chic';

try 
{
    $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8"; 
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Limpar tabelas existentes (em ordem inversa das foreign keys)
    $conexao->exec("DELETE FROM pedido");
    $conexao->exec("DELETE FROM cliente");
    $conexao->exec("DELETE FROM produto");
    $conexao->exec("ALTER TABLE cliente AUTO_INCREMENT = 1");
    $conexao->exec("ALTER TABLE produto AUTO_INCREMENT = 1");
    $conexao->exec("ALTER TABLE pedido AUTO_INCREMENT = 1");
    
    echo "Tabelas limpas com sucesso.<br><br>";

    // Inserir 5 clientes
    $clientes = [
        ["nome" => "Maria Silva", "email" => "maria@email.com", "senha" => "123456"],
        ["nome" => "João Santos", "email" => "joao@email.com", "senha" => "654321"],
        ["nome" => "Ana Costa", "email" => "ana@email.com", "senha" => "senha123"],
        ["nome" => "Pedro Oliveira", "email" => "pedro@email.com", "senha" => "p@ssw0rd"],
        ["nome" => "Carla Martins", "email" => "carla@email.com", "senha" => "carlasec"]
    ];
    
    foreach ($clientes as $cliente) {
        $sql = "INSERT INTO cliente (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$cliente['nome'], $cliente['email'], $cliente['senha']]);
    }
    echo "5 clientes inseridos com sucesso.<br>";

    // Inserir 5 produtos
    $produtos = [
        ["nome" => "Vestido Floral Elegante", "preco" => 189.90, "marca" => "Chic", "tipo" => "Vestido", "tamanho" => 40, "quantidade" => "25"],
        ["nome" => "Blusa Básica Branca", "preco" => 45.50, "marca" => "Classic", "tipo" => "Blusa", "tamanho" => 38, "quantidade" => "50"],
        ["nome" => "Calça Jeans Premium", "preco" => 129.90, "marca" => "Denim", "tipo" => "Calça", "tamanho" => 42, "quantidade" => "30"],
        ["nome" => "Jaqueta de Couro", "preco" => 299.99, "marca" => "Leather", "tipo" => "Jaqueta", "tamanho" => 36, "quantidade" => "15"],
        ["nome" => "Shorts Jeans Curto", "preco" => 69.90, "marca" => "Summer", "tipo" => "Shorts", "tamanho" => 40, "quantidade" => "40"]
    ];
    
    foreach ($produtos as $produto) {
        $sql = "INSERT INTO produto (nome, preco, marca, tipo, tamanho, quantidade) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            $produto['nome'], 
            $produto['preco'], 
            $produto['marca'], 
            $produto['tipo'], 
            $produto['tamanho'], 
            $produto['quantidade']
        ]);
    }
    echo "5 produtos inseridos com sucesso.<br>";

    // Inserir 5 pedidos
    $pedidos = [
        ["cod_cliente" => 1, "cod_produto" => 1],
        ["cod_cliente" => 2, "cod_produto" => 2],
        ["cod_cliente" => 3, "cod_produto" => 3],
        ["cod_cliente" => 4, "cod_produto" => 4],
        ["cod_cliente" => 5, "cod_produto" => 5]
    ];
    
    foreach ($pedidos as $pedido) {
        $sql = "INSERT INTO pedido (cod_cliente, cod_produto) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$pedido['cod_cliente'], $pedido['cod_produto']]);
    }
    echo "5 pedidos inseridos com sucesso.<br>";

    echo "<br><strong>✓ Banco de dados populado com sucesso!</strong>";

} catch (PDOException $e) {
    echo "Erro ao popular o banco: " . $e->getMessage();
}
?>
