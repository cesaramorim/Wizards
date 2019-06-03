<?php
	include_once "topo.php";

	error_reporting(1);
			
	include_once "conexao_bd.php";

?>

<body>
	<?php include_once "navBar.php"?>

	

	<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;">		

		
		<?php   

			function titulo(&$id_amigo,&$nome_amigo,&$ft_amigo,&$conexao){

				//1
				echo "
					<div class='w3-row'>
			  			<div class='w3-col w3-container' style='width:30%''> </div>

			  			<div class='w3-col w3-container' style='width:40%''>	
							<div class='w3-row-padding'>
							    <div class='w3-col m12'>
							        <div class='w3-card w3-round w3-white'>
							            <div class='w3-container w3-padding'>
							            	<div align = 'center'>	          
							              		
							              			<img src = '$ft_amigo' class='w3-light-grey w3-circle' style='height:200px;width:200px'>
							              			
							              		    <h1 align = 'center' style='margin-top: 10px;''>$nome_amigo</h1>  
				";
				//fim 1


				///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//RELACIONAMENTO DE AMIZADE//

				session_start();
				$id_usuario = $_SESSION["id_usuario"]; //pega id do usuário logado

				$pagina = "amigo";

			  	include_once "conexao_bd.php";

				//ver se existe relação entre os bruxos
				$sql_amizade = "SELECT *
					FROM amizades
					WHERE ((id_bruxo_1 = '$id_usuario') and (id_bruxo_2 = '$id_amigo')) or ((id_bruxo_1 = '$id_amigo') and (id_bruxo_2 = '$id_usuario'))";

				$retornoAmizade = $conexao->query($sql_amizade);

				if($retornoAmizade == false){
					echo $conexao->error;
				}

				$registroAmizade = $retornoAmizade->fetch_array();
				$status = $registroAmizade["status"];

				//Se é amigo
				if($status == "amigo"){
					echo "<a href='desfazer_amizade.php?desfazer=true&id_usuario=$id_usuario&id_bruxo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&pagina=$pagina'>desfazer amizade</a>";

				//Se usuário não aceitou solicitação
				} else if($status == "pendente"){
					//echo "<td>amizade pedente</td>";

					include_once "conexao_bd.php";	

					$sql_pendente = "SELECT *
						FROM amizades
						WHERE ((id_bruxo_1 = '$id_usuario') and (id_bruxo_2 = '$id_amigo'))";

					$retorno_pendente = $conexao->query($sql_pendente);

					if($retorno_pendente == false){
						echo $conexao->error;
					}

					if($registro_pendente = $retorno_pendente->fetch_array()){
						$solicitou = $id_usuario;
					} else {
						$solicitou = $id_amigo;
					}

					//Se usuário que solicitou amizade
					if($solicitou == $id_usuario){
						echo "<a href='cancelar_solicitacao.php?cancelar=true&id_usuario=$id_usuario&id_bruxo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&pagina=$pagina'>cancelar solicitação</a>";
					} else {								

						echo "<a href='aceitar_amizade.php?aceitar=true&id_usuario=$id_usuario&id_bruxo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&pagina=$pagina'>aceitar</a> | <a href='recusar_amizade.php?recusar=true&id_usuario=$id_usuario&id_bruxo=$id_amigo&nm_amigo=$nm_amigo&ft_amigo=$ft_amigo&pagina=$pagina'>recusar</a>";
					}	

				//Se não for amigo mostra icone para ADD
				} else {
					

					echo"<a href='solicitar_amizade.php?solicitar=true&id_usuario=$id_usuario&id_bruxo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&pagina=$pagina' title='Enviar solicitação'><img src='https://static.vecteezy.com/system/resources/previews/000/379/115/non_2x/add-user-vector-icon.jpg' width='35px' height='35px'></a>";	
									
				}
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				//2
				echo "
							              	</div>
							            </div>
							        </div>
							    </div>
							</div>			  				
			  			</div>
			  		</div>
			  	";
			  	//fim 2

		  	}


			function amigo(&$id_amigo,&$nome_amigo,&$ft_amigo,&$conexao){

				session_start();
				$id_usuario = $_SESSION["id_usuario"]; //pega id do usuário logado

				$pagina = "amigo";

				echo "<div style='margin-top:30px;'>
						<hr>";

			    $sql = "SELECT * 
			            FROM posts
			            WHERE cod_bruxo = $id_amigo"; 
		          
		    	$retorno = $conexao->query($sql);

			    if ($retorno == false) {
			        echo $conexao->error;
			    }
		   

			    $temPost = false;

		        while ($registro = $retorno->fetch_array()) {

		        	$temPost = true;

		            $cod_bruxo = $registro["cod_bruxo"];
		            $desc_post = $registro["desc_post"];
		            $ft_post = $registro["ft_post"]; 
		            $id_post = $registro["id_post"]; 
		            $data_post = $registro["data_post"];
		            $like_post = $registro["like_post"];	
		            $coment_post = $registro["coment_post"];	           

		            //3
		            echo "<div class='w3-col  w3-container' style='width:33%'> <!-- TD -->

		              <div class='w3-row-padding'>
		                <div class='w3-col m12'>
		                  <div class='w3-card w3-round w3-white'>
		                    <div class='w3-container w3-padding'>
		                      <div align='right' style='color: gray;'>
		                      $data_post
		                      </div>
		                      <div align = 'center'><br>

		                      <div class='parent'>
		                      <button onclick=\"document.getElementById('$id_post').style.display='block'\" class='w3-button'><img src='$ft_post' style='height:106px;width:106px' class='buttonPost'></button><br><br>

		                      <div class='child inline-block-child'>
		            ";
		            //fim 3


		            include_once "conexao_bd.php";


		            //consulta banco 
		            //para saber se usuario ja curtiu o post
		            $sql_curtiu = "SELECT * FROM `curtidas` WHERE ((id_post = $id_post) and (id_bruxo = $id_usuario))";

		            $retorno_curtiu = $conexao->query($sql_curtiu);

			  		if ($retorno_curtiu == false) {
			       		echo $conexao->error;
			   		}

			   		//se usuario ja curtiu o post
		            if($registro_curtiu = $retorno_curtiu->fetch_array()){
		                   
		                echo "
	                     	
	                     	<div class='circle' >$like_post &nbsp<a href = 'descurtir.php?descurtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&like_post=$like_post' class='far fa-thumbs-down' style='margin-top: 12px; text-decoration:none;' title='Descurtir'></a></div>
	                      	</div>                    	
	                     	
		                ";
		            } else {
		            	 echo "
	                     	
	                     	<div class='circle' >$like_post &nbsp<a href = 'curtir.php?curtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&like_post=$like_post' class='far fa-thumbs-up' style='margin-top: 12px; text-decoration:none;' title='Curtir'></a></div>
	                      	</div>
		                      	                    	
		                ";
		            }


		            // BOTAO COMENTAR 
                	echo "              
	                    <div class='child inline-block-child'>   
	                      <div class='circle'>$coment_post &nbsp

	                      <a title='Comentar' href='comentar.php?id_post=$id_post&id_usuario=$id_usuario&ft_post=$ft_post&desc_post=$desc_post&id_amigo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo&pagina=$pagina&coment_post=$coment_post' class='fa fa-comment' style='margin-top: 12px; text-decoration:none;'> </a>
	                        
	                      </div>
	                    </div>

                    </div>
               		 ";

		            //4        
		            echo "
		                        <div id='$id_post' class='w3-modal'>
		                        <div class='w3-modal-content w3-animate-top w3-card-4'>

		                        <header class='w3-container'> 
		                        <span onclick=\"document.getElementById('$id_post').style.display='none'\" class='w3-button w3-display-topright'>&times;</span>
		                        <h2></h2>
		                        </header>

		                        <div class='w3-container'>
		                          <img src='$ft_post' style='height:350px;width:350px'>
		                          <div style='width: 800px; word-wrap: break-word;'>
		                          <h3>$desc_post</h3>
		                          </div>


		                        </div>
		                        
		                        </div>
		                        </div>
		                        

		                      </div> 
		                    </div>
		                  </div>
		                </div>
		              </div><br>

		            </div> <!-- /TD -->

		            ";
		            //fim 4
		        }

		        if($temPost == false){
		        	echo "<div align='center'><h4><b>Não tem magias!<b></h4></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		        }

		        echo "</div>";
		    }


	        if (isset($_GET['amigo'])) {

			    $id_amigo = $_GET["id_amigo"];
			    $nome_amigo = $_GET["nome_amigo"];
			    $ft_amigo = $_GET["ft_amigo"];

			    if (($id_amigo == NULL)){
			        echo "O ID nao foi passado <br>";
			    }

			    titulo($id_amigo,$nome_amigo,$ft_amigo,$conexao);
			    amigo($id_amigo,$nome_amigo,$ft_amigo,$conexao);
		    
			}


		?>
	</div>


	<?php include_once "rodape.php"?>
</body>
</html>