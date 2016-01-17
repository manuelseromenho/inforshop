<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script>
		function passar(str) {
	    if (str == "") {
	        document.getElementById("txtHint").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	            }
	        };
	        xmlhttp.open("GET","adicionarProduto.php?idS="+str,true);
	        xmlhttp.send();
	    }
	}
	</script>
</head>
<body>

<?php
	require("../ligacaoBD.php");
	$q = intval($_GET['idC']);

	$sql = "SELECT s.id_Subcategoria, s.subcategoria FROM subcategorias as s, categorias as c 
	WHERE s.id_Categoria = c.id_Categoria AND s.id_Categoria = ".$q."";
	
	echo "<table class='table' width='auto'>";
	echo "<tr> <td> <p class='label'> Subcategoria: </p> </td> ";
	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idS, $sub);

		echo "<td> <p class='label'> <select name='idS' class='selected'>";
		echo "<option value=".$_POST['$idS']." selected> Seleccione uma subcategoria </option>\n";
		while ($smtp->fetch())
		{	
			echo "<option value=".$_POST['$idS'].">  $sub ($idS) </option>\n";
			print_r($_POST);
		}
		echo "</select>";
		
	}	
	echo "</td> ";
	echo "<td> <a href='adicionarProduto.php?id=$idS'> <img src='../imagens/load.png' > </a></td></tr>";

?>
</body>
</html>