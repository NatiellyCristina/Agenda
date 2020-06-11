<?php


include("conexao.php");

if(!empty($_POST)){

	include("classeControllerBD.php");
	
	$c = new ControllerBD($conexao);
	
	$c->inserir($_POST,$_GET["tabela"]);
	echo "1";
}
?>