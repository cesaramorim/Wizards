<?php

  error_reporting(1);

  include_once "conexao_bd.php";

  $id = $_GET["id"];

  if ($id == NULL) {
    echo "O ID não foi passado! <br>";
  }

  $sql = "DELETE FROM posts 
          WHERE id_post = $id";

  $retorno = $conexao->query($sql);
  
  if ($retorno == true) {

    echo "<script>
            location.href='timelinePostagens.php';
          </script>";

  } else {

    echo "<script>
            alert('Erro ao Deletar!');
          </script>";

    
    echo $conexao->error;

  }

?> 