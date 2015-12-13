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
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Serviços </h2> </td> </tr>
		<form action="pesquisarServico.php" method="POST">
			<tr> <td> <p class="form"> ID do Serviço: </p> </td> <td> <p> <input type="text" name="idServico" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>

<?php

if(isset($_POST['pesquisar']))
{
	$idS = $_POST["idServico"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$s = $_POST["idServico"];		
	}
	else
	{
		$s = "";			
	} 


	$sql = "SELECT id_Servico, tipoServico, preco, tempoEstimado FROM servicos WHERE id_Servico LIKE '%$idS%'";

	if ($stmt = $con->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($idS, $tipo, $preco, $tempo);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Serviço </h2> </td> <td> <h2> Tipo de Serviço </h2> </td> <td> <h2> Preço Serviço </h2> </td> <td> <h2> Tempo Estimado </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $idS);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $tipo </p> </td> ";
			echo "<td> <p class='label'> $preco € </p> </td> ";
			echo "<td> <p class='label'> $tempo min</p> </td>";
			echo "<td class='img'> <a href='editarServico.php?idS=$idS&tipo=$tipo&preco=$preco&tempo=$tempo'> <img src='../imagens/edit.png' title='Editar Cliente'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarServico.php?idS=$idS'> <img src='../imagens/trash.png' title='Eliminar Cliente'> </a> </td> ";
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