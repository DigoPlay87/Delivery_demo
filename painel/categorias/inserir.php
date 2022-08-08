<?php 
$tabela = 'categorias';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$status = $_POST['status'];
$id = $_POST['id'];

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Categoria já Cadastrado, escolha Outro!';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-perfil.jpg';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/categorias/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){
		
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){
				@unlink('../../images/categorias/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, descricao = :descricao, status = :status, foto = '$foto'");
	$acao = 'inserção';

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, descricao = :descricao, status = :status, foto = '$foto' WHERE id = '$id'");
	$acao = 'edição';
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":status", "$status");
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