<?php

	$c = new CabecalhoHTML();
	$v = array(		
				"contato"=>"Contatos",
				"telefone"=>"Telefones"

				);
				
	$c->add_menu($v);
	$c->exibe();

?>