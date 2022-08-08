<?php 
	require_once("../conexao.php");
	$pag = 'categorias';
?>

<center>
	<div class="container ml-2 mr-2 card">
		<nav class="navbar navbar-expand navbar-white navbar-light">			
			<button onclick="inserir()" type="button" class="btn btn-info mt-2 ml-2 mb-2 btn-lg">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</button>
		</nav>

		<div id="listar" class="card-body"> </div>
		
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
								<label for="exampleFormControlInput1">Nome</label>
								<input type="text" class="form-control" id="nome" placeholder="Insira o Nome da Categoria " name="nome" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleFormControlInput1">Descrição</label>
								<input type="text" class="form-control" id="descricao" placeholder="Insira a Descrição para Categoria" name="descricao" required>
							</div>			
						</div>
					</div>

					<div class="row">
						<div class="col-md-9">						
							<div class="form-group"> 
								<label>Foto</label> <br /> 
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>	

						<div class="col-md-3">
							<div class="form-group"> 
								<label>Status</label>
								<select class="form-control" name="status"> 
									<option <?php if($logs == 'Sim') { ?>selected <?php } ?> value="Sim">Sim</option>
									<option <?php if($logs == 'Não') { ?>selected <?php } ?> value="Não">Não</option>
								</select>
							</div>			
						</div>											
					</div>			

					<div class="row">
						<div class="col-md-12">						
							<div class="form-group">						
								<div id="divImg">
									<center><img src="../images/categorias/sem-perfil.jpg"  width="130px" height="130px" id="target"></center>
								</div>	
							</div>
						</div>
					</div>						

					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<i class="fas fa-check" style="color: white" ></i>&nbsp; Salvar</button>
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
				<h4 class="modal-title" id="tituloModal">Excluir Registro: <span id="nome-excluido"> </span></h4>
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

<style type="text/css">
	.select2-selection__rendered {
		line-height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;
	}
	.select2-selection {
		height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;

	}
</style>  

<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>