<?php
	include_once "topo.php";

	session_start();
	$id_usuario = $_SESSION["id_usuario"]; //pega id do usuário logado

	error_reporting(1);
			
	include_once "conexao_bd.php";

?>

<body>
	<?php include_once "navBar.php" ?>

	<div style="min-height: 100%; margin-bottom: -50px;">

	<div class="container" style="margin-top: 50px; margin-bottom: 50px">
		<table style="margin-left: 35%;" >
			<?php
				$pagina = "notificacao";

				$sql = "SELECT *
					FROM amizades
					WHERE ((id_bruxo_2 = $id_usuario) and (status = 'pendente'))";
				

				$retorno = $conexao->query($sql);

				if($retorno == false){
					echo $conexao->error;
				}

				$temNotificacao = false;

				while ($registro = $retorno->fetch_array()){

					$temNotificacao = true;

					$id_bruxo = $registro["id_bruxo_1"];

					$sql_2 = "SELECT *
							FROM bruxos
							WHERE (id_bruxo = $id_bruxo)";

					$retorno_2 = $conexao->query($sql_2);

					if($retorno_2 == false){
						echo $conexao->error;
					} 

					$registro_2 = $retorno_2->fetch_array();

					$nm_bruxo = $registro_2["nm_bruxo"];
					$ft_bruxo = $registro_2["ft_bruxo"];
					

					echo"<tr>
							<td><a href=''><img src ='$ft_bruxo' width='60px' height='55px'></a></td>
							<td width='200px''>$nm_bruxo</td>
							<td><a href='aceitar_amizade.php?aceitar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>aceitar</a> | <a href='recusar_amizade.php?recusar=true&id_usuario=$id_usuario&id_bruxo=$id_bruxo&pagina=$pagina'>recusar</a></td>
						</tr>";
					
				}

				if($temNotificacao == false){
					echo "<div align='center'><b>Nenhuma notificação! </b></div>";
				}
			?>
		</table>
	</div>
</div>

	<?php include_once "rodape.php" ?>
</body>
</html>