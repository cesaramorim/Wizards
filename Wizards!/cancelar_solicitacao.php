<?php

	error_reporting(1);
			
	include_once "conexao_bd.php";

	function cancelar(&$id_usuario,&$id_bruxo,&$conexao,&$nm_amigo,&$ft_amigo,&$pagina){

		if($conexao->connect_error){
			  echo "Erro de Conexão! <br>".$conexao->connect_error;
	 	}

	 	//Cria comando sql deletando na tabela amizades
	 	$sql = "DELETE FROM `amizades` WHERE ((id_bruxo_1 = '$id_usuario') and (id_bruxo_2 = '$id_bruxo'))";

	 	
			$retorno = $conexao->query($sql);

			
		if ($retorno == false) {
				echo $conexao->error;
		 	}

		 	if ($retorno == true) {

	        echo "<script>
	                alert('Solicitação cancelada com sucesso!');";
	                
	                if($pagina == "buscar"){
	               		echo "location.href='timelineBuscar.php';";
	            	}

	            	if($pagina == "amigo"){
	            		echo "location.href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nm_amigo=$nm_amigo&ft_amigo=$ft_amigo';";
	            	}

	        echo "</script>";

			} else {

				 echo "<script>
	    		 	alert('Erro ao cancelar solicitação!');
	   			  </script>";

			
			echo $conexao->error;

		}		

	}

	if (isset($_GET['cancelar'])) {

	    $id_usuario = $_GET["id_usuario"];
	    $id_bruxo = $_GET["id_bruxo"];
	    $nm_amigo = $_GET["nm_amigo"];
	    $ft_amigo = $_GET["ft_amigo"];
	    $pagina = $_GET["pagina"];

	    if (($id_usuario == NULL) || ($id_bruxo == NULL)){
	        echo "O ID nao foi passado <br>";
	    }

	    cancelar($id_usuario,$id_bruxo,$conexao,$nm_amigo,$ft_amigo,$pagina); 
	}


?>