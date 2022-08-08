<?php 
$tabela = 'usuarios';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
// $cidade = $_POST['cidade'];

$pdo->query("DELETE FROM $tabela WHERE id = '$id'");

echo 'Excluído com Sucesso';

//inserir log
$acao = 'exclusão';
$descricao = $nome;
$id_reg = $id;
require_once("../inserir-logs.php");

?>