<?php 
	require_once("../conexao.php");
	$pag = 'sabores';
?>

<center>
	<div class="container ml-2 mr-2 card">
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
						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>						
						</div>

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Qtd &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<small>
										<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Informe quantidade"></i>
									</small>
								<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="0"> 
							</div>						
						</div>	

						<div class="col-md-3">						
							<div class="form-group"> 
								<label>Gramas</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<small>
										<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Quantidade em gramas"></i>
									</small>
								<input type="number" class="form-control" name="gramas" id="gramas" placeholder="Gramas"> 
							</div>						
						</div>		

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Valor</label> 
								<input type="text" class="form-control" name="valor" id="valor" required placeholder="Valor Item"> 
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

<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip() 
 })
</script>

<script>
	$(function () {
		$('[data-toggle="popover"]').popover()
	})
</script>