<?php 
	require("../ligacaoBD.php");
	
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	if(isset($_POST["adicionarM"]))
	{
		$idM = mysql_insert_id();
		$marca = mysqli_real_escape_string($con, $_POST["marca"]); 
		
		$checkn = "SELECT * FROM marcas WHERE marca='$marca'";
		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)
		{
			$sql = "INSERT INTO marcas VALUES ('$idM', '$marca')";
			
			if (mysqli_multi_query($con, $sql))
			{
				//echo "<script> alert('Cliente inserido com sucesso!') ";

				$sql = "SELECT * FROM marcas ORDER BY id_Marca DESC LIMIT 1";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
			    	// output data of each row
				    while($row = $result->fetch_assoc()) 
				    {
				        echo "<script> alert('ID Marca: ".$row["id_Marca"].". Marca: " .$row["marca"]. "') </script>";
				    }
				} 
				else 
				{
				    echo "<script> alert('Impossivel inserir esta marca. TENTE DE NOVO.'); </script>";
				}
			}
			else
			{
				echo "<script> alert('ERROR: ' .$sql. '<br>' . $con->error.') </script>";
			}
		}
	}

	

	if(isset($_POST["adicionarCat"]))
	{
		$idC = mysql_insert_id();
		$cat = mysqli_real_escape_string($con, $_POST["categoria"]); 
		
		$checkn = "SELECT * FROM categorias WHERE categoria = '$cat'";

		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)
		{
			$sql = "INSERT INTO categorias VALUES ('$idC', '$cat')";
			
			if (mysqli_multi_query($con, $sql))
			{
				//echo "<script> alert('Cliente inserido com sucesso!') ";

				$sql = "SELECT * FROM categorias ORDER BY id_Categoria DESC LIMIT 1";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
			    	// output data of each row
				    while($row = $result->fetch_assoc()) 
				    {
				        echo "<script> alert('ID Categoria: ".$row["id_Categoria"].". Categoria: " .$row["categoria"]. "') </script>";
				    }
				} 
				else 
				{
				    echo "<script> alert('Impossivel inserir esta categoria. TENTE DE NOVO.'); </script>";
				}
			}
			else
			{
				echo "<script> alert('ERROR: ' .$sql. '<br>' . $con->error.') </script>";
			}
		}
	}

	

	if(isset($_POST["adicionarSub"]))
	{	
		$idSub = mysql_insert_id();
		$sub = mysqli_real_escape_string($con, $_POST["subcategoria"]); 
		$idCat = mysqli_real_escape_string($con, $_POST["idCat"]);
		
		$checkn = "SELECT * FROM subcategorias WHERE subcategoria = '$sub'";

		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)
		{
			$sql = "INSERT INTO subcategorias VALUES ('$idSub', '$sub', '$idCat')";
			
			if (mysqli_multi_query($con, $sql))
			{
				//echo "<script> alert('Cliente inserido com sucesso!') ";

				$sql = "SELECT * FROM subcategoria ORDER BY id_Subcategoria DESC LIMIT 1";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
			    	// output data of each row
				    while($row = $result->fetch_assoc()) 
				    {
				        echo "<script> alert('ID Subcategoria: ".$row["id_Subcategoria"].". Subcategoria: " .$row["subcategoria"]. "') </script>";
				    }
				} 
				else 
				{
				    echo "<script> alert('Impossivel inserir esta subcategoria. TENTE DE NOVO.'); </script>";
				}
			}
			else
			{
				echo "<script> alert('ERROR: ' .$sql. '<br>' . $con->error.') </script>";
			}
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
	<form action="adicionarElemento.php" method="POST">
		<table class="produtos">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Marca </h2> </td> </tr>
			<!--<tr> <td> <p class="label"> ID Marca </p> </td> <td> <input type="text" name="idMarca" class="input"> </td> </tr>-->
			<tr> <td> <p class="label"> Marca </p> </td> 	<td> <input type="text" name="marca" class="input"> </td> </tr>
			<tr bgcolor="#c1c1ff"> 
				<td> <input type="submit" name="adicionarM" class="button" value="Adicionar Marca"> </td>
				<td> <input type="submit" name="procurarM" class="button" value="Procurar Marca"> </td>
			</tr>
		</table>
<?php
	if(isset($_POST["procurarM"]))
	{
		$marca = $_POST["marca"];
	
		if (array_key_exists('pesquisar', $_POST))
		{
			$s = $_POST["marca"];		
		}
		else
		{
			$s = "";			
		} 

		$sql = "SELECT id_Marca, marca FROM marcas WHERE marca LIKE '%$marca%'";
	 
		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idM, $marca);

			echo "<br><br><br>";

			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Marca </h2> </td> <td> <h2> Marca </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";

			while ($stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td> <p class='label'>$idM </p> </td>";
				echo "<td> <p class='label'>";
				printf ("%s", $marca);
				echo "</p> </td> ";
				echo "<td class='img'> <a href='editarMarca.php?idM=$idM&marca=$marca'> <img src='../imagens/edit.png' title='Editar Marca'> </a> </td> ";
				echo "<td class='img'> <a href='eliminarMarca.php?idM=$idM'> <img src='../imagens/trash.png' title='Eliminar Marca'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br><br><br>";
			$stmt->close();
		}
	}
