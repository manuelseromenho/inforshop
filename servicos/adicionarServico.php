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

	$select = "SELECT * FROM servicos";

 	if(isset($_POST['adicionar']))
	{
		$id = mysql_insert_id();
		$tipo = mysqli_real_escape_string($con, $_POST["tipo"]); 
		$preco = mysqli_real_escape_string($con, $_POST["preco"]);
		$tempo = mysqli_real_escape_string($con, $_POST["tempo"]);
		
		$sql = "INSERT INTO servicos VALUES ('$id', '$tipo', '$preco', '$tempo')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql = "SELECT * FROM servicos ORDER BY id_Servico DESC LIMIT 1";
			$result = $con->query($sql);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Serviço: ".$row["id_Servico"].". Tipo Serviço: " .$row["tipoServico"]. "') </script>";
			    }
			} 
			else 
			{
			    echo "<script> alert('0 results') </script>";
			}
		}
		else
		{
			echo "ERROR: " .$sql. "<br>" . $con->error;
		}
		
	}
		
	$con->close();
?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

		<table>
			<form action="adicionarServico.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar novo Serviço </h2> </td> </tr>
				 
		    	<tr> <td> <p class="label"> Tipo Serviço: </p> </td> 	<td> <p> <input type="text" name="tipo" class="input"> </p> </td></tr>
		        <tr> <td> <p class="label"> Preço: </p> </td> 			<td> <p> <input type="text" name="preco" class="input"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Tempo Estimado: </p> </td> 	<td> <p> <input type="text" name="tempo" class="input"> </p>  </td> </tr>
				
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="Adicionar"> </td>
			</form>
		</table>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>