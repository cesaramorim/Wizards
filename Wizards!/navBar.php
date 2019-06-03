


<div class="w3-top">
	 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
	  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
	  

	  <a href="timelinePostagens.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Minhas Postagens"><i class="fa fa-user"></i></a>

	  <div class="w3-dropdown-hover w3-hide-small">
	    <a href="timelineNotificacoes.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificações"><i class="fa fa-bell"></i></a>
	  </div>
	  

	  <div style="float: none ;position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);">
	  	<a href="timeline.php" style="text-decoration:none;"><h2 style="font-family: 'Forte';">Wizards!</h2></a>
	  </div>

	  <!-- Buscar -->
	  <!--<div class="w3-bar-item  w3-hide-small w3-left-align w3-padding-large ">	    
	  	
	   	 <input type="text" name="nm_buscar" class="w3-input w3-border w3-round w3-light-grey " placeholder=" &#xF002; Buscar wizards" style="height:23px;width:200px; text-align: center; font-family: 'FontAwesome';">	
	    
	  </div> 

	  <input type="submit" placeholder="&#xF002;" class="w3-button w3-left-align" onclick="location.href='buscar.php'"> https://pngimage.net/wp-content/uploads/2018/05/bot%C3%A3o-pesquisar-png-4.png    https://image.flaticon.com/icons/png/512/8/8914.png-->

	 	<a href="timelineBuscar.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-left-align" title="Buscar Wizards"><i class="fas fa-search"></i></a>	 

	 	<a href="logoff.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-right">Sair</a>


	 	<?php

	error_reporting(1);

    include_once "conexao_bd.php";


    $id_usuario = $_SESSION["id_usuario"];

  
    $sql = "SELECT * 
            FROM bruxos 
            WHERE id_bruxo = $id_usuario";

  
    $retorno = $conexao->query($sql);

 
    if ($retorno == false) {
      echo $conexao->error;
    }

    while ($registro = $retorno->fetch_array()) {
      
      $id = $registro["id_bruxo"];
      
     
      echo "<a href='editar.php?id=$id' class='w3-bar-item w3-button w3-padding-large w3-hover-white w3-right' title='Configurações'><i class='fas fa-cogs'></i></a>";

    }

?>


	 </div>
</div>