?>

		<br><br><br>
		<table class="produtos">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Categoria </h2> </td> </tr>
			<!--<tr> <td> <p class="label"> ID Categoria </p> </td> <td> <input type="text" name="idCategoria" class="input"> </td> </tr>-->
			<tr> <td> <p class="label"> Categoria </p> </td> 	<td> <input type="text" name="categoria" class="input"> </td> </tr>
			<tr bgcolor="#c1c1ff"> 
				<td> <input type="submit" name="adicionarCat" class="button" value="Adicionar Categoria"> </td> 
				<td> <input type="submit" name="procurarCat" class="button" value="Procurar Categoria"> </td>
			</tr>
		</table>

<?php
	if(isset($_POST["procurarCat"]))
	{
		$cat = $_POST["categoria"];
	
		if (array_key_exists('pesquisar', $_POST))
		{
			$s = $_POST["categoria"];		
		}
		else
		{
			$s = "";			
		} 

		$sql = "SELECT id_Categoria, categoria FROM categorias WHERE categoria LIKE '%$cat%'";
	 
		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idC, $cat);

			echo "<br><br><br>";

			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Categoria </h2> </td> <td> <h2> Categoria </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";

			while ($stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td> <p class='label'>$idC </p> </td>";
				echo "<td> <p class='label'>";
				printf ("%s", $cat);
				echo "</p> </td> ";
				echo "<td class='img'> <a href='editarCategoria.php?idC=$idC&cat=$cat'> <img src='../imagens/edit.png' title='Editar Categoria'> </a> </td> ";
				echo "<td class='img'> <a href='eliminarCategoria.php?idC=$idC'> <img src='../imagens/trash.png' title='Eliminar Categoria'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br><br><br>";
			$stmt->close();
		}
	}
?>
		<br><br><br>
		<table class="produtos">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Subcategoria </h2> </td> </tr>
			<!--<tr> <td> <p class="label"> ID Subcategoria </p> </td> <td> <input type="text" name="idSubcategoria" class="input"> </td> </tr>-->
			<tr> <td> <p class="label"> Subcategoria </p> </td> <td> <input type="text" name="subcategoria" class="input"</tr>
			<tr>
				<td> <p class="label"> Categoria </p> </td>
				<td> 
<?php
	//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
	$sql = "SELECT id_Categoria, categoria FROM categorias";
	
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idC, $categoria);

		echo "<p class='label'> <select name='categorias' class='selected'>";
		while ($smtp->fetch())
		{	
			if($idS != null)
			{
				echo "<option value='$idC' selected> $categoria ($idC) </option>\n";
			}
			else
			{
				echo "<option value='$idC' > $categoria ($idC) </option>\n";				
			}
		}
		echo "</select>";
	}
?>
		</td>
		</tr>
		<tr bgcolor="#c1c1ff"> 
				<td> <input type="submit" name="adicionarSub" class="button" value="Adicionar Subcategoria"> </td> 
				<td> <input type="submit" name="procurarSub" class="button" value="Procurar Subcategoria"> </td>
			</tr>
		</table>

<?php
	if(isset($_POST["procurarSub"]))
	{
		$sub = $_POST["subcategoria"];
	
		if (array_key_exists('pesquisar', $_POST))
		{
			$s = $_POST["subcategoria"];		
		}
		else
		{
			$s = "";			
		} 

		$sql = "SELECT s.id_Subcategoria, s.subcategoria, s.id_Categoria, c.categoria FROM subcategorias as s, categorias as c WHERE s.subcategoria LIKE '%$sub%' AND s.id_Categoria=c.id_Categoria";
	 
		if ($stmt = $con->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idSub, $sub, $idC, $cat);

			echo "<br><br><br>";

			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Subcategoria </h2> </td> <td> <h2> Subcategoria </h2> </td> <td> <h2> Categoria </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";

			while ($stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td> <p class='label'> $idSub </p> </td> ";
				echo "<td> <p class='label'>";
				printf ("%s", $sub);
				echo "</p> </td> ";				
				echo "<td> <p class='label'> $cat </p> </td> ";
				echo "<td class='img'> <a href='editarSubcategoria.php?idSub=$idSub&sub=$sub&idC=idC&cat=$cat'> <img src='../imagens/edit.png' title='Editar Subcategoria'> </a> </td> ";
				echo "<td class='img'> <a href='eliminarSubcategoria.php?idSub=$idSub'> <img src='../imagens/trash.png' title='Eliminar Subcategoria'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br><br><br>";
			$stmt->close();
		}
	}
?>
	</form>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); $con->close(); ?>

</body>
</html>
