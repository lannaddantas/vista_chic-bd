<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criação de Índices</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        fieldset {
            width: 60%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        legend {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }
        .msg {
            margin: 5px 0;
            font-size: 15px;
        }
        .sucesso { color: green; }
        .aviso { color: orange; }
        .erro { color: red; }
    </style>
</head>
<body>

<fieldset>
    <legend>Criação de Índices no Banco de Dados</legend>

<?php
require_once "..\BD\conexaoBD.php";

try {
    $indices = [
        // Índices da tabela cliente
        "CREATE INDEX idx_cliente_nome ON cliente (nome)",
        "CREATE INDEX idx_cliente_email ON cliente (email)",

        // Índices da tabela produto
        "CREATE INDEX idx_produto_nome ON produto (nome)",
        "CREATE INDEX idx_preco_produto ON produto (preco)",
        "CREATE INDEX idx_marca_produto ON produto (marca)",
        "CREATE INDEX idx_tipo_produto ON produto (tipo)",
        "CREATE INDEX idx_tamanho_produto ON produto (tamanho)",
        "CREATE INDEX idx_quantidade_produto ON produto (quantidade)"
    ];

    echo "<p class='msg sucesso'>Conexão estabelecida com sucesso!</p><hr>";

    foreach ($indices as $sql) {
        try {
            $conexao->exec($sql);
            echo "<p class='msg sucesso'>Índice criado: <b>$sql</b></p>";
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate key name')) {
                echo "<p class='msg aviso'>Índice já existente — ignorado: <b>$sql</b></p>";
            } else {
                echo "<p class='msg erro'>Erro ao criar índice: " . $e->getMessage() . "</p>";
            }
        }
    }

    echo "<hr><p><b>Processo concluído!</b></p>";

} catch (PDOException $e) {
    echo "<p class='msg erro'>Erro ao executar: " . $e->getMessage() . "</p>";
}
?>

</fieldset>

</body>
</html>