
<?php
	include_once "topo.php";

  include_once "conexao_bd.php";
?>

<!-- PHP PARA O "BEM VINDO, ... !" -->
<?php

  error_reporting(1);

  $id = $_SESSION["id_usuario"];

  

  $sql = "SELECT * 
          FROM bruxos
          WHERE id_bruxo = '$id'";

  $retorno = $conexao->query($sql);

  if($registro = $retorno->fetch_array()) {

    $nome_bruxo = $registro["nome_bruxo"];
    $ft_bruxo = $registro["ft_bruxo"];

  }
  

?>

<body class="w3-theme-l5">


<?php include_once "navBar.php"?>
<div style="min-height: 100%; margin-bottom: -50px;">


<div class="w3-container w3-content " style="max-width:1400px;margin-top:80px;">    

  <div class="w3-row">
  <div class="w3-col w3-green w3-container" style="width:20%"></div>

  <div class="w3-col w3-container" style="width:60%">

        
         <h2 class="w3-center">Bem vindo(a), <?php echo $nome_bruxo ?>!</h2><br>
         <p class="w3-center"><img src="<?php echo $ft_bruxo ?>" class="w3-circle" style="height:106px;width:106px"></p>
         <!--<img src="shotcuticon.png" class="hat" width="6%">-->

      <br>

        <div class="w3-center">
        <a href="timelinePostagens.php" title="Nova Postagem" style="text-decoration:none;" class="buttonNewPost">Nova Postagem!</a>
        </div><br><br>
      

      <?php        

        $pagina = "timeline";        

        $id_usuario = $_SESSION["id_usuario"];        

        //CONSULTA TABELA POSTS - RETORNA OS POSTS (DO USUARIO E DOS SEUS AMIGOS)

        include_once "conexao_bd.php";

        $sql_posts = "SELECT * 
                      FROM `posts` 
                      WHERE cod_bruxo in(SELECT DISTINCT id_bruxo_1 FROM amizades 
                                         WHERE ((id_bruxo_1 = $id_usuario) or (id_bruxo_2 = $id_usuario)) and (status = 'amigo')
                                         UNION
                                         SELECT DISTINCT id_bruxo_2 FROM amizades 
                                         WHERE ((id_bruxo_1 = $id_usuario) or (id_bruxo_2 = $id_usuario)) and (status = 'amigo'))
                            or (cod_bruxo = $id_usuario)
                      ORDER BY data_post DESC";

        $retorno_posts = $conexao->query($sql_posts);

        if($retorno_posts == false){
            echo $conexao->error;
        }

        while($registro_posts = $retorno_posts->fetch_array()) {
          
          $id_post = $registro_posts["id_post"];
          $desc_post = $registro_posts["desc_post"];
          $ft_post = $registro_posts["ft_post"];      
          $data_post = $registro_posts["data_post"];      
          $like_post = $registro_posts["like_post"];
          $coment_post = $registro_posts["coment_post"];
          $cod_bruxo = $registro_posts["cod_bruxo"];

          //CONSULTA TABELA BRUXOS - RETORNA DADOS DO BRUXO

          include_once "conexao_bd.php";

          $sql_bruxos = "SELECT * FROM bruxos WHERE id_bruxo = $cod_bruxo";

          $retorno_bruxos = $conexao->query($sql_bruxos);

          if($retorno_bruxos == false){
              echo $conexao->error;
          }

          if($registro_bruxos = $retorno_bruxos->fetch_array()){

            $nome_bruxo = $registro_bruxos["nome_bruxo"];
            $ft_bruxo = $registro_bruxos["ft_bruxo"];
            $id_casa = $registro_bruxos["id_casa"];

          }

          //POSTANDO NA TIMELINE

          echo "
            <div class='w3-container w3-card w3-white w3-round w3-margin'><br>";


          if($id_usuario == $cod_bruxo){ 
            echo "
              <a href='timelinePostagens.php' style='text-decoration:none;'>
                <img src='$ft_bruxo' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
              </a>

              <span class='w3-right w3-opacity'>$data_post</span>

              <a href='timelinePostagens.php' style='text-decoration:none;'>
                <h4>$nome_bruxo</h4>
              </a>
            ";

          } else { 
            echo "
              <a href='timelineAmigo.php?amigo=true&id_amigo=$cod_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo' style='text-decoration:none;'>
                <img src='$ft_bruxo' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
              </a>

              <span class='w3-right w3-opacity'>$data_post</span>

              <a href='timelineAmigo.php?amigo=true&id_amigo=$cod_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo' style='text-decoration:none;'>
                <h4>$nome_bruxo</h4>
              </a>              
            ";
          }

            echo "    
              <br>          
              <hr class='w3-clear'>                
                <div class='w3-row-padding ' style='margin:0 -16px'>
                  <div class=' w3-center'>
                    <img src='$ft_post' style='width:100%' alt='' class='w3-margin-bottom '>                      

                    <p>$desc_post</p>                      
                  </div> 
                </div>

              <hr class='w3-clear'>

              ";

              $sql = "SELECT c.desc_coment, c.data_coment, b.nome_bruxo, b.ft_bruxo, c.id_bruxo
                      FROM comentarios c
                      INNER JOIN posts p on c.id_post = p.id_post
                      INNER JOIN bruxos b on b.id_bruxo = c.id_bruxo
                      WHERE c.id_post = '$id_post'";

                      $retorno1 = $conexao->query($sql);


                      while($registro = $retorno1->fetch_array()) {

                      $id_usuario2 = $_SESSION["id_usuario"];

                      $nome_bruxo_2 = $registro["nome_bruxo"];
                      $desc_coment = $registro["desc_coment"];
                      $data_coment = $registro["data_coment"];
                      $ft_bruxo_2 = $registro["ft_bruxo"];
                      $id_bruxo = $registro["id_bruxo"];


                      echo "
            <div align='center'>
            <table width='600px' height='50px' style='table-layout: fixed;' >
            <tr>
            <td rowspan='2' width='50px' valign='top' align='right'>

            "; if($id_usuario2 == $id_bruxo){

            echo "<a href='timelinePostagens.php'><img src='$ft_bruxo_2' style='width:40px; height:40px;' class='w3-circle'></a>

            </td>

            <td align='left' style='word-break:break-all;'><a href='timelinePostagens.php' style='text-decoration:none;'> <b>$nome_bruxo_2:</b></a> $desc_coment 

            

            "; } else {

            echo "<a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo_2&ft_amigo=$ft_bruxo_2&pagina=$pagina'><img src='$ft_bruxo_2' style='width:40px; height:40px;' class='w3-circle'></a>

            </td>

            <td align='left' style='word-break:break-all;'><a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo_2&ft_amigo=$ft_bruxo_2' style='text-decoration:none;'><b>$nome_bruxo_2:</b></a> $desc_coment 

            "; }
            echo "</td>
            <tr>
            <td align='left' > <p style='margin-top:0px; font-size: 10px; color:gray;'><i>$data_coment</i></p></td>
            </tr>
            </table>
            </div>
            <br>
            ";
        }



          

          //consulta banco 
          //para saber se usuario ja curtiu o post
          $sql_curtiu = "SELECT * FROM `curtidas` WHERE ((id_post = $id_post) and (id_bruxo = $id_usuario))";

          $retorno_curtiu = $conexao->query($sql_curtiu);

          if ($retorno_curtiu == false) {
              echo $conexao->error;
          }

          //se usuario ja curtiu o post
          if($registro_curtiu = $retorno_curtiu->fetch_array()){

            //ATIVA BOTAO DESCURTIR
            echo "
              <button type='button' class='w3-button w3-theme-d1 w3-margin-bottom'>
                <div>$like_post &nbsp

                  <a href='descurtir.php?descurtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$cod_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo&like_post=$like_post' class='fa fa-thumbs-down' title='Descurtir' style='text-decoration:none;'></a>

                </div>
              </button> 
            ";

          } else {

            //ATIVA BOTA CURTIR
            echo "
              <button type='button' class='w3-button w3-theme-d1 w3-margin-bottom'>
                <div>$like_post &nbsp

                  <a href='curtir.php?curtir=true&id_post=$id_post&id_usuario=$id_usuario&pagina=$pagina&id_amigo=$cod_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo&like_post=$like_post' class='fa fa-thumbs-up' title='Curtir' style='text-decoration:none;'></a>

                </div>
              </button>
            ";
          }

          //BOTAO COMENTAR
          echo "

            
              <button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'>                
                <div>$coment_post &nbsp

                  <a title='Comentar' href='comentar.php?id_post=$id_post&id_usuario=$id_usuario&ft_post=$ft_post&desc_post=$desc_post&id_amigo=$cod_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo&pagina=$pagina&coment_post=$coment_post' class='fa fa-comment' style='text-decoration:none;'> </a>
                
                </div>
              </button>             
            </div>
          ";
        }

      ?>
      
      
      
      <!--<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">16 min</span>
        <h4>Jane Doe</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>  

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar6.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">32 min</span>
        <h4>Angie Jane</h4><br>
        <hr class="w3-clear">
        <p>Have you seen this?</p>
        <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div> -->
  </div>
  <div class="w3-col w3-red w3-container" style="width:20%"></div>
  </div>
<br>


</div>
<br>
</div>

<?php include_once "rodape.php" ?>

 
<script>

function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}


function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>




</body>
</html> 
