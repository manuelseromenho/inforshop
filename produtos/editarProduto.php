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
		$idP = $_POST['idP'];
		$nome = $_POST['nome'];
		$numSerie = $_POST['numSerie'];
		$cod = $_POST['cod'];
		$stock = $_POST['stock'];
		$preco = $_POST['preco'];
		$idS = $_POST['idS'];
		$idM = $_POST['idM'];

		$sql = mysqli_query($con, "UPDATE produtos SET id_Produto='$idP', nomeProduto='$nome', num_Serie='$numSerie', cod_barras='$cod', stock='$stock', precoProduto='$preco', id_Subcategoria='$idS', id_Marca='$idM' WHERE id_Produto='$idP'");

		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idP, $nome, $numSerie, $cod, $stock, $preco, $idS, $idM);

			
			echo "<script> alert('Produto alterado com sucesso!\n'); </script>";
		
		
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
	<table class="table">
	<form action="editarProduto.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Produto </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Produto: </p> </td> 	<td> <p> <input type="text" name="idP" value="<?php $idP=$_GET['idP']; echo $idP; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Número Série: </p> </td> <td> <p> <input type="text" name="numSerie" value="<?php $numSerie=$_GET['numSerie']; echo $numSerie; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Código Barras: </p> </td> <td> <p> <input type="text" name="cod" value="<?php $cod=$_GET['cod']; echo $cod; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Stock: </p> </td> 		<td> <p> <input type="text" name="stock" value="<?php $stock=$_GET['stock']; echo $stock; ?>" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> Preço: </p> </td> 		<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> ID Subcategoria: </p> </td> <td> <p> <input type="text" name="idSub" value="<?php $idSub=$_GET['idSub']; echo $idSub; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Subcategoria </p> </td> <td> <p> <input type="text" name="sub" value="<?php $sub=$_GET['sub']; echo $sub; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> ID Marca: </p> </td> 	<td> <p> <input type="text" name="idM" value="<?php $idM=$_GET['idM']; echo $idM; ?>" class="selected"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
