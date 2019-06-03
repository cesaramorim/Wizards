<?php include_once "topo.php"; ?>

<?php 

  error_reporting(1);

  if ($_POST != NULL) {

    include_once "conexao_bd.php";


    $id = $_GET["id"];


    $nome_bruxo = $_POST["nome_bruxo"];
    $ds_email = $_POST["ds_email"];
    $ft_bruxo = $_POST["ft_bruxo"];
    $id_casa = $_POST["id_casa"];
    $ds_senha = $_POST["ds_senha"];


    // ALTERANDO COM SENHA VAZIA
    if($ds_senha == NULL){
      $sql = "UPDATE bruxos
              SET nome_bruxo = '$nome_bruxo', 
                  ds_email = '$ds_email', 
                  ft_bruxo = '$ft_bruxo', 
                  id_casa = '$id_casa'
              WHERE id_bruxo = $id";

      if ($nome_bruxo != "" && $ds_email != "" && $id_casa != "" ) {

      $retorno = $conexao->query($sql);


      if ($retorno == true) {

        echo "<script>
                alert('Atualizado com Sucesso!');
                location.href='timeline.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Atualizar!');
              </script>";
        echo $conexao->error;

      }

    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";
    }



    // ALTERANDO COM SENHA
    } else {

      $ds_senha = md5($ds_senha);

    if ($nome_bruxo != "" && $ds_email != "" && $id_casa != "" ) {
 
      $sql = "UPDATE bruxos
              SET nome_bruxo = '$nome_bruxo', 
                  ds_email = '$ds_email', 
                  ft_bruxo = '$ft_bruxo', 
                  id_casa = '$id_casa', 
                  ds_senha = '$ds_senha'
              WHERE id_bruxo = $id";


      $retorno = $conexao->query($sql);


      if ($retorno == true) {

        echo "<script>
                alert('Atualizado com Sucesso!');
                location.href='timeline.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Atualizar!');
              </script>";

 
        echo $conexao->error;

      }

    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";
    }

}
}


    include_once "conexao_bd.php";


  $id = $_GET["id"];

 
  if ($id == NULL) {
    echo "O ID não foi passado! <br>";
  }

  $sql = "SELECT bruxos.*, casas.nm_casa AS nome_grupo
          FROM bruxos 
          INNER JOIN casas 
          ON bruxos.id_casa = casas.id_casa
          WHERE bruxos.id_bruxo = $id";

 
  $retorno = $conexao->query($sql);


  if ($retorno == false) {
    echo $conexao->error;
  }

  if ($registro = $retorno->fetch_array()) {
    
    $id_bruxo = $registro["id_bruxo"];
    $nome_bruxo = $registro["nome_bruxo"];
    $nm_bruxo = $registro["nm_bruxo"];
    $ds_email = $registro["ds_email"];
    $ft_bruxo = $registro["ft_bruxo"];
    $id_casa = $registro["id_casa"];
    $ds_senha = $registro["ds_senha"];
    $nome_grupo = $registro["nome_grupo"];


    if ($ft_bruxo == "") {
      $ft_bruxo = "https://querotrabalharsite.files.wordpress.com/2017/01/11.jpg?w=1200";
    }

  } else {
    echo "Este ID não existe! <br>";
  }

  
?>

<body>
  <?php include_once "navBar.php" ?>

	<h1 align = "center" style="margin-top: 80px;">Informações Mágicas</h1>

	<div class="w3-container" style="margin-top: 30px;">
	<div class="w3-col w3-green w3-container" style="width:20%"></div>
	<div class="w3-col w3-container" style="width:60%">


	<div class="w3-container w3-content " style="max-width:1400px;">   
	<div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding"><br>
              <form method="POST">

   	<div align = "center">
    <label class="fontEditar">Bruxo</label>
   	<input type="text" class="w3-input w3-border w3-round-large" name="nome_bruxo" maxlength="100" value="<?php echo $nome_bruxo ?>"><br>
   	</div>

   	<div align = "center">
    <label class="fontEditar">Login</label>
    <input type="text" class="w3-input w3-border w3-round-large" name="nm_bruxo" disabled value="<?php echo $nm_bruxo ?>"><br>
    </div>

    <div align = "center">
    <label class="fontEditar">E-Mail</label>
    <input type="email" class="w3-input w3-border w3-round-large" name="ds_email" maxlength="100" value="<?php echo $ds_email ?>"><br>
 	</div>

 	<div align = "center">
    <label class="fontEditar">Foto</label>
    <input type="text" class="w3-input w3-border w3-round-large" name="ft_bruxo" maxlength="100" value="<?php echo $ft_bruxo ?>"><br>
    </div>

    <div align = "center">
    <label class="fontEditar">Casa</label><br>
    <select name="id_casa" class="form-control">
      <option value="">Selecione</option>

      <?php

 
        error_reporting(1);

        include_once "conexao_bd.php";

   
        $sql = "SELECT * 
                FROM casas";

     
        $retorno = $conexao->query($sql);


        if ($retorno == false) {
          echo $conexao->error;
        }

        while ($registro = $retorno->fetch_array()) {
          
          $id = $registro["id_casa"];
          $nome = $registro["nm_casa"];

          if ($id_casa == $id) {
            echo "<option selected value='$id'>$nome</option>";
          }
          else {
            echo "<option value='$id'>$nome</option>";
        }

      }

      ?>

    </select>
    </div><br>

    <hr>

        <div align = 'center'>
             <label class='fontEditar'>Senha</label>
             <input type='password' class='w3-input w3-border w3-round-large' name='ds_senha' placeholder="Escreva a senha apenas caso deseje ALTERAR."><br>
          </div>

    
  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>

            </div>
          </div>
        </div>
      </div>
</div>

</div>
</div>
<br>

	<?php include_once "rodape.php" ?>

</body>
</html>