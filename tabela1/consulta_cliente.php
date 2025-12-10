<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../estilo.css">
  <link rel="stylesheet" href="../consulta.css">
  <title>Vista Chic</title>
  <link rel="icon" href="../img/vclogo.png">

  <style>
	table,th,td{
		border: 1px solid black;
		border-collapse: collapse;
	}
    #tabelaTarefas {
    margin: 0 auto;         
    border-collapse: collapse;
    width: 80%;     
        }   
        
        table{border-collapse: collapse;} th,td{border: 2px solid black; text-align: center;}
  </style>
  
</head>
<body>
<?php 
	require_once "..\BD\conexaoBD.php";
	$stmt = $conexao->query("SELECT * FROM cliente");
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
    </div>
    
  <main>
    
	<table id="tabelaTarefas" style="border-collapse: collapse;">
        <thead>
            <tr>
        <th colspan="5"><em>Lista de Registros</em></th>
        </tr>
	<tr>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Senha</th>
				<th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $r){ ?>
                <tr>
                    <td><?= htmlspecialchars($r['nome']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($r['senha']) ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?= $r['cod_cliente'] ?>"><img src="../img/editar.jpg" alt="Editar" width="25" height="25"></a>
                    </td>
                    <td>
                        <a href="excluir_cliente.php?id=<?= $r['cod_cliente'] ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?');"><img src="../img/excluir.jpg" alt="Excluir" width="25" height="25"></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
  </main>

</body>
</html>

