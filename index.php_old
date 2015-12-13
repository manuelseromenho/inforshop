<?php

$con = mysql_connect("inforzen.com","inforshop","123BangBang+");

if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("inforshop", $con);

//$article_id = $_GET['id'];

//if( ! is_numeric($article_id) )
	//die('invalid article id');

$query = "SELECT * FROM inforshop.empresas LIMIT 0 , 1000";

$empresas = mysql_query($query);

echo "<h1> Empresas </h1>";

while($row = mysql_fetch_array($empresas, MYSQL_ASSOC))
{
	$nome = $row['nome_emp'];
	$contacto = $row['telefone_emp'];
	$nome = htmlspecialchars($row['nome_emp'],ENT_QUOTES);
	$contacto = htmlspecialchars($row['telefone_emp'],ENT_QUOTES);

	
	echo "<div style='margin:30px 0px;'> 	<span style='color: blue'>Nome:</span> $nome <span style='color: blue'> Contacto: </span> $contacto<br /> </div> ";
}

mysql_close($con);

?>