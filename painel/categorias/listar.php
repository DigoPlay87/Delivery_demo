<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM categorias ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>NOME</th>
				<th class="esc">DESCRIÇÃO</th> 
				<th class="esc">IMAGEM</th> 
				<th class="esc">ATIVO</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$descricao = $res[$i]['descricao'];
$foto = $res[$i]['foto'];
$status = $res[$i]['status'];

//retirar quebra de texto do status
$status = str_replace(array("\n", "\r"), ' + ', $status);

// $data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
// $data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

// $query2 = $pdo->query("SELECT * FROM status WHERE id = '$status'");
// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
// if(@count($res2) > 0){
// 	$nome_cargo = $res2[0]['nome'];
// }else{
// 	$nome_cargo = 'Sem Status';
// }

echo <<<HTML
			<tr> 
				<td class="esc" style="font-size: 16px; padding-top: 1.2%; padding-left: 2%">{$nome}</td> 
				<td class="esc" style="font-size: 16px; padding-top: 1.2%; padding-left: 2%">{$descricao}</td>
				<td class="esc" style="font-size: 16px; padding-top: -1%; padding-left: 2%">
					<img src="../images/categorias/{$foto}" width="40px">
				</td>
				<td class="esc" style="font-size: 16px; padding-top: 1.2%; padding-left: 2%">{$status}</td>
				<td style="padding-top: 1%;"> 
				
					<a href="#" onclick="editar('{$id}', '{$nome}', '{$descricao}','{$status}','{$foto}')" title="Editar Dados" class="btn btn-warning btn-sm"><i class="fa fa-edit text-white"></i>
					</a>								
									
					<a href="#" onclick="excluir('{$id}', '{$nome}')" title="Excluir Item" class="btn btn-danger btn-sm ml-2">
						<i class="far fa-trash-alt"></i>
					</a>
				
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



	function editar(id, nome, descricao, status, foto){

		for (let letra of status){  				
					if (letra === '+'){
						status = status.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);		
		$('#descricao').val(descricao);
		$('#status').val(status);	
		$('#foto').val('');
		$('#target').attr('src','../images/categorias/' + foto);	

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function mostrar(id, nome, descricao, status, foto){

		for (let letra of status){  				
					if (letra === '+'){
						status = status.replace(' +  + ', '\n')
					}			
				}
		
		$('#nome_mostrar').text(nome);
		$('#descricao_mostrar').text(descricao);
		$('#status_mostrar').text(status);
		
		$('#target_mostrar').attr('src','../images/categorias/' + foto);	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');		
		$('#descricao').val('');
		$('#foto').val('');
		$('#target').attr('src','../images/categorias/sem-perfil.jpg');
	}

</script>



