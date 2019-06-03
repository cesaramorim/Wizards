<?php

    error_reporting(1);
	   include_once "topo1.php";

  
  
    if (!empty($_POST['login_submit'])) {

    include_once "logar.php";

}

  if (!empty($_POST['register_submit'])) {

    include_once "registrar.php";

  }

 //Randomizar Gifs

  $bg = array('1.gif', '2.gif', '3.gif', '4.gif', '5.gif', '6.gif', '7.gif', '8.gif', '9.gif', '10.gif', '11.gif', '12.gif'); 

  $i = rand(0, count($bg)-1); 
  $selectedBg = "$bg[$i]";
?>

<style>
    
    .box {
      background:white;
            padding: 25px;
            padding-left: 100px;
            padding-right: 100px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            border-radius: 10px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;

            }

    .modal {
      position: absolute;
      top: 100px;
      right: 100px;
      bottom: 0;
      left: 0;
      z-index: 10040;
      overflow: auto;
      overflow-y: auto;
      }

      /* CSS da Imagem com Blur de fundo */

    body, html {
        height: 100%;
        margin: 0;
      }

    * {
      box-sizing: border-box;
      }

    .bg-image {
      /* The image used */
      background-image: url(/Wizards!/Gifs/<?php echo $selectedBg; ?>);

      /* Add the blur effect */
      filter: blur(2px);
      -webkit-filter: blur(2px);

      /* Full height */
      height: 100%; 

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      }

      
  </style>


<body>
<!-- Classe dos Gifs -->
<div class="bg-image"></div>

<!-- Classe da Caixa -->
<div class="box" style="width: 400px; height: 300px;">
 
  <h1 style="margin-top: 40px; font-size: 60px; font-family: 'Forte';">Wizards!</h1><br>
  <!-- Botão de Bem-Vindo -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="margin-top: 40px;">Acesse já!</button>

  </div>


  <!-- 1º Modal / Tela de Login -->
<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">


   <!-- Form de Login -->
    <form class="px-4 py-3" method="POST" name="login">
    <div class="form-group">
      <label>Bruxo(a)</label>
      <input type="text" name="nm_login" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Senha</label>
      <input type="password" name="ds_senhaLogin" class="form-control" required>
    </div>
    <div align="center">
    <input type="submit" class="btn btn-primary" name="login_submit" value="Alohomora!">
	</div>
  </form>

  	<div class="dropdown-divider"></div>
 	<div align="center">
  Não seja um Trouxa.<br><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal2" >Registre-se</button>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
      </div>
    </div>
  </div>
</div>


	<!-- 2º Modal / Tela de Registro -->
<div class="modal fade " role="dialog" id="myModal2" style="position: absolute; top: 50px;">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registre-se</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">


     <!-- Form de Registro -->
        <form class="px-4 py-3" method="POST" name="register">
    <div class="form-group">
      <h6 align="center">Digite seu nome Bruxo(a)!</h6>
      <input type="text" name="nome_bruxo" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Login</label>
      <input type="text" name="nm_bruxo" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="ds_email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Senha</label>
      <input type="password" name="ds_senha" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Foto de Perfil</label>
      <input type="text" name="ft_bruxo" class="form-control">
    </div>
    <div class="form-group">
      <label>Sua casa</label>
      <select name="id_casa" class="form-control" required>
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

                echo "<option value='$id'>$nome</option>";

              }

            ?>
      </select>
    </div>
    <div align="center">
    <input type="submit" class="btn btn-primary" name="register_submit" value="Me torne um Bruxo!">
  </div>
  <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
      </div>
    </div>
  </div>
 </div>
</div>

</form>
</body>
</html>