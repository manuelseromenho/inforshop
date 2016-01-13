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
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
		<p>OLA MUNDO!!!! ELIMINAR COMPRAS </p>
<?php
	$id_C = $_GET["id_C"];
	
	$sql = "DELETE FROM compra WHERE id_Compra='$id_C'";
	if ($stmt = $con->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->close(); // close statement
		echo ("<h2>Compra eliminado com sucesso!</h2>");
	}
	else
	{ 
		echo mysqli_error ($con);
	}

	$con->close(); //close connection
?>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
</body>
</html>