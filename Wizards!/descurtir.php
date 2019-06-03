<?php
	error_reporting(1);
			
	include_once "conexao_bd.php";		

	function descurtir(&$id_post,&$id_usuario,&$pagina,&$conexao,&$id_amigo,&$nome_amigo,&$ft_amigo,&$like_post){

		if($conexao->connect_error){
			echo "Erro de Conexão! <br>".$conexao->connect_error;
		}

		$sql = "DELETE FROM `curtidas` WHERE ((id_post = $id_post) and (id_bruxo = $id_usuario))";

		
		$retorno = $conexao->query($sql);

	
		if ($retorno == false) {
			echo $conexao->error;
		}

		if ($retorno == true) {

			include_once "conexao_bd.php";

	        if($conexao->connect_error){
				echo "Erro de Conexão! <br>".$conexao->connect_error;
			}
			

	        $sql_likepost = "UPDATE `posts` SET `like_post`= ($like_post - 1) WHERE `id_post`=$id_post";

	        
			$retorno = $conexao->query($sql_likepost);

			
			if ($retorno == false) {
				echo $conexao->error;
			}

			if ($retorno == true) {

	        echo "<script>
	                alert('Descurtido com sucesso!');";

	                if($pagina == "amigo"){
	            		echo "location.href='timelineAmigo.php?amigo=true&id_amigo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo';";
	            	}

	            	if($pagina == "timeline"){
	            		echo "location.href='timeline.php';";
	            	}

	            	if($pagina == "postagens"){
	            		echo "location.href='timelinePostagens.php';";
	            	}

	        echo "</script>";
	    }	        


		} else {

			echo "<script>
    			alert('Erro ao descurtir post!');
   			 </script>";

		
		echo $conexao->error;

		}

	}


	if (isset($_GET['descurtir'])) {

	    $id_post = $_GET["id_post"];
	    $id_usuario = $_GET["id_usuario"];
	    $pagina = $_GET["pagina"];   

	    $id_amigo = $_GET["id_amigo"];
		$nome_amigo = $_GET["nome_amigo"];
		$ft_amigo = $_GET["ft_amigo"];
		$like_post = $_GET["like_post"];

	    if (($id_post == NULL) || ($id_usuario == NULL)){
	        echo "O ID nao foi passado <br>";
	    }

	    descurtir($id_post,$id_usuario,$pagina,$conexao,$id_amigo,$nome_amigo,$ft_amigo,$like_post);
	    
	}

?>