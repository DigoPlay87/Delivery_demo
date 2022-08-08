<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM usuarios ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>Nome</th> 
				<th>Telefone</th>
				<th class="esc">CPF</th>
				<th class="esc">E-mail</th> 
				<th class="esc">Perfil</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$cpf = $res[$i]['cpf'];
$telefone = $res[$i]['telefone'];
$usuario = $res[$i]['usuario'];
$senha = md5($res[$i]['senha']);
$nivel = $res[$i]['nivel'];

// $data_F = implode('/', array_reverse(explode('-', $data)));

$query2 = $pdo->query("SELECT * FROM cargos WHERE id = '$nivel'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
// if(@count($res2) > 0){
	$cargo_usu = $res2[0]['nome'];
// }else{
// 	$nome_usu = 'Sem Usuário';
// }

echo <<<HTML
			<tr style="font-size: 18px;"> 
				<td style="padding-top: 0.70%;">{$nome}</td> 
				<td style="padding-top: 0.70%;">{$telefone}</td>
				<td class="esc" style="padding-top: 0.70%;">{$cpf}</td>
				<td class="esc" style="padding-top: 0.70%;">{$usuario}</td>
				<td class="esc" style="padding-top: 0.70%;">{$cargo_usu}</td>
				
				<td style="padding-top: 0.50%;"> 
					<a href="#" onclick="editar('{$id}', '{$nome}', '{$cpf}', '{$telefone}', '{$usuario}', '{$senha}', '{$nivel}')" title="Editar Dados" class="btn btn-warning btn-sm">
						<i class="fa fa-edit text-white"></i>
					</a>

					<a href="#" onclick="excluir('{$id}', '{$nome}')" title="Excluir Item" class="btn btn-danger btn-sm ml-1">
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

	function editar(id, nome, cpf, telefone, usuario, senha, nivel){
		$('#id').val(id);
		$('#nome').val(nome);		
		$('#cpf').val(cpf);
		$('#telefone').val(telefone);
		$('#usuario').val(usuario);
		$('#senha').val(senha);
		$('#nivel').val(nivel);
			
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#cpf').val('');
		$('#usuario').val('');		
	}
</script>





