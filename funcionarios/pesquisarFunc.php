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
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Funcionários </h2> </td> </tr>
		<form action="pesquisarFunc.php" method="POST">
			<tr> <td> <p class="form"> ID do Funcionário: </p> </td> <td> <p> <input type="text" name="idFunc" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>

<?php

if(isset($_POST['pesquisar']))
{
	$id = $_POST["idFunc"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$id = $_POST["idFunc"];		
	}
	else
	{
		$id= "";			
	} 

	if($id == null)
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		ORDER BY id_funcionario";
	}
	else
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		WHERE id_funcionario = '$id'";
	}


	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id, $nome, $morada, $telefone, $nif, $morada, $dataN, $dataE);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID </h2> </td> <td> <h2> Nome Funcionário </h2> </td> <td> <h2> Morada </h2> </td> <td> <h2> Telefone </h2> </td> <td> <h2> E-mail </h2> </td> <td> <h2> NIF </h2> </td> <td> <h2> Data Nascimento </h2> </td> <td> <h2> Data Entrada Serviço </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $id);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $morada </p> </td> ";
			echo "<td> <p class='label'> $telefone </p> </td>";
			echo "<td> <p class='label'> $nif </p> </td> ";
			echo "<td> <p class='label'> $email </p> </td> ";
			echo "<td> <p class='label'> $dataN </p> </td> ";
			echo "<td> <p class='label'> $dataE </p> </td> ";
			echo "<td class='img'> <a href='editarFunc.php?id=$id&nome=$nome&morada=$morada&telefone=$telefone&email=$email&nif=$nif&dataN=$dataN&dataE=$dataE'> <img src='../imagens/edit.png' title='Editar Funcionário'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarFunc.php?id=$id'> <img src='../imagens/trash.png' title='Eliminar Funcionário'> </a> </td> ";
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