<?php include_once "topo.php"; 

      include_once "conexao_bd.php";



?>

<?php 

  error_reporting(1);

  if ($_POST != NULL) {
  

  $id_usuario = $_SESSION["id_usuario"];

  $ft_post = $_POST["ft_post"];
  $desc_post = $_POST["desc_post"];
  


  if ($ft_post == "" && $desc_post == "") {

    echo "<script>
                alert('Preencha algum campo!');
              </script>";
  } else {

    if($ft_post == ""){
      $ft_post = "shotcuticon2.png";
    }

    $sql = "INSERT INTO posts (desc_post, ft_post, data_post, cod_bruxo) 
          VALUES ('$desc_post', '$ft_post', NOW(), '$id_usuario')";

  $retorno = $conexao->query($sql);

  if ($retorno == true) {

        echo "<script>
                alert('Post feito com sucesso!');
                location.href='timelinePostagens.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Postar!');
              </script>";

        echo $conexao->error;
      }

  }
  
}
  


 ?>



<body>
	<?php include_once "navBar.php"?>
  

	<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;">    
	
      <!-- PRIMEIRA LINHA ( COMPARTILHE SUAS MAGIAS ) -->
      <div class="w3-row">
	  	<div class="w3-col w3-green w3-container" style="width:30%"> </div>
	  	<div class="w3-col w3-container" style="width:40%">

	  		<h1 align = "center" style="margin-top: 10px;">Compartilhe suas magias!</h1>

	<div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
            	<div align = "center">
                <form method="POST">

              		<div class="w3-padding-32 w3-light-grey w3-circle" style="height: 200px; width: 200px;">
              			<input style="margin-top: 50px;" type="text" name="ft_post" class="form-control" placeholder="Insira uma foto" >
              		</div><br>

              			<textarea rows="3" cols="45" name="desc_post" class="form-control" maxlength="500"></textarea><br><br>

                    <button type="submit" class="w3-button w3-theme">Postar</button> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

<hr>

		<h1 align = "center" style="margin-top: 10px;">Suas magias</h1><br><br>
</div>
</div>




    <!-- SEGUNDA LINHA ( SUAS MAGIAS ) -->
    <?php
    error_reporting(1);

    $id_usuario = $_SESSION["id_usuario"];

    $pagina = "postagens";

    $sql = "SELECT * 
            FROM posts
            WHERE cod_bruxo = $id_usuario
            ORDER BY data_post DESC";
          
    $retorno = $conexao->query($sql);

    if ($retorno == false) {
        echo $conexao->error;
    }

   

          while ($registro = $retorno->fetch_array()) {

            $cod_bruxo = $registro["cod_bruxo"];
            $desc_post = $registro["desc_post"];
            $ft_post = $registro["ft_post"]; 
            $id_post = $registro["id_post"]; 
            $data_post = $registro["data_post"];
            $like_post = $registro["like_post"];
            $coment_post = $registro["coment_post"];
            
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
                      <a onclick=\"return confirm('Deseja Apagar?');\" class='w3-red w3-btn w3-round-large' href='apagarPost.php?id=$id_post' title='Apagar'><i class='fas fa-trash-alt'></i></a>
                      </div>

                      ";


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
                      <!-- BOTAO DESCURTIR  -->
                      <div class='child inline-block-child'>
                        <div class='circle' >$like_post &nbsp<a href = 'descurtir.php?descurtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$cod_bruxo&like_post=$like_post&nome_amigo=eu&ft_amigo=eu' class='far fa-thumbs-down' style='margin-top: 12px; text-decoration:none;' title='Descurtir'></a></div>
                      </div>
                    ";

                  } else {

                    echo "
                      <!-- BOTAO CURTIR  -->
                      <div class='child inline-block-child'>
                        <div class='circle' >$like_post &nbsp<a href = 'curtir.php?curtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$cod_bruxo&like_post=$like_post&nome_amigo=eu&ft_amigo=eu' class='far fa-thumbs-up' style='margin-top: 12px; text-decoration:none;' title='Curtir'></a></div>
                      </div>
                    ";
                  }

                    echo "

                      <!-- BOTAO COMENTAR -->                                  
                        <div class='child inline-block-child'>   
                          <div class='circle'>$coment_post &nbsp

                          <a title='Comentar' href='comentar.php?id_post=$id_post&id_usuario=$id_usuario&ft_post=$ft_post&desc_post=$desc_post&pagina=$pagina&coment_post=$coment_post&id_amigo=$id_usuario' class='fa fa-comment' style='margin-top: 12px;text-decoration:none;' title='Comentar'> </a>
                            
                          </div>
                        </div>
                      

                      </div>                      

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

            </div> <!-- /TD -->";
          }

?>

<!-- DIV DO CONTAINER -->
</div>
<br>

	<?php include_once "rodape.php"?>
</body>
</html>
