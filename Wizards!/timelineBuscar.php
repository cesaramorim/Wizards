<?php
	session_start();
	$id_usuario = $_SESSION["id_usuario"]; //pega id do usuário logado
	

	error_reporting(1);
			
	include_once "conexao_bd.php";

	$buscar_sql = "";

	if($_POST != NULL){
		$nome_buscar = $_POST["nome_buscar"];

		$buscar_sql = " WHERE nome_bruxo like '%$nome_buscar%'";
	} 
?>

<?php include_once "topo.php"?>
<?php include_once "navBar.php"?>

	<body>
		<div style="min-height: 100%; margin-bottom: -50px;">


	<div class="container" style="margin-top: 50px; margin-bottom: 50px">

	<form method="POST">
		<hr>
		<b style="margin-left: 40%">Buscar :</b>

		<input type="text" name="nome_buscar" required> 
		<input type="submit" value="OK"> 

		<hr>
	</form>

	<?php if($_POST != NULL){ ?>

	  	<table style="margin-left: 35%;" >
		    <?php

		    	$pagina = "buscar";
				
				$sql = "SELECT *
					FROM bruxos
					$buscar_sql";
				

				$retorno = $conexao->query($sql);

				if($retorno == false){
					echo $conexao->error;
				}


				$temBruxo = false;

				while ($registro = $retorno->fetch_array()){

					$temBruxo = true;
					
					$id_bruxo = $registro["id_bruxo"];
					$nome_bruxo = $registro["nome_bruxo"];
					$ft_bruxo = $registro["ft_bruxo"];

					if($id_usuario == $id_bruxo){

						echo "<tr>
								<td><a href='timelinePostagens.php'><img src = '$ft_bruxo' width='60px' height='55px'></a></td>
								<td width='200px''><a href='timelinePostagens.php' style='text-decoration:none;'>$nome_bruxo</a></td>
								<td align='center'>Você</td>
							 <tr>";

					} else {

						echo"<tr>
								<td><a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo&pagina=$pagina'><img src = '$ft_bruxo' width='60px' height='55px'></a></td>
								<td width='200px''><a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo' style='text-decoration:none;'>$nome_bruxo</a></td>";

						
						//ver se existe relação entre os bruxos
						$sql_amizade = "SELECT *
							FROM amizades
							WHERE ((id_bruxo_1 = '$id_usuario') and (id_bruxo_2 = '$id_bruxo')) or ((id_bruxo_1 = '$id_bruxo') and (id_bruxo_2 = '$id_usuario'))";

						$retornoAmizade = $conexao->query($sql_amizade);

						if($retornoAmizade == false){
							echo $conexao->error;
						}

						$registroAmizade = $retornoAmizade->fetch_array();
						$status = $registroAmizade["status"];


						//Se é amigo
						if($status == "amigo"){
							echo "<td><a href='desfazer_amizade.php?desfazer=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>desfazer amizade</a></td>";

						//Se usuário não aceitou solicitação
						} else if($status == "pendente"){
							//echo "<td>amizade pedente</td>";

							include_once "conexao_bd.php";	

							$sql_pendente = "SELECT *
								FROM amizades
								WHERE ((id_bruxo_1 = '$id_usuario') and (id_bruxo_2 = '$id_bruxo'))";

							$retorno_pendente = $conexao->query($sql_pendente);

							if($retorno_pendente == false){
								echo $conexao->error;
							}

							if($registro_pendente = $retorno_pendente->fetch_array()){
								$solicitou = $id_usuario;
							} else {
								$solicitou = $id_bruxo;
							}

							//Se usuário que solicitou amizade
							if($solicitou == $id_usuario){
								echo "<td><a href='cancelar_solicitacao.php?cancelar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>cancelar solicitação</a></td>";
							} else {								

								echo "<td><a href='aceitar_amizade.php?aceitar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>aceitar</a> | <a href='recusar_amizade.php?recusar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>recusar</a></td>";
							}	

						//Se não for amigo mostra icone para ADD
						} else {
							echo"<td align='center'><a href='solicitar_amizade.php?solicitar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina' title='Enviar solicitação'><img src='https://static.vecteezy.com/system/resources/previews/000/379/115/non_2x/add-user-vector-icon.jpg' width='35px' height='35px'></a></td>";					
						}

						echo"</tr>";
					}
				}

				if($temBruxo == false){
					echo "<div align='center'><b>Nenhum bruxo(a) encontrado! </b></div>";
				}
				
			?>
		</table>	
	<?php } ?>
	
 	</div>

 	</div>

	<?php include_once "rodape.php"?>
</body>
</html>