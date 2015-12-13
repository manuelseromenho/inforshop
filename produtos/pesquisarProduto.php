<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}
	
	require("../ligacaoBD.php");
		
?>

<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Produtos </h2> </td> </tr>
		<form action="pesquisarProduto.php" method="POST">
			<tr> <td> <p class="form"> ID do Produto: </p> </td> <td> <p> <input type="text" name="idProduto" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>

<?php

if(isset($_POST['pesquisar']))
{
	$idP = $_POST["idProduto"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$idP = $_POST["idProduto"];		
	}
	else
	{
		$idP = "";			
	} 

	$sql = "SELECT p.id_Produto, nomeProduto, num_Serie, stock, p.id_Subcategoria, s.subcategoria, c.categoria, p.id_Marca, m.marca FROM produtos as p, subcategorias as s, categorias as c, marcas as m WHERE id_Produto = '$idP' AND p.id_Subcategoria=s.id_Subcategoria AND s.id_Categoria=c.id_Categoria AND p.id_Marca=m.id_Marca";
 
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($idP, $nome, $numSerie, $stock, $idSub, $sub, $cat, $idM, $marca);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Produto </h2> </td> <td> <h2> Nome Produto </h2> </td> <td> <h2> Número Série </h2> </td> <td> <h2> Código Barras </h2> </td> <td> <h2> Stock </h2> </td> <td> <h2> Preço </h2> </td> <td> <h2> Subcategoria </h2> </td> <td> <h2> Categoria </h2> </td> <td> <h2> Marca </h2> </td>  <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $idP);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $numSerie </p> </td> ";
			echo "<td> <p class='label'> $cod </p> </td> ";
			echo "<td> <p class='label'> $stock </p> </td>";
			echo "<td> <p class='label'> $preco </p> </td> ";
			echo "<td> <p class='label'> $sub </p> </td> ";
			echo "<td> <p class='label'> $cat </p> </td> ";
			echo "<td> <p class='label'> $marca </p> </td> ";
			echo "<td class='img'> <a href='editarProduto.php?idP=$idP&nome=$nome&numSerie=$numSerie&cod=$cod&stock=$stock&preco=$preco&idSub=$idSub&idM=$idM'> <img src='../imagens/edit.png' title='Editar Produto'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarProduto.php?idP=$idP'> <img src='../imagens/trash.png' title='Eliminar Produto'> </a> </td> ";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br><br>";
		$stmt->close();
	}
}
$mysqli->close();
?>

		</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>
