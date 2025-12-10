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
    width: 80%;     
        }   
        
        table{border-collapse: collapse;} th,td{border: 2px solid black; text-align: center;}
  </style>
  
</head>
<body>
<?php 
    require_once "..\BD\conexaoBD.php";
    $stmt = $conexao->query("SELECT * FROM vw_produtos_por_preco"); 
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
        <th colspan="9">Lista de Registros</th>
        </tr>
	<tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Marca</th>
        <th>Tipo</th>
        <th>Tamanho</th>
        <th>Quantidade</th>
        <th>Faixa de Preço</th> 
        <th>Alterar</th>
        <th>Remover</th>
    </tr>
    </thead>
        <tbody>
            <?php foreach ($registros as $r){ ?>
                <tr>
                    <td><?= htmlspecialchars($r['nome']) ?></td>
                    <td><?= htmlspecialchars($r['preco']) ?></td>
                    <td><?= htmlspecialchars($r['marca']) ?></td>
                    <td><?= htmlspecialchars($r['tipo']) ?></td>
                    <td><?= htmlspecialchars($r['tamanho']) ?></td>
                    <td><?= htmlspecialchars($r['quantidade']) ?></td>
                    <td><?= htmlspecialchars($r['faixa_preco']) ?></td>
                    <td>
                        <a href="editar_tabela1.php?id=<?= $r['cod_produto'] ?>"><img src="../img/editar.jpg" alt="Editar" width="25" height="25"></a>
                    </td>
                    <td>
                        <a href="excluir_consulta.php?id=<?= $r['cod_produto'] ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?');"><img src="../img/excluir.jpg" alt="Excluir" width="25" height="25"></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
  </main>

</body>
</html>

