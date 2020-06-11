<?php
	
	require_once("../classelayout/classeCabecalhoHTML.php");

	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeSelect.php");
		
	require_once("../classeForm/classeForm.php");

	require_once("../classeForm/classeButton.php");
	include ('cabecalho.php');
if(isset($_POST["id"])){
	$c = new ControllerBD($conexao);
	$colunas=array("*");
	$tabelas[0][0]="telefone";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	$value_id_telefone = $linha["ID_TELEFONE"];
	$select_id_contato = $linha["ID_CONTATO"];
	$value_id_telefone = $linha["TELEFONE"];
	$action = "altera.php?tabela=telefone";
}
else{
	$action = "insere.php?tabela=telefone";
	$value_id_telefone="";
	$select_id_contato="";
	$value_telefone="";

}

    
$select = "SELECT ID_CONTATO AS value,NOME AS texto FROM CONTATO ORDER BY NOME";
	
$stmt = $conexao->prepare($select);
$stmt->execute();

while($linha=$stmt->fetch()){
	$matriz[] = $linha;
}

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_TELEFONE","placeholder"=>"ID TELEFONE...","value"=>$value_id_telefone);
	$f->add_input($v);  
	$v = array("name"=>"ID_CONTATO","label"=>"Contato","selected"=>$select_id_contato);
    $f->add_select($v,$matriz);
	$v = array("type"=>"text","name"=>"TELEFONE","placeholder"=>"TELEFONE...","value"=>$value_telefone);
	$f->add_input($v);	
	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3> Inserir Telefone</h3>
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
						tabela: "telefone" 
					  },
				success: function(d){					
					if(d=='1'){
						$("#status").html("Removido com sucesso");
						$("#status").css("color","green");

					
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
                       tabela: "telefone"
                    },
				success: function(dados){
					$("input[name='ID_TELEFONE']").val(dados.id_telefone);
					$("select[name='ID_CONTATO']").val(dados.id_contato);
					$("input[name='TELEFONE']").val(dados.telefone);
					
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=telefone",
					type: "post",
					data: {
						ID_TELEFONE: $("input[name='ID_TELEFONE']").val(),
						ID_CONTATO: $("select[name='ID_CONTATO']").val(),
						TELEFONE: $("input[name='TELEFONE']").val()
					 },
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Telefone Alterado com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");
							$("input[name='ID_TELEFONE']").val("");
							$("select[name='ID_CONTATO']").val("");
							$("input[name='TELEFONE']").val("");
					
						}
						else{
							console.log(d);
							$("#status").html("Telefone Não Alterada! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=telefone",
				type: "post",
				data: {
						ID_TELEFONE: $("input[name='ID_TELEFONE']").val(),
						ID_CONTATO: $("select[name='ID_CONTATO']").val(),
						TELEFONE: $("input[name='TELEFONE']").val()
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Telefone inserido com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
					}
					else{						
						$("#status").html("Telefone Não inserido! Código já existe!");
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