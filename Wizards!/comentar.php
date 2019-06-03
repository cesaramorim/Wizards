<?php

    include_once "topo.php";

	error_reporting(1);
			
	include_once "conexao_bd.php";



	$id_post = $_GET["id_post"];
	$id_usuario = $_GET["id_usuario"];	
    $ft_post = $_GET["ft_post"];
    $desc_post = $_GET["desc_post"];    
	$pagina = $_GET["pagina"];  

    $id_amigo = $_GET["id_amigo"];
    $nome_amigo = $_GET["nome_amigo"];    
    $ft_amigo = $_GET["ft_amigo"]; 
    $coment_post = $_GET["coment_post"];

    $sql = "SELECT c.desc_coment, c.data_coment, b.nome_bruxo, b.ft_bruxo, c.id_bruxo
          FROM comentarios c
          INNER JOIN posts p on c.id_post = p.id_post
          INNER JOIN bruxos b on b.id_bruxo = c.id_bruxo
          WHERE c.id_post = '$id_post'";

      $retorno1 = $conexao->query($sql);

      

    echo "    

        <br>           

        <div class='w3-center' style='margin-top:3%'>";

        if ($id_amigo != $id_usuario){

            echo"
            <div style=' margin-bottom:1%'> 

                <img src='$ft_amigo' alt='Avatar' class='w3-circle' style='width:80px'>

                <h3><b>Magia de $nome_amigo</b></h3>

            </div>";
        } else {
            echo "<div style=' margin-bottom:1%'> 

                <h3><b>Sua magia</b></h3>

            </div>";
        }


        echo"

            <hr>

            <img src='$ft_post' style='width:50%' alt='' class='w3-margin-bottom '>                      

            <br>

            <p>$desc_post</p>

            <hr>

            <h2>Comentários</h2>

            </div> 

            "; 

            while($registro = $retorno1->fetch_array()) {

            $id_usuario2 = $_SESSION["id_usuario"];

            $nome_bruxo = $registro["nome_bruxo"];
            $desc_coment = $registro["desc_coment"];
            $data_coment = $registro["data_coment"];
            $ft_bruxo = $registro["ft_bruxo"];
            $id_bruxo = $registro["id_bruxo"];


            echo "
            <div align='center'>
            <table width='600px' height='50px' style='table-layout: fixed;' >
            <tr>
            <td rowspan='2' width='50px' valign='top' align='right'>

            "; if($id_usuario2 == $id_bruxo){

            echo "<a href='timelinePostagens.php'><img src='$ft_bruxo' style='width:40px; height:40px;' class='w3-circle'></a>

            </td>

            <td align='left' style='word-break:break-all;'><a href='timelinePostagens.php' style='text-decoration:none;'> <b>$nome_bruxo:</b></a> $desc_coment 

            

            "; } else {

            echo "<a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo&pagina=$pagina'><img src='$ft_bruxo' style='width:40px; height:40px;' class='w3-circle'></a>

            </td>

            <td align='left' style='word-break:break-all;'><a href='timelineAmigo.php?amigo=true&id_amigo=$id_bruxo&nome_amigo=$nome_bruxo&ft_amigo=$ft_bruxo' style='text-decoration:none;'><b>$nome_bruxo:</b></a> $desc_coment 

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

            


    if($_POST != NULL){        
        
        $desc_coment = $_POST["desc_coment"];

    	$sql = "INSERT INTO comentarios(id_post, id_bruxo, desc_coment, data_coment) VALUES ('$id_post','$id_usuario','$desc_coment',NOW())";

    	$retorno = $conexao->query($sql);

        if ($retorno == false) {
            echo $conexao->error;
        }

        if ($retorno == true) {

            include_once "conexao_bd.php";

            if($conexao->connect_error){
                echo "Erro de Conexão! <br>".$conexao->connect_error;
            }

            $sql_comentpost = "UPDATE `posts` SET `coment_post`= ($coment_post + 1) WHERE `id_post`=$id_post";

         
            $retorno = $conexao->query($sql_comentpost);

       
            if ($retorno == false) {
                echo $conexao->error;
            }

            echo "<script>
                    alert('Comentário enviado com sucesso!');";


                    if($pagina == "postagens"){
                		echo "location.href='timelinePostagens.php';";
                	}

                	if($pagina == "amigo"){
                		echo "location.href='timelineAmigo.php?amigo=true&id_amigo=$id_amigo&nome_amigo=$nome_amigo&ft_amigo=$ft_amigo';";
                	}

                	if($pagina == "timeline"){
                		echo "location.href='timeline.php';";
                	}

            echo "</script>";
    	}       
    }

?>

<body>
    <?php include_once "navBar.php"?>

    

    <div style="margin-bottom:5%; margin-left: 37%">   


        <form method="POST">
            <textarea rows="3" cols="45" name="desc_coment" class="form-control" maxlength="200" placeholder="Digite aqui seu comentário" required></textarea>                      

            <br><br>

            <input type="submit" value="Enviar" class="w3-button w3-theme" style="margin-left: 15%"></input>
        </form>

    </div>

    <?php include_once "rodape.php"?>
</body>
</html>