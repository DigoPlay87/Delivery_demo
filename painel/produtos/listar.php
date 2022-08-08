<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM produtos ORDER BY id desc");
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
				<th class="esc">ITEM_1</th> 
				<th class="esc">ITEM_2</th> 
				<th class="esc">ITEM_3</th> 
				<th class="esc">ITEM_4</th> 
				<th class="esc">VALOR</th> 
				<th class="esc">COMBO</th> 
				<th class="esc">ADICIONAL</th> 
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
$param1 = $res[$i]['param1'];
$param2 = $res[$i]['param2'];
$param3 = $res[$i]['param3'];
$param4 = $res[$i]['param4'];
$valor = $res[$i]['valor'];
$combo = $res[$i]['combo'];
$adicional = $res[$i]['adicional'];
//retirar quebra de texto do status
// $status = str_replace(array("\n", "\r"), ' + ', $status);

// $data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
// $data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

	$query1 = $pdo->query("SELECT * FROM sabores WHERE id = '$param1' "); $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
	$param1_nome = @$res1[0]['nome'];

	$query2 = $pdo->query("SELECT * FROM sabores WHERE id = '$param2' "); $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);	
	$param2_nome = @$res2[0]['nome'];

	$query3 = $pdo->query("SELECT * FROM sabores WHERE id = '$param3' "); $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);	
	$param3_nome = @$res3[0]['nome'];

	$query4 = $pdo->query("SELECT * FROM sabores WHERE id = '$param4' "); $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);	
	$param4_nome = @$res4[0]['nome'];

	$querycb = $pdo->query("SELECT * FROM status WHERE id = '$combo' "); $rescb =  $querycb->fetchAll(PDO::FETCH_ASSOC);
	$combo_nome = $rescb[0]['status'];

	$queryadic = $pdo->query("SELECT * FROM status WHERE id = '$adicional' "); $resadic = $queryadic->fetchAll(PDO::FETCH_ASSOC);
	$adicional_nome = $resadic[0]['status'];

	$queryst = $pdo->query("SELECT * FROM status WHERE id = '$status' "); $resst = $queryst->fetchAll(PDO::FETCH_ASSOC);
	$status_nome = $resst[0]['status'];

echo <<<HTML
			<tr> 
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$nome}</td> 
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$descricao}</td>
				<td class="esc" style="font-size: 16px; padding-left: 1%"><img src="../images/produtos/{$foto}" width="40px"></td>
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$param1_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$param2_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$param3_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%;">{$param4_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%;">R$ {$valor}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%; padding-left: 1.2%">{$combo_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%; padding-left: 2%">{$adicional_nome}</td>
				<td class="esc" style="font-size: 16px; padding-top: 1%; padding-left: 1%">{$status_nome}</td>
				<td style="padding-top: .73%;"> 
				
					<a href="#" onclick="editar('{$id}', '{$nome}', '{$descricao}','{$param1}','{$param2}','{$param3}','{$param4}','{$valor}','{$combo}','{adicional}', '{$status}','{$foto}')" title="Editar Dados" class="btn btn-warning btn-sm"><i class="fa fa-edit text-white"></i>
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



	function editar(id, nome, descricao, param1, param2, param3, param4, valor, combo, adicional, status, foto){

		for (let letra of status){  				
					if (letra === '+'){
						status = status.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);		
		$('#descricao').val(descricao);
		$('#status').val(status);	
		$('#param1').val(param1);
		$('#param2').val(param2);
		$('#param3').val(param3);
		$('#param4').val(param4);
		$('#valor').val(valor);
		$('#foto').val('');
		$('#target').attr('src','../images/produtos/' + foto);	

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function mostrar(id, nome, descricao, param1, param2, param3, param4, valor, combo, adicional, status, foto){

		for (let letra of status){  				
					if (letra === '+'){
						status = status.replace(' +  + ', '\n')
					}			
				}
		
		$('#nome_mostrar').text(nome);
		$('#descricao_mostrar').text(descricao);
		$('#status_mostrar').text(status);
		
		$('#target_mostrar').attr('src','../images/produtos/' + foto);	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');		
		$('#descricao').val('');
		$('#foto').val('');
		$('#target').attr('src','../images/produtos/sem-perfil.jpg');
	}

</script>



