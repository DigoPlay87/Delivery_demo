<?php 
	require_once("../conexao.php");
	$pag = 'usuarios';
?>

<center>
	<div class="ml-2 mr-2 card">
		<nav class="navbar navbar-expand navbar-white navbar-light">
			
			<a title="Incluir Sabor" onclick="inserir()"  type="button" class="btn btn-info mt-2 ml-2 mb-2 btn-lg">
				<i class="fas fa-plus text-white"></i>
			</a>
			
		</nav>

		<div id="listar" class="card-body">	</div>

	</div>
</center>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Nome </label>
								<input type="text" class="form-control" name="nome" id="nome" required placeholder="Seu nome completo."> 
							</div>						
						</div>																								
					</div>
					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>CPF </label>
								<input type="text" class="form-control" name="cpf" id="cpf" required placeholder="000.000.000-00"> 
							</div>						
						</div>	
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Telefone </label>
								<input type="text" class="form-control" name="telefone" id="telefone" placeholder="(00) 00000-0000"> 
							</div>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>E-mail </label>
								<input type="email" class="form-control" name="usuario" id="usuario" required placeholder="e-mail do usuário"> 
							</div>						
						</div>															
					</div>
					<div class="row">
						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Senha </label>
								<input type="password" class="form-control" name="senha" id="senha" required placeholder="******"> 
							</div>						
						</div>	
						<div class="col-md-7">						
							<div class="form-group"> 
								<label>Perfil </label>
								<select class="form-control" name="nivel" id="nivel" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>								
							</div>						
						</div>													
					</div>
						
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<i class="fas fa-check" style="color: white" ></i>&nbsp; Salvar
					</button>
				</div>

			</form>
		</div>
	</div>
</div>

<!-- ModalExcluir -->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content" style="width:400px; margin:0 auto;">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Excluir: <span id="nome-excluido"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-excluir">
				<div class="modal-body">

					<div class="row" align="center">
						<div class="col-md-6">
							<button type="submit" class="btn btn-danger" style="width:100px">
								<i class="fas fa-check"></i> &nbsp; &nbsp;Sim</button>
						</div>
						<div class="col-md-6">
							<button type="button" data-dismiss="modal" class="btn btn-success" style="width:100px">
							 	<i class="fas fa-times"></i>&nbsp; &nbsp;Não</button>	
						</div>
					</div>
					
					<input type="hidden" name="id" id="id-excluir"> 
					<input type="hidden" name="nome" id="nome-excluir"> 
					<small><div id="mensagem-excluir" align="center" class="mt-3"></div></small>					

				</div>
			</form>

		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">	
	$('#modalForm').on('shown.bs.modal', function(event) {
	  $("#nome").focus();
	})	
</script>
