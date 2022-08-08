<?php 
$tabela = 'locais';
require_once("../../conexao.php");

$id = $_POST['id'];
$bairros = $_POST['bairros'];
$cidade = $_POST['cidade'];
$valor = $_POST['valor'];

//validar nome
$query = $pdo->query("SELECT * FROM locais where bairros = '$bairros'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Bairro já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET bairros=:bairros, cidade=:cidade, valor=:valor");
	$acao = 'inserção';
}else{
	$query = $pdo->prepare("UPDATE $tabela SET bairros=:bairros, cidade=:cidade, valor=:valor WHERE id = '$id'");
	$acao = 'edição';
}

$query->bindValue(":bairros", "$bairros");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":valor", "$valor");
$query->execute();
$ult_id = $pdo->lastInsertId();

if($ult_id == "" || $ult_id == 0){
	$ult_id = $id;
}

//inserir log
$acao = $acao;
$descricao = $bairros.' - '.$cidade;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

	
?>