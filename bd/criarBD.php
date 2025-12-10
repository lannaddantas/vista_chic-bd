<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';

try 
{
    $dsn = "mysql:host=$servidor;charset=utf8"; 
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS vista_chic";
    $conexao->exec($sql);

    echo "Banco de dados 'vista_chic' criado com sucesso (ou já existia).";
} catch (PDOException $e) {
    echo "Erro ao criar o banco de dados: " . $e->getMessage();
}
?>

