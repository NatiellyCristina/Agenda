<?php
	class CabecalhoHTML{

		private $menu;

		public function exibe(){
			
			echo "<!DOCTYPE html>
				  <html>
				     <head>
						<meta charset='utf-8' />
						<style>
							select, textarea, input{margin:5px;}							
						</style>
						<script src='js/jquery-3.4.1.min.js'></script>
						<link href=../classeLayout/layout.css	 rel='stylesheet'>
					 </head>
					 <body>
					 <nav>
					";
			if($this->menu!=null){
				foreach($this->menu as $tabela=>$texto){
					echo "| <a href='listar.php?t=$tabela'>$texto</a> ";
				}				
				
	
				echo "</nav>
				<hr />";
				}
		}
		
		public function add_menu($tabela){
			$this->menu = $tabela;
		}
		
		
	}
?>