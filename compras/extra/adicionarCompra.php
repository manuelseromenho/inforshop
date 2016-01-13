<?php 
	session_start(); // Starts the session 

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
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'> 
	<link href="../jquery/jquery-ui.css" rel="stylesheet" />
	<script src="../jquery/jquery.min.js"></script>
	<script src="../jquery/jquery-ui.js"></script>
	<script>
		function addRow(tableID) 
		{
		        var table = document.getElementById(tableID);
		        var rowCount = table.rows.length;
		        var row = table.insertRow(rowCount);
		        var colCount = table.rows[1].cells.length;
		        for(var i=0; i<colCount; i++) 
		        {
		            var newcell = row.insertCell(i);
		            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		            //alert(newcell.childNodes);
		            switch(newcell.childNodes[0].type) 
		            {
		                case "select":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		            }
		        }
		   }
	    function deleteRow(tableID) {
	        try {
	        var table = document.getElementById(tableID);
	        var rowCount = table.rows.length;
	        for(var i=0; i<rowCount; i++) {
	            var row = table.rows[i];
	            var chkbox = row.cells[0].childNodes[0];
	            if(null != chkbox && true == chkbox.checked) {
	                if(rowCount <= 2) {
	                    alert("Cant delete all rows");
	                    break;
	                }
	                table.deleteRow(i);
	                rowCount--;
	                i--;
	            }
	        }
	        }catch(e) {
	            alert(e);
	        }
	    }



		function showUser(str) 
		{
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
		        xmlhttp.open("GET","getuser.php?idCliente="+str,true);
		        xmlhttp.send();
		    }
		}

		function showProd(str) 
		{
		    if (str == "") {
		        document.getElementById("txtHint1").innerHTML = "";
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
		                document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","getprod.php?idP="+str,true);
		        xmlhttp.send();
		    }
		}
	
	</script>
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

	
	<form action="adicionarCompra.php" method="POST">
		<table class="procura">
			<tr bgcolor="#c1c1ff"> 
				<td colspan="2"> <h2> Fazer uma nova compra </h2></td>
			</tr>
			<tr> 
				<td> <p class="label"> Nome do Cliente: </p> </td> 
				<td>
					<?php
						$sql = "SELECT id_Cliente, nome
								FROM clientes
								ORDER BY id_Cliente ASC";

						if ($smtp = $mysqli->prepare($sql))
						{
							$smtp->execute();						
							$smtp->bind_result($idCliente, $nomeC);
							
							echo "<p class='label'> <select name='idCliente' class='selected' onchange='showUser(this.value)'>";
							echo "<option value='$idCliente' selected> Seleccione um cliente </option>\n";
							while ($smtp->fetch())
							{	
								echo "<option value='$idCliente'> $nomeC ($idCliente) </option>\n";						
							}
							echo "</select>";

						}
					?>
				</td>
			</tr>
					
			<tr> <td> <p class="label"> Data da Compra: </p> </td> 	<td> <p> <input type="date" name="data" id="data" class="selected"> </p>  </td> </tr>
			<tr> <td> <p class="label"> Preço Total: </p> </td> 	<td> <p> <input type="text" name="preco" class="selected"> </p> </td> </tr>
		</table>

		<!--Script para o Datepicker no Firefox, caso não seja nativo-->
			<script>
			      var elem = document.createElement('input');
			      elem.setAttribute('type', 'date');
			 
			      if ( elem.type === 'text' ) 
			      {
			      	$('#data').datepicker({changeMonth: true, changeYear: true});
			      	$( "#data" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			      }

			</script>
			<!-- ###################################################### -->

		<div id="txtHint"> </div>


		<table class="procura" id="dataTable">
			<tr>
				<th></th>
				<th>Produto</th>
				<th>Qtd</th>
				<th>Preço</th>
				<th>Desconto</th>
			</tr>
			<tr>
				<td style="width:20px;"><input type="checkbox" name="chk" /></td>
				<td style="width:80px;">
						<?php
							$sql_prod = "SELECT id_produto, nome_produto,quantidade, preco_venda
									FROM produtos
									ORDER BY id_produto ASC";

							if ($smtp = $mysqli->prepare($sql_prod))
							{
								$smtp->execute();						
								$smtp->bind_result($idP, $descricao, $stock, $preco);

								echo "<select  name='produto[]' onchange='showProd(this.value)'>";
								echo "<option value='$idP' selected> Seleccione um produto </option>\n";
								while ($smtp->fetch())
								{		
									echo "<option value='$idP'> $descricao ($idP)</option>\n";
								}
								echo "</select>";
							}
						?>

				</td>
				<td style="width:80px;"><input type="text" name="qtd[]" required/></td>
				<td style="width:80px;">
					<input type="text" id="txtHint1" name="preco[]" required/>
				</td>
				<td style="width:80px;"><input type="text" name="desconto[]"/></td>
			</tr>
		</table>

			<INPUT type="button" value="Add row" onclick="addRow('dataTable')" />
 			<INPUT type="button" value="Delete row" onclick="deleteRow('dataTable')" />
    		<INPUT type="submit" name="send" value="send"/>

	</form>




		<table class="procura">
		<tr> 
			<td> <p class="label"> Descrição do Produto: </p></td>
			<!--<td colspan="2">-->
			<td>
				<?php
					$sql_prod = "SELECT id_produto, nome_produto 
							FROM produtos
							ORDER BY id_produto ASC";

					if ($smtp = $mysqli->prepare($sql_prod))
					{
						$smtp->execute();						
						$smtp->bind_result($idP, $descricao);

						echo "<p class='label'> <select name='idP' class='selected' onchange='showProd(this.value)'>";
						echo "<option value='$idP' selected> Seleccione um produto </option>\n";
						while ($smtp->fetch())
						{		
							echo "<option value='$idP'> $descricao ($idP)</option>\n";
						}
						echo "</select> </p> ";
					}
				?>
				</td>
			</tr>
			<tr> <td colspan="2"> <div id="txtHint2"> </div> </td> </tr>
			<tr> <td> <p class="label"> Quantidade: </p> </td> 		<td> <p> <input type="text" name="quantidade" class="selected"> </p> </td> </tr>
		</table>

			
		    
		    
		    <!--<table class="procura">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="finalizar" class="button" value="Finalizar Compra" /></td></tr>
			</table>-->
		</form>

	</div>
	
	<!-- ****************** FOOTER *************** -->
	<?php 
		include("footer.php"); 
		mysqli_close($mysqli);
	?>

</body>
</html>
