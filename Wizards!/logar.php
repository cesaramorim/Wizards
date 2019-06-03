<?php

   
        error_reporting(1);

        include_once "conexao_bd.php";

        
        $nm_login = addslashes ($_POST["nm_login"]);
        $ds_senhaLogin = addslashes ($_POST["ds_senhaLogin"]);

        $ds_senhaLogin = md5($ds_senhaLogin);

        $sql = "SELECT * 
                FROM bruxos 
                WHERE nm_bruxo = '$nm_login' 
                AND ds_senha = '$ds_senhaLogin'";

        $retorno = $conexao->query($sql);

        if ($retorno == false) {
            echo $retorno->error;
            exit;
        }

        if($registro = $retorno->fetch_array()) {


          session_start();

          $_SESSION["logado"] = true;
          $_SESSION["id_usuario"] = $registro["id_bruxo"];
          $_SESSION["nome_usuario"] = $registro["nome_bruxo"];
          $_SESSION["login_usuario"] = $registro["nm_bruxo"];
          $_SESSION["email_usuario"] = $registro["ds_email"];
          $_SESSION["foto_usuario"] = $registro["ft_bruxo"];
          $_SESSION["casa_usuario"] = $registro["id_casa"];

        header("Location: timeline.php");
      
      } else {

        echo "<script>
            alert('Login ou Senha Inválido!');
             </script>";
  }
?>
