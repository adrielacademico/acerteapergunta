<?php
require_once(__DIR__ ."/conexao.php");

if (isset($_POST['enviar'])) {
 	$id = (int) $_POST['id'];
 	$questao = mysqli_real_escape_string($conexao, $_POST['questao']);
  	$resposta_correta = mysqli_real_escape_string($conexao, $_POST['resposta_correta']);
  	$checagem = (int) $_POST['checagem'];
  	$categorias_id = (int) $_POST['categorias_id'];

	$sql = "UPDATE perguntas
	        SET questao='{$questao}', resposta_correta='{$resposta_correta}', checagem=$checagem, categorias_id=$categorias_id
	        WHERE id = $id";
	$resultado = mysqli_query($conexao, $sql);
	if($resultado){
	  header("Location:listar-perguntas.php?sucesso=Alterado+com+Sucesso!");
	  die();
	} else {
		echo("Descrição do Erro: " . mysqli_error($conexao));
		die();
	}
}
