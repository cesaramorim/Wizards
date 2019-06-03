<?php


$conexao = new mysqli("localhost", "root", "", "wizards");


if ($conexao->connect_error) {
  echo "Erro de Conexão!<br>".$conexao->connect_error;
}

?>