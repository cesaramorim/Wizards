<?php

  error_reporting(1);
  
  include_once "conexao_bd.php";

   
    $nome_bruxo = addslashes($_POST["nome_bruxo"]);
    $nm_bruxo = addslashes($_POST["nm_bruxo"]);
    $ds_email = addslashes($_POST["ds_email"]);
    $ds_senha = addslashes($_POST["ds_senha"]);
    $id_casa = addslashes($_POST["id_casa"]);
    $ft_bruxo = addslashes($_POST["ft_bruxo"]);

    $ds_senha = md5($ds_senha);

    if($ft_bruxo == ""){
        $ft_bruxo = "https://querotrabalharsite.files.wordpress.com/2017/01/11.jpg?w=1200";
    }
  

    
    if ($nome_bruxo != "" && $nm_bruxo != "" && $ds_email != "" && $ds_senha != "" && $id_casa != "") {

      
      $sql = "INSERT INTO bruxos (nome_bruxo, nm_bruxo, ds_email, ds_senha, ft_bruxo, id_casa) 
              VALUES ('$nome_bruxo', '$nm_bruxo', '$ds_email', '$ds_senha', '$ft_bruxo', '$id_casa')";

   
      $retorno = $conexao->query($sql);


      if ($retorno == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='login.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Cadastrar!');
              </script>";

     
        echo $conexao->error;

      }


    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";

    }

    ?>