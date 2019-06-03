<?php

	error_reporting(1);
			
	include_once "conexao_bd.php";

	function aceitar(&$id_usuario,&$id_bruxo,&$conexao,&$nm_amigo,&$ft_amigo,&$pagina){

		if($conexao->connect_error){
			  echo "Erro de Conexão! <br>".$conexao->connect_error;
	 	}

	 	//Cria comando sql inserindo na tabela amizades com status pedente
	 	$sql = "UPDATE `amizades` SET `status`='amigo' WHERE ((id_bruxo_1=$id_bruxo) and (id_bruxo_2=$id_usuario))";

	 	
		$retorno = $conexao->query($sql);

		
		if ($retorno == false) {
				echo $conexao->error;
		}

		if ($retorno == true) {

	        echo "<script>
	                alert('Amizade aceita com sucesso!');";

	                if($pagina == "buscar"){
	               		echo "location.href='timelineBuscar.php';";
	            	}

	            	if($pagina == "notificacao"){
	            		echo "location.href='timelineNotificacoes.php';";
	            	}

	            	if($pagina == "amigo"){
	            		echo "location.href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nm_amigo=$nm_amigo&ft_amigo=$ft_amigo';";
	            	}
	        echo "</script>";

			} else {

				 echo "<script>
	    		 	alert('Erro ao aceitar amizade!');
	   			  </script>";

				
			echo $conexao->error;

		}		

	}

	if (isset($_GET['aceitar'])) {

	    $id_usuario = $_GET["id_usuario"];
	    $id_bruxo = $_GET["id_bruxo"];
	    $nm_amigo = $_GET["nm_amigo"];
	    $ft_amigo = $_GET["ft_amigo"];
	    $pagina = $_GET["pagina"];

	    if (($id_usuario == NULL) || ($id_bruxo == NULL)){
	        echo "O ID nao foi passado <br>";
	    }

	    aceitar($id_usuario,$id_bruxo,$conexao,$nm_amigo,$ft_amigo,$pagina); 
	}


?>