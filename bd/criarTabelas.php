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
    
    $sql = 
        "CREATE TABLE IF NOT EXISTS cliente (
            cod_cliente INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(50) NOT NULL,
            email VARCHAR(20),
            senha VARCHAR(10)
        )";
    $conexao->exec($sql);
    echo "Tabela 'cliente' criada com sucesso (ou já existia).<br>";

    $sql = 
        "CREATE TABLE IF NOT EXISTS produto (
            cod_produto INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            preco double NOT NULL,
            marca VARCHAR(20),
            tipo VARCHAR(20),
            tamanho int,
            quantidade VARCHAR(20) NOT NULL
        )";
    ;
    $conexao->exec($sql);
    echo "Tabela 'produto' criada com sucesso (ou já existia).<br>";

    $sql_view =
        "CREATE OR REPLACE VIEW vw_produtos_por_preco AS
    SELECT
        cod_produto,
        nome,
        preco,
        marca,
        tipo,
        tamanho,
        quantidade,
        CASE
            WHEN preco > 150.00 THEN 'Luxo (Acima de R$150)' 
            WHEN preco BETWEEN 50.00 AND 150.00 THEN 'Intermediário (R$50 - R$150)' 
            ELSE 'Econômico (Abaixo de R$50)' 
        END AS faixa_preco
    FROM
        produto
    ORDER BY
        preco DESC
";
$conexao->exec($sql_view);
echo "View 'vw_produtos_por_preco' criada ou atualizada com sucesso.<br>";

    $sql = 
        "CREATE TABLE IF NOT EXISTS pedido (
            cod_pedido INT AUTO_INCREMENT PRIMARY KEY,
            cod_cliente INT,
            cod_produto INT,
            FOREIGN KEY(cod_cliente) REFERENCES cliente (cod_cliente),
            FOREIGN KEY(cod_produto) REFERENCES produto (cod_produto)
                ON DELETE CASCADE
                ON UPDATE CASCADE
        )";
    ;
    $conexao->exec($sql);
    echo "Tabela 'pedido' criada com sucesso (ou já existia).<br>";

} catch (PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}
?>
