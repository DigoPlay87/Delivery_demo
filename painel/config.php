<center>
	<div class="container ml-2 mr-2 card">
		<nav class="navbar navbar-expand navbar-white navbar-light">
			
			<a id="btn-novo" type="button" class="btn btn-info mt-2 ml-2 mb-2 btn-lg" href="index.php?acao=<?php echo $pagina ?>&funcao=novo">
				<i class="fas fa-plus"></i>
			</a>
			
<!-- 			<form method="post" id="frm">
				<input type="hidden" name="pag" id="pag" value="<?php echo $pagina_pag ?>">
				<input type="hidden" name="itens_pag" id="itens_pag" value="<?php echo $itens_pag ?>">
			</form> -->
			

			<div class="direita">
				<!-- SEARCH FORM -->
				<form class="form-inline ml-3 float-right">
					<div class="input-group input-group-sm">
						<input class="form-control form-control-navbar" type="search" name="txtbuscar" id="txtbuscar" placeholder="Buscar" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-navbar" type="submit" id="btn-buscar">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>

		</nav>

		<div id="listar" class="card-body">
			
		</div>
	</div>
</center>