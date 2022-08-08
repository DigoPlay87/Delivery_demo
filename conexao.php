<?php 
	date_default_timezone_set('America/Sao_Paulo');

	$usuario = 'root';
	$senha = '';
	$servidor = 'localhost';
	$banco = 'delivery_cardapio';

	try {
		$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
	} catch (Exception $e) {
		echo 'Erro ao conectar com o banco de dados! <br>';
		echo $e;
	}


// VARIAVEIS GLOBAIS TEMPORÁRIOS
    $nome_sistema = 'Delivery-Hub';
    $email_adm = 'diego@ithub.com.br';


	// VARIAVELS DE CONFIGURAÇÕES
	$query = $pdo->query("SELECT * FROM config");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$logs = @$res[0]['logs'];	
	$nome_sistema = @$res[0]['nome'];
	$email_adm = @$res[0]['email_adm'];
	$tel_sistema = @$res[0]['telefone'];
	$end_sistema = @$res[0]['endereco'];
	$logo = @$res[0]['logo'];
	$favicon = @$res[0]['favicon'];	
?>