<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Chic</title>

    <link rel="icon" href="img/vclogo.png">
    <link rel="stylesheet" href="../estilo.css">
    <link rel="stylesheet" href="../cadastro.css">
    <style>
        body {
            background-image: url('./img/vcfundo.png');
            /* LINK da imagem */
            background-size: cover;
            /* cobre toda a tela */
            background-repeat: no-repeat;
            /* não repete */
            background-position: center;
            /* centraliza */
        }
    </style>
    
</head>

<body>
    <div id="interface">

        <!-- start header -->
        <header>
            <nav class="navbar">
                <ul>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="../login.html">Login</a></li>
                    <li><a href="../paginadehistoria.html">Pagina de Historia</a></li>
                    <li><a href="../produtos.html">Produtos</a></li>
                    <li><a href="../cadastro.html">Cadastro Cliente</a></li>
                    <li><a href="../cadastroproduto.html">Cadastro Produto</a></li>
                    <li><a href="../cadastroPedido.html">Cadastro Pedido</a></li>
                    <li><a href="consulta_cliente.php">Consulta Cliente</a></li>
                    <li><a href="consulta_produto.php">Consulta Produto</a></li>
                    <li><a href="criar_indices.php">Indices</a></li>
                </ul>
            </nav>
            <div class="titulo">
                <h1>Vista Chic</h1>

            </div>

        </header>
        <!-- conteúdo principal -->
        <main>
            <?php
	require_once "../BD/conexaoBD.php";

	$clientes = $conexao->query("SELECT cod_cliente, nome FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
    $produtos = $conexao->query("SELECT cod_produto, nome FROM produto")->fetchAll(PDO::FETCH_ASSOC);

?>
            <div class="cadastro">

                <!-- <form id="formCadastro"> -->
                <form id="formCadastroPedido" action="cadastro_pedido.php" method="POST">
                    <label for="cliente">Escolha um cliente:</label>
                    <select name="cliente" required>
                        <?php foreach ($clientes as $cliente){ ?>
                        <option value="<?= $cliente['cod_cliente'] ?>">
                            <?= htmlspecialchars($cliente['nome']) ?>
                        </option>
                        <?php } ?>
                    </select><br>

                    <label for="produto">Escolha um produto:</label>
                    <select name="produto" required>
                        <?php foreach ($produtos as $produto){ ?>
                        <option value="<?= $produto['cod_produto'] ?>">
                            <?= htmlspecialchars($produto['nome']) ?>
                        </option>
                        <?php } ?>
                    </select><br>
                </form>

            </div>









            <button class="enviar" type="submit">Cadastrar Pedido</button>
            </form>
        </main>

        <!-- rodapé -->
        <footer class="rodape">
            <div class="slogan">
                <h2>Trabalho desenvolvido por: Laércio, Lanna, Maria Clara</h2>
            </div>
        </footer>
    </div>
</body>

</html>