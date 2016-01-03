<?php 
	require("../ligacaoBD.php");
	
	session_start(); //Starts the session

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
	<script>

	function showCat(str) 
	{
	    if (str == "") 
	    {
	        document.getElementById("txtHint").innerHTML = "";
	        return;
	    } 
	    else 
	    { 
	        if (window.XMLHttpRequest) 
	        {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } 
	        else 
	        {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() 
	        {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	            {
	                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	            }
	        };
	        xmlhttp.open("GET","getcat.php?idC="+str,true);
	        xmlhttp.send();
	    }
	}

	

	</script>
</head>
<body>
	
<?php
	
	$select = "SELECT * FROM produtos";

 	if(isset($_POST['adicionarP']))
	{
		//var_dump($_POST);
		$idP = mysql_insert_id();
		$descricao = mysqli_real_escape_string($con, $_POST["descricao"]); 
		$numSerie = mysqli_real_escape_string($con, $_POST["numSerie"]);
		$cod = mysqli_real_escape_string($con, $_POST["cod"]);
		$stock = mysqli_real_escape_string($con, $_POST["stock"]);
		$preco = mysqli_real_escape_string($con, $_POST["preco"]);
		$idS = mysqli_real_escape_string($con, $_POST["idS"]);
		$idM = mysqli_real_escape_string($con, $_POST["idM"]);
		
		$sql = "INSERT INTO produtos 
				VALUES ('$idP', '$descricao', '$numSerie', '$cod', '$stock', '$preco', '$idS', '$idM')";
		
		if (mysqli_multi_query($con, $sql))
		{
			$sql = "SELECT * FROM produtos 
					ORDER BY id_Produto DESC LIMIT 1";

			$result = $con->query($sql);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Produto: ".$row["id_Produto"].". Descrição Produto: " .$row["descricao"]. "') </script>";
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
		 
    	<tr> <td> <p class="label"> Descrição Produto: </p> </td> 	<td> <p> <input type="text" name="descricao" class="selected"> </p> </td></tr>
        <tr> <td> <p class="label"> Número de Série: </p> </td> 	<td> <p> <input type="text" name="numSerie" class="selected"> </p> </td> </tr>
        <tr> <td> <p class="label"> Código Barras: </p> </td> 		<td> <p> <input type="text" name="cod" class="selected"> </p> </td> </tr>
        <tr> <td> <p class="label"> Stock: </p> </td> 				<td> <p> <input type="text" name="stock" class="selected"> </p>  </td> </tr>
		<tr> <td> <p class="label"> Preço: </p> </td> 				<td> <p> <input type="text" name="preco" class="selected"> </p>  </td> </tr>
    	<tr> 
    		<td> <p class="label"> Categoria: (NÃO ESTÁ A FUNCIONAR)</p> </td> 		<!--<td> <p> <input type="text" name="idSub" class="input" maxlength="9"> </p>  </td> </tr>-->
    		<td>
<?php
	//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
	$sql = "SELECT id_Categoria, categoria 
			FROM categorias 
			ORDER BY id_Categoria ASC";
	
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idC, $cat);

		echo "<p class='label'> <select name='idC' class='selected' onchange='showCat(this.value)'>";
		echo "<option value='$idC' selected> Seleccione uma categoria </option>\n";
		while ($smtp->fetch())
		{	
			echo "<option value='$idC' > $cat ($idC) </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<tr> <td colspan="2"> <div id="txtHint"> </div> </td> </tr>
		<tr cellpadding="5" cellspacing="5"> </tr>
		<tr> 
    		<td> <p class="label"> Subcategoria: </p> </td>
    		<td>
<?php

	$sql = "SELECT s.id_Subcategoria, s.subcategoria, c.categoria
			FROM subcategorias as s, categorias as c
			WHERE s.id_categoria = c.id_Categoria
			ORDER BY s.id_Categoria ASC;";
	
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idS, $sub, $cat);

		echo "<p class='label'> <select name='idS' class='selected'>";
		echo "<option value='$idS' selected> Seleccione categoria </option>\n";
		while ($smtp->fetch())
		{	
			echo "<option value='$idS'>  $cat -> $sub </option>\n";
			
		}
		echo "</select>";
	}
?>
			</td>
		</tr>

		<tr> 
    		<td> <p class="label"> Marca: </p> </td>
    		<td>
	<?php

		$sql = "SELECT id_Marca, marca 
				FROM marcas";
		
		if ($smtp = $con->prepare($sql))
		{
			$smtp->execute();						
			$smtp->bind_result($idM, $marca);

			echo "<p class='label'> <select name='idM' class='selected'>";
			echo "<option value='$idM' selected> Seleccione uma marca </option>\n";
			while ($smtp->fetch())
			{	
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
