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

			<form action="pesquisarAssistencia.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Assistências </h2> </td> </tr>
				<tr> <td> <p class="form"> ID da Assistência: </p> </td> <td> <p class="label"> <input type="text" name="idAssistencia" class="selected"> </p> </td> </tr>
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
			</form>

		</table>

<?php



	if(isset($_POST['pesquisar']))
	{

		$id = $_POST["idAssistencia"];
		if (array_key_exists('pesquisar', $_POST))
		{
			$id = $_POST["idAssistencia"];		
		}
		else
		{
			$id = "";			
		}
	}


	$sql = "SELECT a.id_Assistencia, a.descricaoAssistencia, a.descricaoEquipamento, a.dataEntrada, a.dataSaida, a.id_Cliente, c.nomeCliente, a.id_Func, f.nomeFunc FROM assistencias as a, clientes as c, func as f WHERE a.id_Cliente = c.id_Cliente AND a.id_Func=f.id_Func AND a.id_Assistencia = '$id'";

	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id, $descricaoA, $descricaoE, $dataE, $dataS, $idC, $nomeC, $idF, $nomeF);

		echo "<br><br><br>";
		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Assistências </h2> </td> <td> <h2> Descrição Assistência </h2> </td> <td> <h2> Descrição Equipamento </h2> </td> <td> <h2> Data de Entrada </h2> </td> <td> <h2> Data de Saída </h2> </td> <td> <h2> Nome Cliente </h2> </td> <td> <h2> Nome Funcionário </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $id);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $descricaoA </p> </td> ";
			echo "<td> <p class='label'> $descricaoE </p> </td> ";
			echo "<td> <p class='label'> $dataE </p> </td>";
			echo "<td> <p class='label'> $dataS </p> </td> ";
			echo "<td> <p class='label'> $nomeC </p> </td> ";
			echo "<td> <p class='label'> $nomeF </p> </td> ";
			echo "<td class='img'> <a href='editarAssistencia.php?id=$id&descricaoA=$descricaoA&descricaoE=$descricaoE&dataE=$dataE&dataS=$dataS&idC=$idC&nomeC=$nomeC&idF=$idF&nomeF=$nomeF'> <img src='../imagens/edit.png' title='Editar Assistência'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarAssistencia.php?id=$id'> <img src='../imagens/trash.png' title='Eliminar Assistência'> </a> </td> ";
			echo "</tr>";
		}

		echo "</table>";
		echo "<br><br><br>";
		$stmt->close();
	}
$mysqli->close();


?>

	</div>
	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>

	

</body>

</html>

