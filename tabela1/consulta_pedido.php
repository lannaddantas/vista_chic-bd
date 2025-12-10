<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../estilo.css">
  <link rel="stylesheet" href="../consulta.css">
  <title>Vista Chic</title>
  <style>
	table,th,td{
		border: 1px solid black;
		border-collapse: collapse;
	}
    #tabelaTarefas {
    margin: 0 auto;         
    border-collapse: collapse;
    width: 90%;     
        }   
        
        table{border-collapse: collapse;} th,td{border: 2px solid black; text-align: center;}
  </style>
  
</head>
<body>
<?php 
    require_once "..\BD\conexaoBD.php";
    $stmt = $conexao->query("
        SELECT 
            p.cod_pedido,
            p.cod_cliente,
            p.cod_produto,
            c.nome AS cliente_nome,
            c.email AS cliente_email,
            pr.nome AS produto_nome,
            pr.preco,
            pr.marca
        FROM pedido p
        INNER JOIN cliente c ON p.cod_cliente = c.cod_cliente
        INNER JOIN produto pr ON p.cod_produto = pr.cod_produto
        ORDER BY p.cod_pedido DESC
    "); 
    $registros = $stmt->fetchAll();
?>
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
                    <li><a href="consulta_cliente.php">Consulta Cliente</a></li>
                    <li><a href="consulta_produto.php">Consulta Produto</a></li>
                    <li><a href="consulta_pedido.php">Consulta Pedido</a></li>
                </ul>
            </nav>
            <div class="titulo">
                <h1>Vista Chic</h1>
            </div>

        </header>
    </div>
    
  <main>
	<table id="tabelaTarefas" style="border-collapse: collapse;">
        <thead>
    <tr>
        <th colspan="10">Lista de Pedidos</th>
        </tr>
	<tr>
        <th>ID Pedido</th>
        <th>Cliente</th>
        <th>Email Cliente</th>
        <th>Produto</th>
        <th>Marca</th>
        <th>Preço</th>
        <th>ID Cliente</th>
        <th>ID Produto</th>
        <th>Editar</th>
        <th>Remover</th>
    </tr>
    </thead>
        <tbody>
            <?php if (empty($registros)): ?>
                <tr>
                    <td colspan="10">Nenhum pedido cadastrado</td>
                </tr>
            <?php else: ?>
                <?php foreach ($registros as $r){ ?>
                    <tr>
                        <td><?= htmlspecialchars($r['cod_pedido']) ?></td>
                        <td><?= htmlspecialchars($r['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($r['cliente_email']) ?></td>
                        <td><?= htmlspecialchars($r['produto_nome']) ?></td>
                        <td><?= htmlspecialchars($r['marca']) ?></td>
                        <td>R$ <?= number_format($r['preco'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($r['cod_cliente']) ?></td>
                        <td><?= htmlspecialchars($r['cod_produto']) ?></td>
                        <td>
                            <a href="editar_pedido.php?id=<?= $r['cod_pedido'] ?>"><img src="../img/editar.jpg" alt="Editar" width="25" height="25"></a>
                        </td>
                        <td>
                            <a href="excluir_pedido.php?id=<?= $r['cod_pedido'] ?>" onclick="return confirm('Tem certeza que deseja excluir este pedido?');"><img src="../img/excluir.jpg" alt="Excluir" width="25" height="25"></a>
                        </td>
                    </tr>
                <?php } ?>
            <?php endif; ?>
        </tbody>
    </table>
    
  </main>

</body>
</html>
