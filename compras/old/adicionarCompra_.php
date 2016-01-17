<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	if(isset($_POST["adicionarC"]))
	{
		$idC = mysql_insert_id();
		$nomeC = mysqli_real_escape_string($con, $_POST["nomeC"]); 
		$morada = mysqli_real_escape_string($con, $_POST["morada"]);
		$telefone = mysqli_real_escape_string($con, $_POST["telefone"]);
		$email = mysqli_real_escape_string($con, $_POST["email"]);
		$nif = mysqli_real_escape_string($con, $_POST["nif"]);
		
		$sql = "INSERT INTO clientes VALUES ('$idC', '$nomeC', '$morada', '$telefone', '$email', '$nif')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql2 = "SELECT * FROM clientes ORDER BY id_Cliente DESC LIMIT 1";
			$result = $con->query($sql2);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Cliente: ".$row["id_Cliente"].". Nome Cliente: " .$row["nomeCliente"]. "') </script>";
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
	else if(isset($_POST["okC"]))
	{
		$idC = mysqli_real_escape_string($con, $_POST["idC"]); 
	}

	if(isset($_POST["adicionarP"]))
	{
		$idP = mysql_insert_id();
		$nomeP = mysqli_real_escape_string($con, $_POST["nomeP"]); 
		$numSerie = mysqli_real_escape_string($con, $_POST["numSerie"]);
		$stock = mysqli_real_escape_string($con, $_POST["stock"]);
		$precoP = mysqli_real_escape_string($con, $_POST["precoP"]);
		$idSub = mysqli_real_escape_string($con, $_POST["idSub"]);
		$idM = mysqli_real_escape_string($con, $_POST["idM"]);
		
		/*$sql = "INSERT INTO produtos VALUES ($idP, '$nomeP', '$numSerie', '$stock', '$precoP', '$idSub', '$idM')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql2 = "SELECT * FROM produtos ORDER BY id_Produto DESC LIMIT 1";
			$result = $con->query($sql2);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Produto: ".$row["id_Produto"].". Descrição Produto: " .$row["nomeProduto"]. "') </script>";
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
		}*/

	}
	else if(isset($_POST["okP"]))
	{
		$idP = mysqli_real_escape_string($con, $_POST["idP"]);
	}

	if(isset($_POST["finalizar"]))
	{
		$idCompra = mysql_insert_id();
		$idP = mysqli_real_escape_string($con, $_POST["idP"]); 
		$idC = mysqli_real_escape_string($con, $_POST["idC"]);
		$data = mysqli_real_escape_string($con, $_POST["data"]);
		$total = mysqli_real_escape_string($con, $_POST["total"]);
		$quantidade = mysqli_real_escape_string($con, $_POST["quantidade"]);
		
		$sql = "INSERT INTO compra VALUES ('$idCompra', '$idP', '$idC', '$data', '$quantidade', '$total')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql2 = "SELECT * FROM compra ORDER BY id_compra DESC LIMIT 1";
			$result = $con->query($sql2);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Compra: ".$row["id_Compra"].") </script>";
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
	<form action="adicionarCompra.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="4"> <h2> Fazer uma nova compra </h2> </td></tr>
		 
		<tr> 
			<td> <p class="label">ID Cliente: * </p> </td> 
			<td>
<?php
	$sql = "SELECT id_Cliente, nome, morada, telefone, email, nif FROM clientes";

	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idC, $nomeC, $morada, $telefone, $email, $nif);
		
		//echo "<p class='label'> <select name='nomeCliente' value='$_SESSION['valor']'>";
		echo "<p class='label'> <select name='idC' class='selected'>";

		while ($smtp->fetch())
		{	
			if($idC != null)
			{
				//echo "<option value='$idC'> $nomeC ($idC) </option>\n";
				echo "<option value='$idC'> $nomeC ($idC) </option>\n";
			}
			else
			{
				echo "<option value='$idC' selected> $nomeC ($idC) </option>\n";				
			}
		}
		echo "</select>";

	}
?>
			</td>
			<td> <input type="image" src="../imagens/load.png" name="cliente" value="carrega"> </td>

