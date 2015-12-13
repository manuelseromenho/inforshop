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

	$select = "SELECT * FROM func";
	

 	if(isset($_POST['adicionar']))
	{
		$id = mysql_insert_id();
		$nome = mysqli_real_escape_string($con, $_POST["nome"]); 
		$morada = mysqli_real_escape_string($con, $_POST["morada"]);
		$telefone = mysqli_real_escape_string($con, $_POST["telefone"]);
		$email = mysqli_real_escape_string($con, $_POST["email"]);
		$nif = mysqli_real_escape_string($con, $_POST["nif"]);
		$dataN = mysqli_real_escape_string($con, $_POST["dataN"]);
		$dataE = mysqli_real_escape_string($con, $_POST["dataE"]);
		
		$checkn = "SELECT * FROM func WHERE nome='$nome' AND nif='$nif'";

		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)
		{
			$sql = "INSERT INTO func VALUES ('$id', '$nome', '$morada', '$telefone', '$email', '$nif', '$dataN', '$dataE')";
			
			if (mysqli_multi_query($con, $sql))
			{
				//echo "<script> alert('Cliente inserido com sucesso!') ";

				$sql = "SELECT * FROM func ORDER BY id_Func DESC LIMIT 1";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
			    	// output data of each row
				    while($row = $result->fetch_assoc()) 
				    {
				        echo "<script> alert('ID Funcionário: ".$row["id_Func"].". Nome Funcionário: " .$row["nomeFunc"]. "') </script>";
				    }
				} 
				else 
				{
				    echo "<script> alert('Impossivel inserir este reisto. TENTE DE NOVO.'); </script>";
				}
			}
			else
			{
				echo "<script> alert('ERROR: ' .$sql. '<br>' . $con->error.') </script>";
			}
		}
	}
		
	$con->close();
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
				<tr> <td> <p class="label"> E-mail: </p> </td> 					<td> <p> <input type="text" name="email" class="input"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> NIF: </p> </td>						<td> <p> <input type="text" name="nif" class="input" maxlength="9"> </p> </td> </tr>
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