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

		<form action="pesquisarCliente.php" method="POST">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Clientes </h2> </td> </tr>
			<tr> <td> <p class="form"> ID do Cliente: </p> </td> <td> <p> <input type="text" name="idCliente" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff">  <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>



<?php


if(isset($_POST['pesquisar']))
{
	$id = $_POST["idCliente"];
	if (array_key_exists('pesquisar', $_POST))
	{
		$id = $_POST["idCliente"];		
	}
	else
	{
		$id = "";			
	} 


	if($id == null)
	{
		$sql = "SELECT id_Cliente, nome, morada, telefone, email, nif 
				FROM clientes ORDER BY id_Cliente";
	}
	else
	{
		$sql = "SELECT id_Cliente, nome, morada, telefone, email, nif
				FROM clientes 
				WHERE id_Cliente = '$id'";
	}
}	
	

	if ($stmt = $mysqli->prepare($sql)) 
	{

		$stmt->execute();
		$stmt->bind_result($id, $nome, $morada, $telefone, $email, $nif);

		echo "<br><br><br>";
		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Cliente </h2> </td> <td> <h2> Nome Cliente </h2> </td> <td> <h2> Morada </h2> </td> <td> <h2> Telefone </h2> </td> <td> <h2> E-mail </h2> </td> <td> <h2> NIF </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";


		while ($stmt->fetch()) 
		{
			$offset_count = $offset_count + 1;
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $id);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $morada </p> </td> ";
			echo "<td> <p class='label'> $telefone </p> </td>";
			echo "<td> <p class='label'> $email </p> </td> ";
			echo "<td> <p class='label'> $nif </p> </td> ";
			echo "<td class='img'> <a href='editarCliente.php?id=$id&nome=$nome&morada=$morada&telefone=$telefone&email=$email&nif=$nif'> <img src='../imagens/edit.png' title='Editar Cliente'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarCliente.php?id=$id'> <img src='../imagens/trash.png' title='Eliminar Cliente'> </a> </td> ";

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