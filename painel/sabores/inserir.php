<?php 
$tabela = 'sabores';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];
$quantidade = $_POST['quantidade'];
$gramas = $_POST['gramas'];
$valor = $_POST['valor'];

//validar nome
$query = $pdo->query("SELECT * FROM sabores where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Sabor já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome=:nome, quantidade=:quantidade, gramas=:gramas, valor=:valor");
	$acao = 'inserção';
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome=:nome, quantidade=:quantidade, gramas=:gramas, valor=:valor WHERE id = '$id'");
	$acao = 'edição';
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":quantidade", "$quantidade");
$query->bindValue(":gramas", "$gramas");
$query->bindValue(":valor", "$valor");
$query->execute();
$ult_id = $pdo->lastInsertId();

if($ult_id == "" || $ult_id == 0){
	$ult_id = $id;
}

//inserir log
$acao = $acao;
$descricao = $nome;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

	
?>