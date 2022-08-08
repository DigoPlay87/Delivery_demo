<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM locais ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>BAIRROS</th> 
				<th>CIDADE</th> 
				<th>R$ VALOR</th> 				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$bairros = $res[$i]['bairros'];
$nome = $res[$i]['bairros'];
$cidade = $res[$i]['cidade'];
$valor = $res[$i]['valor'];
echo <<<HTML
			<tr> 
				<td style="padding-top: 1%; padding-left: 1.40%; font-size: 16px;">{$bairros}</td>
				<td style="padding-top: 1%; padding-left: 1.40%; font-size: 16px;">{$cidade}</td>				
				<td style="padding-top: 1%; padding-left: 2.2%; font-size: 16px;">{$valor}</td>
				<td>
					<big><a href="#" onclick="editar('{$id}', '{$bairros}', '{$cidade}', '{$valor}')" title="Editar Dados" class="btn btn-warning btn-sm">
							<i class="fa fa-edit text-white"></i>
						</a>
					</big>
					<big><a href="#" onclick="excluir('{$id}', '{$nome}')" title="Excluir Item" class="btn btn-danger btn-sm ml-1">
							<i class="far fa-trash-alt"></i>
						 </a>
					</big>
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
	</table>
</small>
HTML;
}else{
	echo '<center><h3>Não possui nenhum registro cadastrado!</h3></center>';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	} );

	function editar(id, bairros, cidade, valor){
		$('#id').val(id);
		$('#bairros').val(bairros);	
		$('#cidade').val(cidade);
		$('#valor').val(valor);
			
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#bairros').val('');
		$('#cidade').val('');
		$('#valor').val('');
	}

</script>



