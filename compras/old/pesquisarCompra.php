<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
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
	<form action="pesquisarCompra.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de uma Compra </h2> </td> </tr>
		<tr> <td> <p class="label"> ID Compra: </p> </td> <td> <p> <input type="text" name="idCompra" class="selected"> </p> </td> </tr>
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisarC" class="button"> </td> </tr>
	</form>
	</table>

<?php

if(isset($_POST['pesquisarC']))
{
	$id_C = $_POST["idCompra"];
	
	if (array_key_exists('pesquisarC', $_POST))
	{
		$s = $_POST["idCompra"];		
	}
	else
	{
		$s = " ";			
	} 

	//$sql = "SELECT id_compra, idP, idC, dataCompra, totalCompra FROM comprar WHERE id_compra LIKE '%$idCompra%'";
	$sql = "SELECT com.id_Compra, com.id_Produto, p.nomeProduto, com.id_Cliente, c.nome, com.dataCompra, com.quantidade, com.precoTotal FROM compra as com, clientes as c, produtos as p WHERE com.id_Compra LIKE '%$id_C%' AND com.id_Cliente = c.id_Cliente AND com.id_Produto = p.id_Produto";

	if ($stmt = $con->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id_C, $idP, $nomeP, $idC, $nomeC, $data, $quantidade, $preco);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> 
		<td> <h2> ID Compra </h2> </td> </td> 
		<td> <h2> Descrição Produto </h2> </td> 
		<td> <h2> Nome Cliente </h2> </td> 
		<td> <h2> Data Compra </h2> </td> 
		<td> <h2> Quantidade </h2> </td> 
		<td> <h2> Preço Total </h2> </td> 
		<td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $id_C);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $nomeP </p> </td> ";
			echo "<td> <p class='label'> $nomeC </p> </td> ";
			echo "<td> <p class='label'> $data </p> </td>";
			echo "<td> <p class='label'> $quantidade </p> </td> ";
			echo "<td> <p class='label'> $preco </p> </td> ";
			echo "<td class='img'> <a href='editarCompra.php?id_C=$id_C&idP=$idP&nomeP=$nomeP&idC=$idC&nomeC=$nomeC&data=$data&quantidade=$quantidade&preco=$preco'> <img src='../imagens/edit.png' title='Editar Compra'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarCompra.php?id_C=$id_C'> <img src='../imagens/trash.png' title='Eliminar Compra'> </a> </td> ";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br><br>";
		$stmt->close();
	}
}
$con->close();
?>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>

