<?php 
$tabela = 'categorias';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];

$query = $pdo->query("SELECT * FROM categorias WHERE id = '$id' AND produtos > '0' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Esta Categoria não pode ser excluido, pois existe produtos associados ao mesmo!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';

//inserir log
$acao = 'exclusão';
$descricao = $nome;
$id_reg = $id;
require_once("../inserir-logs.php");

?>