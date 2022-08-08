<?php 
$tabela = 'usuarios';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);
$nivel = $_POST['nivel'];

//validar nome
$query = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Bairro já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome=:nome, cpf=:cpf, telefone=:telefone, usuario=:usuario, senha=:senha, nivel=:nivel");
	$acao = 'inserção';
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome=:nome, cpf=:cpf, telefone=:telefone, usuario=:usuario, senha=:senha, nivel=:nivel WHERE id = '$id'");
	$acao = 'edição';
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":usuario", "$usuario");
$query->bindValue(":senha", "$senha");
$query->bindValue(":nivel", "$nivel");
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