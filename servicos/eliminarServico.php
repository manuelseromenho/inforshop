<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");
?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

<?php
	$idS = $_GET["idS"];
	
	$sql = "DELETE FROM servicos WHERE id_Servico = '$idS'";
	if ($stmt = $con->prepare($sql)) 
	{
		$stmt->execute();
		echo ("<h2> Serviço eliminado com sucesso! </h2>");
		$stmt->close(); // close statement
		
	}
	else
	{ 
		echo mysqli_error ($con);
	}

	$con->close(); //close connection
?>

		</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>
