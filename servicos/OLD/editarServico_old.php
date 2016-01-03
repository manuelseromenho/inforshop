<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$con=$mysqli;

	if(isset($_POST['editar']))
	{
		$idS = $_POST['id'];
		$tipo = $_POST['tipo_servico'];
		$preco = $_POST['preco'];
		$tempo = $_POST['tempo_estimado'];

		$sql = mysqli_query($con, "UPDATE servicos SET id_servico='$idS', tipo_servico='$tipo', preco='$preco', tempo_estimado='$tempo' WHERE id_servico='$idS'");

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
	 	
	 	<tr> <td> <p class="label"> ID Serviço: </p> </td> 		<td> <p> <input type="text" name="id" value="<?php $idS=$_GET['id']; echo $idS; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Serviço: </p> </td> 	<td> <p> <input type="text" name="tipo_servico" value="<?php $tipo=$_GET['tipo_servico']; echo $tipo; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Preço Serviço: </p> </td>	<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Tempo Estimado: </p> </td> 	<td> <p> <input type="text" name="tempo_estimado" value="<?php $tempo=$_GET['tempo_estimado']; echo $tempo; ?>" class="input"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
