<?php

include("conexao.php");

//navbar e select dentro do include
include("cabecalholayout.php");

	echo"<div id='site'>";

//cookie do login enviado pela pagina login.php
$login_cookie = $_COOKIE['login'];


//select para receber o nome do usuário e a permissão comparando o login
$sql = "SELECT * FROM USUARIO WHERE login = '$login_cookie'";
	
$stmt = $conexao->prepare($sql);

$stmt->execute();

while($linha=$stmt->fetch()){		

	$nome = $linha["NOME"];
	$acesso = $linha["ACESSO"];

}

//verificar se o usuário está logado
if(isset($login_cookie)){

	echo"<b>Bem-Vindo, $nome!</b><br><br>";
  }
  else
  {
	header("Location:login.html");
  }
  //-----------------------

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>ALFRED</title>
		<link rel="shortcut icon" href="favicon.ico" >
		<script src="js/jquery-ui.min.js"></script>
	</head>
<body>
	
<meta charset="UTF-8">
<title>ALFRED</title>
<?php

//Permissão de usuário pra mostrar os formulários
if($acesso == 'adm'){

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
}
//----------------------------

?>
<br/>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/carousel.1.0.js"></script>
		<script type="text/javascript">

	$(document).ready(function(){
		$('.carousel').Carousel();
	});

</script>

<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body>
		<h1><b> Filmes em Cartaz:</b><h1>
			<br/>

			<!-- Criação das divs para o carrossel -->
			<div class='carousel' data-height='80%' data-width='500px' data-effect='size' data-stop_on_hover='true'>

<?php 
			//Select para receber os filmes respectivos dentro do banco de dados
			$sql = "SELECT DISTINCT
						CURRENT_TIMESTAMP(),
						TITULO,
						DATA_ESTREIA,
						DATA_RETIRADA
					FROM
						FILME
					WHERE
						CURRENT_TIMESTAMP() BETWEEN DATA_ESTREIA AND DATA_RETIRADA";

$stmt = $conexao->prepare($sql);

$stmt->execute();

while($linha=$stmt->fetch()){


	$titulo = $linha["TITULO"];

	//Criação das tags <a dentro da div do carrossel, até existir filmes dentro do banco, com get pro lista_filme.php
	echo"<a href='lista_filme.php?var=$titulo' style='border-bottom: none;'><img src='img/$titulo.jpg' alt='Coringa'/></a>";
}
	
//fechamento da div #site
echo"</div>";

include("footer.html");
?>