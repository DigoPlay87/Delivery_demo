<?php 
	require_once("../conexao.php");
	$pag = 'produtos';
?>
<center>
	<div class="ml-2 mr-2 card">
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
	<div class="modal-dialog modal-lg" role="document">
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
								<label>Categoria</label> 
								<select class="form-control categoria" name="categoria" id="categoria" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM categorias order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>

								</select>
							</div>						
						</div>						
						<div class="col-md-7">
							<div class="form-group">
								<label for="exampleFormControlInput1">Nome Produto</label>
								<input type="text" class="form-control" id="nome" placeholder="Nome do Produto" name="nome" required>
							</div>
						</div>
					</div>

					<div class="row">	
						<div class="col-md-2">
							<div class="form-group">
								<label for="exampleFormControlInput1">R$ Valor</label>
								<input type="text" class="form-control" id="valor" placeholder="R$ 0,00" name="valor" required>
							</div>
						</div>						
						<div class="col-md-2">
							<div class="form-group"> 
								<label>Combo</label>
								<select class="form-control" name="combo" id="combo" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM status order by status asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['status'] ?></option>
									<?php } ?>

								</select>
							</div>			
						</div>
						<div class="col-md-2">
							<div class="form-group"> 
								<label>Adicional</label>
								<select class="form-control" name="adicional" id="adicional" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM status order by status asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['status'] ?></option>
									<?php } ?>

								</select>
							</div>			
						</div>												
						<div class="col-md-2">
							<div class="form-group"> 
								<label>Ativo</label>
								<select class="form-control" name="status" id="status" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM status ORDER BY id ASC");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['status'] ?></option>
									<?php } ?>

								</select>
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
						<div class="col-md-3">
							<div class="form-group"> 
								<label>Sabor 1</label> 
								<select class="form-control categoria" name="param1" id="param1" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM sabores ORDER BY nome ASC");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>
							</div>							
						</div>
						<div class="col-md-3">
							<div class="form-group"> 
								<label>Sabor 2</label> 
								<select class="form-control categoria" name="param2" id="param2" style="width:100%;"> 
									<option value="0">Selecione Sabor</option>
									<?php 
										$query = $pdo->query("SELECT * FROM sabores ORDER BY nome ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}
												?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>	
							</div>						
						</div>
						<div class="col-md-3">
							<div class="form-group"> 
								<label>Sabor 3</label> 
								<select class="form-control categoria" name="param3" id="param3" style="width:100%;"> 
									<option value="0">Selecione Sabor</option>
									<?php 
										$query = $pdo->query("SELECT * FROM sabores ORDER BY nome ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>	
							</div>						
						</div>
						<div class="col-md-3">
							<div class="form-group"> 
								<label>Sabor 4</label> 
								<select class="form-control categoria" name="param4" id="param4" style="width:100%;"> 
									<option value="0">Selecione Sabor</option>
									<?php 
									$query = $pdo->query("SELECT * FROM sabores ORDER BY nome ASC");
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

					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Foto</label> <br /> 
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>
						<div class="col-md-6">						
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