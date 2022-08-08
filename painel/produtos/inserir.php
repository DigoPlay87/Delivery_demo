<?php 
$tabela = 'produtos';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$param1 = $_POST['param1'];
$param2 = @$_POST['param2'];
$param3 = @$_POST['param3'];
$param4 = @$_POST['param4'];
$param5 = @$_POST['param5'];
$param6 = @$_POST['param6'];
$param7 = @$_POST['param7'];
$param8 = @$_POST['param8'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];
// $foto = $_POST['foto'];
$combo = $_POST['combo'];
// $vendas = $_POST['vendas'];
$adicional = $_POST['adicional'];
$status = $_POST['status'];

$nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Produto já Cadastrado, escolha Outro!';
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
$caminho = '../../images/produtos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){
				@unlink('../../images/produtos/'.$foto);
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
	$query = $pdo->prepare("INSERT INTO $tabela 
								SET nome=:nome, descricao=:descricao, param1=:param1, param2=:param2, param3=:param3, param4=:param4, param5=:param5, param6=:param6, param7=:param7, param8=:param8, valor=:valor, categoria=:categoria, foto='$foto', nome_url=:nome_url, combo=:combo, vendas='0', adicional=:adicional, status=:status
						  ");
	
	$sel_cat = $pdo->query("SELECT produtos FROM categorias WHERE id = '$categoria' ");
	$rec_cat = $sel_cat->fetchAll(PDO::FETCH_ASSOC);
	$rec_produtos = $rec_cat[0]['produtos'];

	$prod = $rec_produtos + 1;
	$cont_cate = $pdo->prepare("UPDATE categorias SET produtos = '$prod' WHERE id = '$categoria' ");
	$cont_cate->execute();

	$acao = 'inserção';

}else{
	$query = $pdo->prepare("UPDATE $tabela 
								SET nome=:nome, descricao=:descricao, param1=:param1, param2=:param2, param3=:param3, param4=:param4, param5=:param5, param6=:param6, param7=:param7, param8=:param8, valor=:valor, categoria=:categoria, foto='$foto', nome_url=:nome_url, combo=:combo, vendas='0', adicional=:adicional, status=:status 
								WHERE id = '$id'
						  ");
	$acao = 'edição';
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":param1", "$param1");
$query->bindValue(":param2", "$param2");
$query->bindValue(":param3", "$param3");
$query->bindValue(":param4", "$param4");
$query->bindValue(":param5", "$param5");
$query->bindValue(":param6", "$param6");
$query->bindValue(":param7", "$param7");
$query->bindValue(":param8", "$param8");
$query->bindValue(":valor", "$valor");
$query->bindValue(":categoria", "$categoria");
$query->bindValue(":nome_url", "$nome_url");
$query->bindValue(":combo", "$combo");
// $query->bindValue(":vendas", "$vendas");
$query->bindValue(":adicional", "$adicional");
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