<?php
if(isset($_POST["cliente"]))
{
	printf ("%s", $idC);
	$_SESSION['valor'] = $_GET['nomeCliente']; 
	//$idC = $_POST["idC"];
	echo $idC;

}
			?>

		</tr>
	   		
	   		<!--<tr> <td> </td> <td> <p class="label"> Nome: </p> </td>		<td colspan="2"> <p> <input type="text" name="nomeC" value="<?php $nomeC=$_GET['nomeC']; echo $nomeC; ?>" class="input"> </p>   </td> </tr>
		    <tr> <td> </td> <td> <p class="label"> Morada: </p> </td>	<td colspan="2"> <p> <input type="text" name="morada" value="<?php $morada=$_GET['morada']; echo $morada; ?>" class="input"> </p> </td>   </tr>
		    <tr> <td> </td> <td> <p class="label"> Telefone: </p> </td>	<td colspan="2"> <p> <input type="text" name="telefone" value="<?php $telefone=$_GET['telefone']; echo $telefone; ?>" class="input"> </p> </td> </tr>
		    <tr> <td> </td> <td> <p class="label"> E-mail: </p> </td>	<td colspan="2"> <p> <input type="text" name="email" value="<?php $email=$_GET['email']; echo $email; ?>" class="input"> </p> </td></tr>
		    <tr> <td> </td> <td> <p class="label"> NIF: </p> </td>		<td colspan="2"> <p> <input type="text" name="nif" value="<?php $nif=$_GET['nif']; echo $nif; ?>" class="input"> </p> </td> </tr>
 			<tr>
 				<td> </td>
 				<td> <input type="button" name="okC" value="OK" class="button"></td>
 				<td  colspan="2"> <input type="button" name="adicionarC" value="Adicionar Cliente" class="button"> </td>
 			</tr>-->

			<tr> 
				<td> <p class="label"> ID Produto: </td>
				<!--<td colspan="2">-->
				<td>
<?php
	$sql = "SELECT id_Produto, nomeProduto, num_Serie, cod_barras, stock, preco, id_Subcategoria, id_Marca FROM produtos";

	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idP, $nomeP, $numSerie, $cod, $stock, $precoP, $idSub, $idM);

		echo "<p class='label'> <select name='idP' class='selected'>";
		while ($smtp->fetch())
		{			
			if($idP != null)
			{
				echo "<option value='$idP'> $nomeP ($idP)</option>\n";
			}
			else
			{
				echo "<option value='$idP' selected> $nomeP ($idP)</option>\n";				
			}
		}
		echo "</select> </p> ";
	}
?>
				</td>
				<td> <input type="image" src="../imagens/load.png" name="cliente" value="carrega"> </td>
			</tr>

			<!--<tr> <td> </td> <td> <p class="label"> Descrição: </p> </td>		<td colspan="2"> <p> <input type="text" name="nomeP" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Categoria: </p> </td>		<td colspan="2"> <p> <input type="text" name="categoria" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Subcategoria: </p> </td>		<td colspan="2"> <p> <input type="text" name="subcategoria" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Marca: </p> </td>			<td colspan="2"> <p> <input type="text" name="marca" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Stock: </p> </td>			<td colspan="2"> <p> <input type="text" name="stock" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Numero Serie: </p> </td>		<td colspan="2"> <p> <input type="text" name="numSerie" class="input"> </p> </td> </tr>
			<tr> <td> </td> <td> <p class="label"> Preço: </p> </td>			<td colspan="2"> <p> <input type="text" name="preco" class="input"> </p> </td> </tr>
			 <tr>
			 	<td> </td>
 				<td> <input type="button" name="okP" value="OK" class="button"> </td>
 				<td colspan="2"> <input type="button" name="adicionarP" value="Adicionar Carrinho" class="button"> </td>
 			</tr>
 			-->

			<tr> <td> <p class="label"> Data da Compra: </p> </td> 	<td colspan="2"> <p> <input type="date" name="data" class="selected"> </p>  </td> </tr>
		    <tr> <td> <p class="label"> Quantidade: </p> </td> 		<td colspan="2"> <p> <input type="text" name="quantidade" class="selected"> </p> </td> </tr>
		    <!--<tr> <td> <p class="label"> Preço Total: * </p> </td> 		<td colspan="2"> <p> <input type="text" value="<?php $preco=$_POST['preco']; echo $preco; ?>" name="totalPreco" class="selected"> </p> </td> </tr>-->
		    <tr> <td> <p class="label"> Preço Total: </p> </td> 		<td colspan="2"> <p> <input type="text" name="total" class="selected"> </p> </td> </tr>

			<tr bgcolor="#c1c1ff"> <td colspan="4"> <input type="submit" name="finalizar" class="button" value="Finalizar Compra" /></td></tr>
		</form>
		</table>
	</div>
	
	<!-- ****************** FOOTER *************** -->
	<?php 
		include("footer.php"); 
		mysqli_close($con);
	?>

</body>
</html>
