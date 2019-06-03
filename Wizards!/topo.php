<?php

session_start();

if ($_SESSION["logado"] != true) {
  header("Location: login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wizards!</title>
	<link rel="shortcut icon" href="shotcuticon.png">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	

	



	<style>
	html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}

	html, body {
		height: 100%;
		margin: 0;
	}

	/* Imagem de fundo */
	body{background-image: url("1.png");
			height: 100%; 
			margin: 0; 
			height: 100%; 
			background-position: right;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;


}

	.fontEditar{

		font-size: 25px;
		font-family: arial;
	}

	/* BOTOES!!! */
	.buttonNewPost {
		padding: 15px 25px;
		font-size: 24px;
		text-align: center;
		cursor: pointer;
		outline: none;
		color: #fff;
		background-color: #4CAF50;
		border: none;
		border-radius: 15px;
		display: inline-block;
		vertical-align: middle;
		-webkit-transform: perspective(1px) translateZ(0);
		transform: perspective(1px) translateZ(0);
		box-shadow: 0 9px #999;
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: transform;
		transition-property: transform;
	}
	.buttonNewPost:hover, .buttonNewPost:focus, .buttonNewPost:active {
		box-shadow: 0 9px #999;
		 -webkit-transform: scale(1.1) rotate(4deg);
		transform: scale(1.1) rotate(4deg), translateY(4px);;
	}

	.buttonPost {
		-webkit-transition-duration: 0.3s;	
	}
	.buttonPost:hover, .buttonPost:active {
		 -webkit-transform: scale(1.1) rotate(4deg);
		
	}

	/* Circulo do Post */
	.circle {
		 height: 40px;
		 width: 55px;
		 background-color: #CEECF5;
		 border-radius: 20%;
	}

	/* Logica dos botes de posts ficarem alinhados */
	.parent {
		  padding: 1rem;
	}
	.child {
		  padding: 1rem;
	}

	.inline-block-child {
 		 display: inline-block;
	}


</style>


	</style>
	</head>

