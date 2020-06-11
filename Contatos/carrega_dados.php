<?php

header("Content-type: application/json");

include("conexao.php");
include("classeControllerBD.php");

$c = new ControllerBD($conexao);

$colunas = $_POST["colunas"];

$tabelas = $_POST["tabelas"];

$r = $c->selecionar($colunas,$tabelas,null,null);

while($linha=$r->fetch(PDO::FETCH_ASSOC)){
	$matriz[] = $linha;
}

echo json_encode($matriz);
?>