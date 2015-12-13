<?php 

	session_start(); /* Starts the session */



	if(!isset($_SESSION['user']))

	{

		header("location:login.php");

		exit;

	}



	require("../ligacaoBD.php");



	if(isset($_POST['editar']))

	{

		$id = $_POST['id'];

		$descricaoA = $_POST['descricaoA'];

		$descricaoE = $_POST['descricaoE'];

		$dataE = $_POST['dataE'];

		$dataS = $_POST['dataS'];

		$idC = $_POST['idC'];

		$idF = $_POST['idF'];



		$sql = mysqli_query($mysqli, "UPDATE assistencias SET id_Assistencia='$id', descricaoAssistencia='$descricaoA', descricaoEquipamento='$descricaoE', dataEntrada='$dataE', dataSaida='$dataS', id_Cliente='$idC', id_Func='$idF' WHERE id_Assistencia = '$id'");



		if ($stmt = $mysqli->prepare($sql)) 

		{

			$stmt->execute();

			$stmt->bind_result($id, $descricaoA, $descricaoE, $dataE, $dataS, $idC, $idF);



			while ($stmt->fetch()) 

			{

				echo "<script> alert('Assistência alterada com sucesso!\n'); </script>";

			}

		

			$stmt->close();

		}

	}

	



?>



<html>

<head>

	<title> INFORSHOP </title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>

	<meta charset='utf-8'>  

</head>

<body>

	<!-- ************ HEADER ************** -->

	<?php include("header.php"); ?>

	<!-- ***************** BODY *****************-->

	<div class="container">



		<table>

			<form action="adicionarAssistencia.php" method="POST">

				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Editar uma Assistência </h2> </td> </tr>

				 

		    	<tr> <td> <p class="label"> Descrição Assistência: </p> </td> 	<td> <p> <input type="text" name="descricaoA" value="<?php $descricaoA=$_GET['descricaoA']; echo $descricaoA; ?>" class="input"> </p> </td></tr>

		        <tr> <td> <p class="label"> Descrição Equipamento: </p> </td> 	<td> <p> <input type="text" name="descricaoE" value="<?php $descricaoE=$_GET['descricaoE']; echo $descricaoE; ?>" class="input"> </p> </td> </tr>

		        <tr> <td> <p class="label"> Data de Entrada: </p> </td> 		<td> <p> <input type="text" name="data" value="<?php $dataE=$_GET['dataE']; echo $dataE; ?>" class="input"> </p>  </td> </tr>

				<tr> <td> <p class="label"> Data de Saída: </p> </td> 		<td> <p> <input type="text" name="data" value="<?php $dataS=$_GET['dataS']; echo $dataS; ?>" class="input"> </p>  </td> </tr>

				<tr> 

					<td> <p class="label"> ID Cliente: </p> </td> 

					<td>

<?php

	$sql = "SELECT id_Cliente, nome FROM clientes ORDER BY id_Cliente";



	if ($smtp = $mysqli->prepare($sql))

	{

		$smtp->execute();						

		$smtp->bind_result($idC, $nomeC);

		echo $idC;

		

		//echo "<p class='label'> <select name='nomeCliente' value='$_SESSION['valor']'>";

		//echo "<p class='label'> <select name='nomeCliente'>";



		echo "<p class='label'> <select name='$idC' class='selected'>";



		while ($smtp->fetch())

		{	

			if($idC != $idC)

			{

				//echo "<option value='$idC'> $nomeC ($idC) </option>\n";

				echo "<option value='$idC'> $idC </option>\n";

			}

			else

			{

				echo "<option value='$idC' selected> $idC </option>\n";				

			}

		}

		echo "</select>";



	}

?>

				<tr> <td> <p class="label"> Nome Cliente: </p> </td> 			<td> <p> <input type="text" name="nomeC" value="<?php $nomeC=$_GET['nomeC']; echo $nomeC; ?>" class="input"> </p>  </td> </tr>

				<tr> 

					<td> <p class="label"> ID Funcionário </p> </td>

					<td> 

<?php

	$sql = "SELECT id_Func, nome FROM func ORDER BY id_Func";



	if ($smtp = $mysqli->prepare($sql))

	{



		$smtp->execute();						

		$smtp->bind_result($idF, $nomeF);

		

		//echo "<p class='label'> <select name='nomeCliente' value='$_SESSION['valor']'>";

		echo "<p class='label'> <select name='$idF' class='selected'>";



		while ($smtp->fetch())

		{	

			if($idF != null)

			{

				echo "<option value='$idF'> $idF </option>\n";

			}

			else

			{

				echo "<option value='$idF' selected> $idF </option>\n";				

			}

		}

		echo "</select>";



	}

?>

					</td>

				</tr>

				<tr> <td> <p class="label"> Nome Funcionário: </p> </td> 			<td> <p> <input type="text" name="nomeF" value="<?php $nomeF=$_GET['nomeF']; echo $nomeF; ?>" class="input"> </p>  </td> </tr>					



				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="editar" class="button" value="Editar"> </td>

			</form>

		</table>

	</div>



	<!--<table>

	<form action="editarCliente.php" method="POST">

		<tr><td colspan="3"> <h2> Editar um Cliente </h2> </td> </tr>

	 	

	 	<tr> <td> <p class="label"> ID Cliente: </td> 	<td> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="input"> </p> </td> </tr>

    	<tr> <td> <p class="label"> Nome: </td> 		<td> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="input"> </p> </td> </tr>

       	<tr> <td> <p class="label"> Morada: </td> 		<td> <input type="text" name="morada" value="<?php $morada=$_GET['morada']; echo $morada; ?>" class="input"> </p> </td> </tr>

       	<tr> <td> <p class="label"> Telefone: </td> 	<td> <input type="text" name="telefone" value="<?php $telefone=$_GET['telefone']; echo $telefone; ?>" class="input"> </p> </td> </tr>

		<tr> <td> <p class="label"> E-mail: </td> 		<td> <input type="text" name="email" value="<?php $email=$_GET['email']; echo $email; ?>" class="input"> </p> </td> </tr>

    	<tr> <td> <p class="label"> NIF: </td> 			<td> <input type="text" name="nif" value="<?php $nif=$_GET['nif']; echo $nif; ?>" class="input"> </p> </td> </tr>

		

		<tr> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>

	</form>

	</table>-->



	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>



</body>

</html>

