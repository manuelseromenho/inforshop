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
	var_dump($_POST);
	$select = "SELECT * FROM produtos";

 	if(isset($_POST['adicionarP']))
	{
		$idP = mysql_insert_id();
		$nome = mysqli_real_escape_string($con, $_POST["nome"]); 
		$numSerie = mysqli_real_escape_string($con, $_POST["numSerie"]);
		$cod = mysqli_real_escape_string($con, $_POST["cod"]);
		$stock = mysqli_real_escape_string($con, $_POST["stock"]);
		$preco = mysqli_real_escape_string($con, $_POST["preco"]);
		$idSub = mysqli_real_escape_string($con, $_POST["idSub"]);
		$idM = mysqli_real_escape_string($con, $_POST["idM"]);
		
		$sql = "INSERT INTO produtos VALUES ('$idP', '$nome', '$numSerie', '$cod', $stock', '$preco', '$idSub', '$idM')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql = "SELECT * FROM produtos ORDER BY id_Produto DESC LIMIT 1";
			$result = $con->query($sql);

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
		}
		
	}

?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
		<table class="procura">
			<form action="adicionarProduto.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar novo Produto </h2> </td> </tr>
				 
		    	<tr> <td> <p class="label"> Descrição Produto: </p> </td> 	<td> <p> <input type="text" name="nome" class="selected"> </p> </td></tr>
		        <tr> <td> <p class="label"> Número de Série: </p> </td> 	<td> <p> <input type="text" name="numSerie" class="selected"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Código Barras: </p> </td> 		<td> <p> <input type="text" name="cod" class="selected"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Stock: </p> </td> 				<td> <p> <input type="text" name="stock" class="selected"> </p>  </td> </tr>
				<tr> <td> <p class="label"> Preço: </p> </td> 				<td> <p> <input type="text" name="preco" class="selected"> </p>  </td> </tr>
		    	<tr> 
		    		<td> <p class="label"> Subcategoria: </p> </td> 		<!--<td> <p> <input type="text" name="idSub" class="input" maxlength="9"> </p>  </td> </tr>-->
		    		<td>
<?php
	//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
	$sql = "SELECT s.id_Subcategoria, s.subcategoria, s.id_Categoria, c.categoria FROM subcategorias as s, categorias as c WHERE s.id_Categoria = c.id_Categoria";
	
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idSub, $subcategoria, $idCat, $cat);

		echo "<p class='label'> <select name='idSub' class='selected'>";
		echo "<option value='$idSub' selected> Seleccione uma subcategoria </option>\n";
		while ($smtp->fetch())
		{	
			echo "<option value='$idSub' > $subcategoria ($cat) </option>\n";
		}
		echo "</select>";
	}
?>
					</td>
				</tr>
				<tr> 
		    		<td> <p class="label"> Marca: </p> </td> 		<!--<td> <p> <input type="text" name="idSub" class="input" maxlength="9"> </p>  </td> </tr>-->
		    		<td>
<?php
	//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
	$sql = "SELECT id_Marca, marca FROM marcas";
	
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idM, $marca);

		echo "<p class='label'> <select name='idM' class='selected'>";
		echo "<option value='$idM' selected> Seleccione uma marca </option>\n";
		while ($smtp->fetch())
		{	
				//echo "<option value='$idM' selected> $marca ($idM) </option>\n";
				echo "<option value='$idM'>  $marca ($idM) </option>\n";
			
		}
		echo "</select>";
	}
?>
					</td>
				</tr>
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionarP" class="button" value="Adicionar"> </td>
			</form>
		</table>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
