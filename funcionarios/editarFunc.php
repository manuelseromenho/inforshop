<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	if(isset($_POST['editar']))
	{
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$morada = $_POST['morada'];
		$telefone = $_POST['telefone'];
		$email = $_POST['email'];
		$nif = $_POST['nif'];
		$dataN = $_POST['dataN'];
		$dataE = $_POST['dataE'];

		$sql = "UPDATE funcionarios SET id_funcionario='$id', nome='$nome', morada='$morada', telefone='$telefone', email='$email', nif='$nif', data_nascimento='$dataN', data_entrada='$dataE' WHERE id_funcionario='$id'";

		if ($mysqli->query($sql) === TRUE) 
		{
			echo "<script> alert('Cliente editado com sucesso!') </script>";
			echo "<script type=\"text/javascript\"> 
				       window.location=\"sucesso.php\";
				  </script>";

			/*$stmt->execute();
			$stmt->bind_result($id, $nome, $morada, $telefone, $email, $nif, $dataN, $dataE);

			while ($stmt->fetch()) 
			{
				echo "<h2>Funcionário alterado com sucesso!</h2>";
			}
			echo "<h2>Funcionário alterado com sucesso!</h2>";
			$stmt->close();*/
		}
		else
		{
			"<script type=\"text/javascript\">
				alert(\"ERROR: " .$sql. '\n' .$mysqli->error."\");
			</script>";

		}
	}
	mysqli_close($mysqli);
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
	<form action="editarFunc.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Funcionário </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Funcionário: </p> </td> 	<td> <p> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="input" maxlength="4" readonly="readonly"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Morada: </p> </td> 		<td> <p> <input type="text" name="morada" value="<?php $morada=$_GET['morada']; echo $morada; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Telefone: </p> </td> 	<td> <p> <input type="text" name="telefone" value="<?php $telefone=$_GET['telefone']; echo $telefone; ?>" maxlength="9" class="input"> </p> </td> </tr>
		<tr> <td> <p class="label"> E-mail: </p> </td> 		<td> <p> <input type="text" name="email" value="<?php $email=$_GET['email']; echo $email; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> NIF: </p> </td> 		<td> <p> <input type="text" name="nif" value="<?php $nif=$_GET['nif']; echo $nif; ?>" class="input" maxlength="9"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Data Nascimento: </p> </td> <td> <p> <input type="text" name="dataN" value="<?php $dataN=$_GET['dataN']; echo $dataN; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Data Entrada Serviço: </p> </td> <td> <p> <input type="text" name="dataE" value="<?php $dataE=$_GET['dataE']; echo $dataE; ?>" class="input"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
