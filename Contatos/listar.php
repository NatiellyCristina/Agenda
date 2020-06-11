<?php
	require_once("../classeLayout/classeCabecalhoHTML.php");
	require_once("../classeLayout/classeTabela.php");
	require_once("classeControllerBD.php");

	require_once("conexao.php");
	
	require_once("configuracoes_listar.php");

	
	if($_GET["t"]=="contato"){
		require_once("form_contato.php");
	}
	if($_GET["t"]=="telefone"){
		require_once("Form_telefone.php");
	}
echo"	<h3> Lista de Contatos </h3>";
	
	$c = new ControllerBD($conexao);
	
	$r = $c->selecionar($colunas,$t,null,null,null);

	$matriz = null;

	while($linha = $r->fetch(PDO::FETCH_ASSOC)){
		$matriz[] = $linha;
	}


	$t = new Tabela($matriz,$t[0][0]);
	$t->exibe();

?>

