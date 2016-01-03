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
		$idC = $_POST['idCategoria'];
		$cat = $_POST['categoria'];

		$sql = mysqli_query($mysqli, "UPDATE categorias SET id_Categoria='$idC', categoria='$cat' WHERE id_Categoria='$idC'");

		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idC, $cat);

			while ($stmt->fetch()) 
			{
				
			}
			echo "<h2>Categoria alterada com sucesso!</h2>";
			$stmt->close();
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
	<table class="table">
	<form action="editarCategoria.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Categoria </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Categoria: </p> </td> 	<td> <p> <input type="text" name="idCategoria" value="<?php $idC=$_GET['idC']; echo $idC; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Categoria: </p> </td> 		<td> <p> <input type="text" name="categoria" value="<?php $cat=$_GET['categoria']; echo $cat; ?>" class="input"> </p> </td> </tr>
      
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
