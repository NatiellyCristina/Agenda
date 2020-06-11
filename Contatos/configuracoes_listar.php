<?php

if(isset($_GET["t"])){

	if($_GET["t"]=="contato"){
		
		$colunas = array(   "id_contato as 'ID'","nome as 'Nome'","endereco as 'Endereco'");				
				$t[0][0] = "contato";
				$t[0][1] = null;
	}
	if($_GET["t"]=="telefone"){
		
		$colunas = array(   "id_telefone as 'ID'","contato.nome as 'Nome'", "telefone as 'Telefone'");				
				$t[0][0] = "telefone";
				$t[0][1] = "contato";
	}
	
}
?>