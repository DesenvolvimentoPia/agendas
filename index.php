<?php

session_start();

$ln = "";

$explodirUrl = explode("/", $_SERVER['REQUEST_URI']);

for($x = 0; $x < count($explodirUrl) - 3; $x++) $ln .= "../";
if($ln == "") $ln = "./";

// Exibir Erros Oriundos do PHP
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

if(empty($_SESSION['usuario']) && !($_SESSION['acesso'] == 9 || $_SESSION['acesso'] == 2)) header("location: ./login.php");

else {

// Incluindo Cabeçalho Padrão
include "includes/cabecalho.html";

// Incluindo Corpo
include "includes/conteudo.html";

// Incluindo Scripts
include "includes/scripts.html";

// Incluindo rodapé Padrão
include "includes/rodape.html";

}

