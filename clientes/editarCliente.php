<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}
	
	//$con=$mysqli;

	if(isset($_POST['editar']))
	{

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$morada = $_POST['morada'];
		$telefone = $_POST['telefone'];
		$email = $_POST['email'];
		$nif = $_POST['nif'];

		//$sql = mysqli_query($mysqli, "UPDATE clientes SET nomeCliente='$nome', moradaCliente='$morada', telefoneCliente='$telefone', emailCliente='$email', nifCliente='$nif' WHERE id_Cliente='$id'");
		$sql = "UPDATE cliente SET nomeCliente='$nome', moradaCliente='$morada', telefoneCliente='$telefone', emailCliente='$email', nifCliente='$nif' WHERE id_Cliente='$id'";

		
		
		if ($mysqli->query($sql) === TRUE)
			{
				echo "<script> alert('Cliente editado com sucesso!') </script>";

				//$sql_novo_cliente = "SELECT * FROM clientes ORDER BY id_Cliente DESC LIMIT 1";
				//$result = $mysqli->query($sql_novo_cliente);

				//if ($result->num_rows > 0) 
				//{
			    	// output data of each row
				    //while($row = $result->fetch_assoc()) 
				    //{
				      	
				        //echo "<script> alert(\"ID Cliente: ".$row['id_Cliente'].'.\t Nome Cliente: ' .$row['nomeCliente']. "\") </script>";
				       	echo "<script type=\"text/javascript\"> 
				       					window.location=\"sucesso.php\";
				       		 </script>";

				    //}
				//} 
				//else 
				//{
				//    echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
				//}
			}
			else
			{
				"<script type=\"text/javascript\">
					alert(\"ERROR: " .$sql. '\n' .$mysqli->error."\");
				</script>";

			}



		/*if ($stmt = $con->prepare($sql)) 

		{

			echo "OLA";			
			$stmt->execute();

			$stmt->bind_result($nome, $morada, $telefone, $email, $nif);

		

			while ($stmt->fetch()) 

			{

				echo "<script> alert('Cliente alterado com sucesso!\n')windows.location.href='editarCliente.php'; </script>";

			}

					
			$stmt->close();

		}*/

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

	<table class="procura">

	<form action="editarCliente.php" method="POST">

		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Cliente </h2> </td> </tr>

	 	<tr> <td> <p class="label"> ID Cliente: </p> </td> 	<td> <p> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="selected" maxlength="4" readonly="readonly"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Morada: </p> </td> 		<td> <p> <input type="text" name="morada" value="<?php $morada=$_GET['morada']; echo $morada; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Telefone: </p> </td> 	<td> <p> <input type="text" name="telefone" value="<?php $telefone=$_GET['telefone']; echo $telefone; ?>" maxlength="9" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> E-mail: </p> </td> 		<td> <p> <input type="text" name="email" value="<?php $email=$_GET['email']; echo $email; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> NIF: </p> </td> 		<td> <p> <input type="text" name="nif" value="<?php $nif=$_GET['nif']; echo $nif; ?>" class="selected" maxlength="9"> </p> </td> </tr>
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>

	</form>

	</table>

	</div>

	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>



</body>

</html>

