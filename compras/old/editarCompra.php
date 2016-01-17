<?php 
	session_start(); //Starts the session

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	if(isset($_POST['editar']))
	{
		$idCompra = $_POST['idCompra'];
		$idCliente = $_POST['idCliente'];
		$idP = $_POST['idP'];
		$data = $_POST['data'];
		$quantidade = $_POST['quantidade'];
		$preco = $_POST['preco'];

		$sql = mysqli_query($con, "UPDATE compra 
									SET id_Produto='$idP', id_Cliente='$idCliente', dataCompra='$data', quantidade='$quantidade', precoTotal='$preco' 
									WHERE id_Compra='$idCompra'");

		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idP, $idCliente, $data, $quantidade, $preco);

			
			echo "<script> alert('Compra alterada com sucesso!')</script>";
			
			$stmt->close();
		}
	}
	
	mysqli_close($con);
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
	<form action="editarCompra.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Compra </h2> </td> </tr>
	 	<tr> <td> <p class="label"> ID da Compra: </p> </td> 		<td> <p> <input type="text" name="idCompra" value="<?php $idCompra=$_GET['idCompra']; echo $idCompra; ?>" class="selected"> </p> </td> </tr>
	 	<tr> <td> <p class="label"> ID Produto: </p> </td> 		<td> <p> <input type="text" name="idP" value="<?php $idP=$_GET['idP']; echo $idP; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Descrição Produto: </p> </td> <td> <p> <input type="text" name="descricao" value="<?php $descricao=$_GET['descricao']; echo $descricao; ?>" class="selected" maxlength="4"> </p> </td> </tr>
       	<tr> <td> <p class="label"> ID Cliente: </p> </td> 		<td> <p> <input type="text" name="idCliente" value="<?php $idCliente=$_GET['idCliente']; echo $idCliente; ?>" class="selected" maxlength="4"> </p> </td> </tr>
	 	<tr> <td> <p class="label"> Nome Cliente: </p> </td> 	<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Data Compra: </p> </td> 	<td> <p> <input type="text" name="data" value="<?php $data=$_GET['data']; echo $data; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Quantidade: </p> </td> 		<td> <p> <input type="text" name="quantidade" value="<?php $quantidade=$_GET['quantidade']; echo $quantidade; ?>" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> Preço: </p> </td> 			<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="selected"> </p> </td> </tr>
    	
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
</body>
</html>