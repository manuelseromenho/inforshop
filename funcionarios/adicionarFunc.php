<?php 
	require("../ligacaoBD.php");
	
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
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
	
<?php

	$select = "SELECT * FROM funcionarios";
	

 	if(isset($_POST['adicionar']))
	{
		$id = mysql_insert_id();
		$nome = mysqli_real_escape_string($mysqli, $_POST["nome"]); 
		$morada = mysqli_real_escape_string($mysqli, $_POST["morada"]);
		$telefone = mysqli_real_escape_string($mysqli, $_POST["telefone"]);
		$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
		$nif = mysqli_real_escape_string($mysqli, $_POST["nif"]);
		$dataN = mysqli_real_escape_string($mysqli, $_POST["dataN"]);
		$dataE = mysqli_real_escape_string($mysqli, $_POST["dataE"]);
		
		//Verifica se existe um cliente com o mesmo nome e nif na tabela clientes, antes de adicionar.
		$checkn = "SELECT * FROM funcionarios WHERE nome='$nome' AND nif='$nif'";
		$sqlcheckn = mysqli_multi_query($mysqli, $checkn);
		echo "<script> alert('$sqlcheckn')</script>";
		
		if($sqlcheckn == 0)
		{
			
			$sql = "INSERT INTO funcionarios VALUES ('', '$nome', '$morada', '$telefone', '$nif', '$email', '$dataN', '$dataE')";
			
			if (mysqli_multi_query($mysqli, $sql))
			{
				//echo "<script> alert('Cliente inserido com sucesso!') ";

				$sql_novo_func = "SELECT * FROM funcionarios ORDER BY id_funcionario DESC LIMIT 1";
				$result = $mysqli->query($sql_novo_func);

				if ($result->num_rows > 0) 
				{
			    	// output data of each row
				    while($row = $result->fetch_assoc()) 
				    {
				        //echo "<script> alert(\"ID Cliente: ".$row['id_Cliente'].'.\t Nome Cliente: ' .$row['nomeCliente']. "\") </script>";
				        //echo "<script> alert(\"ID Funcionário: ".$row['id_funcionario'].'.\t Nome Funcionário: ' .$row['nome']. "\") </script>";
				        echo "<script type=\"text/javascript\"> 
				       					window.location=\"sucesso.php\";
				       		 </script>";
				    }
				} 
				else 
				{
				    echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
				}
			}
			else
			{
				echo "<script> alert('ERROR SQL'); </script>";
				//echo "<script> alert('ERROR: ' .$sql. '<br>' . $mysqli->error.') </script>";
			}
		}
	}
		
	$mysqli->close();
?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

		<table>
			<form action="adicionarFunc.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar Novo Funcionário </h2> </td> </tr>
				 
		    	<tr> <td> <p class="label"> Nome: </p> </td> 					<td> <p> <input type="text" name="nome" class="input"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Morada: </p> </td> 					<td> <p> <input type="text" name="morada" class="input"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Telefone: </p> </td> 				<td> <p> <input type="text" name="telefone" class="input" maxlength="9"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> NIF: </p> </td>						<td> <p> <input type="text" name="nif" class="input" maxlength="9"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> E-mail: </p> </td> 					<td> <p> <input type="text" name="email" class="input"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> Data Nascimento: </p> </td>			<td> <p> <input type="date" name="dataN" class="selected"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> Data Entrada ao Serviço: </p> </td>	<td> <p> <input type="date" name="dataE" class="selected"> </p> </td> </tr>
				 
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="Adicionar"> </td>
			</form>
		</table>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>