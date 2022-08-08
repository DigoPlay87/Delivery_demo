<?php
	session_cache_limiter('private');
	$cache_limiter = session_cache_limiter();

	/* define o prazo do cache em 120 minutos */
	session_cache_expire(120);
	$cache_expire = session_cache_expire();
	/* inicia a sessão */

@session_start(); 
	require_once("conexao.php");

	$usuario = $_POST['username'];
	$senha = md5($_POST['pass']);
	// $senha = $_POST['pass'];

	// echo $senha;

	$res = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND (senha = '$senha' OR cpf = '$senha' )");

	// $usuario = $_POST['usuario'];
	// $senha = md5($_POST['senha']);

	// $query = $pdo->query("SELECT * FROM usuarios WHERE (email = '$usuario' OR cpf = '$usuario') AND senha_crip = '$senha' ");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($dados);

	if($total_reg > 0){
		$_SESSION['id_usuario'] = $dados[0]['id'];
		$_SESSION['nome_usuario'] = $dados[0]['nome'];
		$_SESSION['email_usuario'] = $dados[0]['usuario'];
		$_SESSION['cpf_usuario'] = $dados[0]['cpf'];
		$_SESSION['nivel_usuario'] = $dados[0]['nivel'];

		//inserir log
		$tabela = 'usuarios';
		$acao = 'login';
		$descricao = 'login';
		require_once("painel/inserir-logs.php");

		if(@$_SESSION['nivel_usuario'] == '3'){
			echo "<script>window.location='painel-balcao'</script>";	
		}else{
			echo "<script>window.location='painel'</script>";
		}		
	}else{
		echo "<script>window.alert('Dados Incorretos');</script>";
		echo "<script>window.location='index.php'</script>";
	}	
?>
