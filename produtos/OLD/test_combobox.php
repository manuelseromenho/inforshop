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

	<script language="javascript" type="text/javascript">
	    function categoria_func(catid)
	    {
	        document.frm.submit();
	    }
	</script>

</head>
<body>
	
<?php

	//$select = "SELECT * FROM produtos";

 	if(isset($_POST['adicionarP']))
	{
		$idP = mysql_insert_id();
		$id_categoria = mysqli_real_escape_string($mysqli, $_POST["id_cat"]);
		$id_subcategoria = mysqli_real_escape_string($mysqli, $_POST["id_subcategoria"]);

		//id_produto ; nome_produto ; num_serie ; cod_barras ; peso ; quantidade
		//preco_venda; id_subcategoria ; id_marca
		$sql = "INSERT INTO produtos VALUES ('$idP', 'teste', 'teste', 'teste', 
			'teste', 'teste', 'teste_preco', '$id_subcategoria', 'teste_marca')";
		
		if (mysqli_multi_query($mysqli, $sql))
		{
			$sql = "SELECT * FROM produtos ORDER BY id_produto DESC LIMIT 1";
			$result = $mysqli->query($sql);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Produto: ".$row["id_produto"].".
			         Descrição Produto: " .$row["nome_produto"]. "') </script>";
			    }
			} 
			else 
			{
			    echo "<script> alert('0 results') </script>";
			}
		}
		else
		{
			echo "ERROR: " .$sql. "<br>" . $mysqli->error;
		}
		
	}

?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
		<table class="procura">
			<form action="" method="POST" name="frm" id="frm">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar novo Produto </h2> </td> </tr>
				 
		    		<td> <p class="label"> Categoria: </p> </td> 	
		    		<td>
				
				<?php
					//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
					$sql_categoria = "SELECT nome_categoria FROM categorias;"
					
					if ($smtp = $mysqli->prepare($sql_categoria))
					{
						$smtp->execute();						
						$smtp->bind_result($id_categoria, $nome_categoria);

						echo "<p class='label'> <select name='id_cat' id='id_cat' class='selected' onChange='categoria_func(this.value);'>";
						echo "<option value='$id_categoria' selected> Seleccione uma Categoria </option>\n";
						while ($smtp->fetch())
						{
				?>	
						<option value="<?php $id_categoria ?>"

							<?php
								if($id_categoria==$_REQUEST["id_cat"])
									{
										echo "Selected";
									}
							?>


							> <?php $nome_categoria ?> 
						</option>;

				<?php	
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
