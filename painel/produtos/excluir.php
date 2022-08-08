<?php 
$tabela = 'produtos';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];

$sel_prod = $pdo->query("SELECT categoria FROM produtos WHERE id = '$id' ");
$rec_cat = $sel_prod->fetchAll(PDO::FETCH_ASSOC);
$rec_categoria = $rec_cat[0]['categoria'];

$sel_cat = $pdo->query("SELECT produtos FROM categorias WHERE id = '$rec_categoria' ");
$rec_cat = $sel_cat->fetchAll(PDO::FETCH_ASSOC);
$rec_produto = $rec_cat[0]['produtos'];

$cont_prod = $rec_produto - 1;
$sql = $pdo->prepare("UPDATE categorias SET produtos = '$cont_prod' WHERE id = '$rec_categoria'  ");
$sql->execute();

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';

//inserir log
$acao = 'exclusão';
$descricao = $nome;
$id_reg = $id;
require_once("../inserir-logs.php");

?>