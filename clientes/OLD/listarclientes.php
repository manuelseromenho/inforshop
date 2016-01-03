<html> 
<head> 
	<title> Lista de clientes </title> 
</head>
<body>
	<?php

		require("../ligacaoBD.php");
		//$mysqli = new mysqli($servername, $username, $password, $dbname);
		$nomeCliente = null;

		if(!$mysqli)
		{
			echo $mysqli->error;
		}

		mysqli_set_charset($mysqli, "utf8"); 


		if (mysqli_connect_errno()) 
		{
			printf("<br>Connect failed: %s\n", mysqli_connect_error());
			exit(); 
		}

		if ($stmt = $mysqli->prepare('SELECT nomeCliente FROM clientes;')) 
		{
			$stmt->execute();
			/* liga as variaveis ao comando preparado */
			$stmt->bind_result($nomeCliente);


			while ($stmt->fetch()){   //'busca' os valores
				/*printf("<a href='vendas_emp_i.php?id=%s'> 			
				%s \t %s \t %s \t %s</a> <br>", 
				$codigo, $codigo, $apelido, $nome, $cargo);*/
				//printf("%s<br>", $nomeCliente);
			echo $nomeCliente;
			echo "<br>";
			}
			

			$stmt->close(); // close statement
		}
		else
		{
			echo mysqli_error($mysqli);
		}
		$mysqli->close(); //close connection

		
	?>
</body>
</html>