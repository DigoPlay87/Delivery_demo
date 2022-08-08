<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM sabores ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 
				<th>NOME</th> 
				<th>QTD</th> 
				<th>GRAMAS</th> 
				<th>R$ VALOR</th> 
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$quantidade = $res[$i]['quantidade'];
$gramas = $res[$i]['gramas'];
$valor = $res[$i]['valor'];
echo <<<HTML
			<tr> 
				<td style="padding-top: 1%; padding-left: 1.40%; font-size: 16px;">{$nome}</td>				
				<td style="padding-top: 1%; padding-left: 2%; font-size: 16px;">{$quantidade}</td>
				<td style="padding-top: 1%; padding-left: 2.5%; font-size: 16px;">{$gramas}</td>
				<td style="padding-top: 1%; padding-left: 2.2%; font-size: 16px;">{$valor}</td>
				<td>
					<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$quantidade}', '{$gramas}', '{$valor}')" title="Editar Dados" class="btn btn-warning btn-sm">
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

	function editar(id, nome, quantidade, gramas, valor){
		$('#id').val(id);
		$('#nome').val(nome);	
		$('#quantidade').val(quantidade);
		$('#gramas').val(gramas);
		$('#valor').val(valor);
			
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#quantidade').val('');
		$('#gramas').val('');
		$('#valor').val('');
	}

</script>



