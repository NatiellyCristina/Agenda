<?php
	
	require_once("../classelayout/classeCabecalhoHTML.php");
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeButton.php");

	include ('cabecalho.php');
if(isset($_POST["id"])){
	$c = new ControllerBD($conexao);
	$colunas=array("*");
	$tabelas[0][0]="contato";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	$value_id_contato = $linha["ID_CONTATO"];
	$value_nome = $linha["NOME"];
	$value_endereco = $linha["ENDERECO"];
	$action = "altera.php?tabela=contato";
}
else{
	$action = "insere.php?tabela=contato";
	$value_id_contato="";
	$value_nome="";
	$value_endereco="";

}

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_CONTATO","placeholder"=>"ID CONTATO...","value"=>$value_id_contato);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"NOME","placeholder"=>"NOME...","value"=>$value_nome);
	$f->add_input($v);	
	$v = array("type"=>"text","name"=>"ENDERECO","placeholder"=>"ENDERECO...","value"=>$value_endereco);
	$f->add_input($v);	
	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3> Inserir Contato</h3>
<div id="status"></div>
<?php
	$f->exibe();

?>
<script>

	pagina_atual = 0;
	//quando o documento estiver pronto...
	$(function(){
	
		
		$(document).on("click",".remover",function(){
			id_remover = $(this).val();
			$.ajax({
				url: "remover.php",
				type: "post",
				data: {
						id: id_remover,
						tabela: "contato" 
					  },
				success: function(d){					
					if(d=='1'){
						$("#status").html("Removido com sucesso");
						$("#status").css("color","green")
					
					}
				}
			});
		});
		
		
		$(document).on("click",".alterar",function(){ 
			id_alterar = $(this).val();			
			$.ajax({
				url: "get_dados_form.php",
				type: "post",
				data: {id: id_alterar, 
                       tabela: "contato"
                    },
				success: function(dados){
					$("input[name='ID_CONTATO']").val(dados.id_contato);
					$("input[name='NOME']").val(dados.nome);
					$("input[name='ENDERECO']").val(dados.endereco);
					
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=contato",
					type: "post",
					data: {
						ID_CONTATO: $("input[name='ID_CONTATO']").val(),
						NOME: $("input[name='NOME']").val(),
						ENDERECO: $("input[name='ENDERECO']").val()
					 },
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Contato Alterado com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");
							$("input[name='ID_CONTATO']").val("");
							$("input[name='NOME']").val("");
							$("input[name='ENDERECO']").val("");
						}
						else{
							console.log(d);
							$("#status").html("Contato Não Alterado! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=contato",
				type: "post",
				data: {
						ID_CONTATO: $("input[name='ID_CONTATO']").val(),
						NOME: $("input[name='NOME']").val(),
						ENDERECO: $("input[name='ENDERECO']").val()
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Contato inserido com sucesso!");
						$("#status").css("color","green");
					}
					else{						
						$("#status").html("Contato Não inserido! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>
</html>