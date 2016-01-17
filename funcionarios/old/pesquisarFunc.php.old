<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}
	
	require("../ligacaoBD.php");
?>

<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8"/>  
	<script>
		function delFunc(str) //str é o id que vem da escolha na combobox
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
		        xmlhttp.open("GET","delFunc.php?idF="+str,true);
		        xmlhttp.send();
		    }
		}

		function pesqFunc()
		{
				var idFunc=document.getElementById("idFunc").value;

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
		        xmlhttp.open("GET","pesqFunc.php?idFunc="+idFunc,true);
		        xmlhttp.send();
		}


	</script>

</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Funcionários </h2> </td> </tr>
		<!--<form action="pesquisarFunc.php" method="POST">-->
		<form>
			<tr> 
				<td> <p class="form"> ID do Funcionário: </p> </td> 
				<td> <p> <input type="text" id="idFunc" name="idFunc" class="selected"> </p> </td> 
			</tr>
			<tr bgcolor="#c1c1ff">
				<td colspan="2"> 
					<!--<input type="submit" value="pesquisar" name="pesquisar" class="button">-->
					<a onmouseup="pesqFunc()" class="button">Pesquisar</a>
				</td> 
			</tr>
		</form>
	</table>

<?php

/*if(isset($_POST['eliminar']))
{
	//$id = $_POST["idFunc"];
	$sql_delete= "DELETE FROM funcionarios WHERE id_funcionario='$id'";
	if ($stmt = $mysqli->prepare($sql_delete)) 
	{
		$stmt->execute();
		$stmt->close(); // close statement
		
		echo ("<h2>Funcionário eliminado com sucesso!</h2>");
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}
}*/


if(isset($_POST['pesquisar']))
{
	//$id = $_POST["idFunc"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$id = $_POST["idFunc"];		
	}
	else
	{
		$id= "";			
	} 

	if($id == null)
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		ORDER BY id_funcionario";
	}
	else
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		WHERE id_funcionario = '$id'";
	}


	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id, $nome, $morada, $telefone, $nif, $email, $dataN, $dataE);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID </h2> </td> <td> <h2> Nome Funcionário </h2> </td> <td> <h2> Morada </h2> </td> <td> <h2> Telefone </h2> </td> <td> <h2> NIF </h2> </td> <td> <h2> E-MAIL </h2> </td> <td> <h2> Data Nascimento </h2> </td> <td> <h2> Data Entrada Serviço </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'>";
			printf ("%s", $id);
			echo "</p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $morada </p> </td> ";
			echo "<td> <p class='label'> $telefone </p> </td>";
			echo "<td> <p class='label'> $nif </p> </td> ";
			echo "<td> <p class='label'> $email </p> </td> ";
			echo "<td> <p class='label'> $dataN </p> </td> ";
			echo "<td> <p class='label'> $dataE </p> </td> ";
			echo "<td class='img'> <a href='editarFunc.php?id=$id&nome=$nome&morada=$morada&telefone=$telefone&email=$email&nif=$nif&dataN=$dataN&dataE=$dataE'> <img src='../imagens/edit.png' title='Editar Funcionário'> </a> </td> ";
			echo "<td class='img'> <a HREF='#up' onmouseup='delFunc(".$id.")'> <img src='../imagens/trash.png' title='Eliminar Funcionário'> </a> </td> ";
			/*echo "<td class='img'> 
						<form onsubmit='delFunc(".$id.")'>
							<input type='submit'  style='background:url(../imagens/trash.png) no-repeat;' />
						</form>
				</td>";*/
			

			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
		$stmt->close();
	}
}
$mysqli->close();
?>
		<a name="up" id='txtHint'></a>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>