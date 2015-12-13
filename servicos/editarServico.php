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
		$idS = $_POST['id'];
		$tipo = $_POST['tipo'];
		$preco = $_POST['preco'];
		$tempo = $_POST['tempo'];

		$sql = mysqli_query($con, "UPDATE servicos SET id_Servico='$idS', tipoServico='$tipo', preco='$preco', tempoEstimado='$tempo' WHERE id_Servico='$idS'");

		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idS, $tipo, $preco, $tempo);

			while ($stmt->fetch()) 
			{
				echo "<script> alert('Serviço alterado com sucesso!\n'); </script>";
			}
		
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
	<table>
	<form action="editarServico.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Serviço </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Serviço: </p> </td> 		<td> <p> <input type="text" name="id" value="<?php $idS=$_GET['idS']; echo $idS; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Serviço: </p> </td> 	<td> <p> <input type="text" name="tipo" value="<?php $tipo=$_GET['tipo']; echo $tipo; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Preço Serviço: </p> </td>	<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Tempo Estimado: </p> </td> 	<td> <p> <input type="text" name="tempo" value="<?php $tempo=$_GET['tempo']; echo $tempo; ?>" class="input"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
