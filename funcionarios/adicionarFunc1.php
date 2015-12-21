<?php 
	require("../ligacaoBD.php");
	
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
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

<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
<!-- ***************** BODY *****************-->
<div class="container">

		<table>
			<form action="adicionarFunc1.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar Novo Funcionário </h2> </td> </tr>
				 


				<tr> <td> <p class="label"> Nome: </p> </td> 					<td> <p> <input type="text" name="nome" class="input"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Morada: </p> </td> 					<td> <p> <input type="text" name="morada" class="input"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Telefone: </p> </td> 				<td> <p> <input type="text" name="telefone" class="input" maxlength="9"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> NIF: </p> </td>						<td> <p> <input type="text" name="nif" class="input" maxlength="9"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> E-mail: </p> </td> 					<td> <p> <input type="text" name="email" class="input"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> Data Nascimento: </p> </td>			<td> <p> <input type="date" name="dataN" class="input"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> Data Entrada ao Serviço: </p> </td>	<td> <p> <input type="date" name="dataE" class="input"> </p> </td> </tr>
			

				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="adicionar"> </td>
			</form>
		</table>
	</div>
	
	

<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
	
<?php

	//mysqli_set_charset($mysqli, "utf8"); 
		
		//var_dump($_POST);
		
	if(isset($_POST['adicionar']))
	{
		if (array_key_exists('adicionar',$_POST))
		{
			$sql="INSERT INTO funcionarios SET 			
						nome = ?, 
						morada = ?,
						telefone = ?, 
						nif = ?, 
						email = ?, 
						data_nascimento = ?, 
						data_entrada = ?";

			if($_POST['nome'] == '')
				$nome = "NULL";
			else
				$nome = $_POST['nome'];

			if ($stmt = $mysqli->prepare($sql))
			{
				$stmt->bind_param('sssssss'
				, $nome
				, $_POST['morada']
				, $_POST['telefone']
				, $_POST['nif']
				, $_POST['email']
				, $_POST['data_nascimento']
				, $_POST['data_entrada']
				);

				if($stmt->execute())
				{
					echo "<script type=\"text/javascript\"> 
				       					window.location=\"sucesso.php\";
				       		 </script>";
				}
				else
				{
					echo mysqli_error($mysqli);
				}
			}
			else
			{
				//echo mysqli_error($mysqli);			
			}					
				
						/*echo "<script type=\"text/javascript\"> 
				       					window.location=\"sucesso.php\";
				       		 </script>";*/

		}
		else
		{
			mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
		}
		
	}
	else 
		{
				//echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
				//echo "<script> alert('$mysqli->error') </script>";
			    //echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
		}

	$stmt->close();
 	$mysqli->close();
?>



</body>
</html>