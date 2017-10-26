<?php
require_once(__DIR__ ."/conexao.php");

if (isset($_POST['enviar'])) {
  $questao = mysqli_real_escape_string($conexao, $_POST['questao']);
  $resposta_correta = mysqli_real_escape_string($conexao, $_POST['resposta_correta']);
  $checagem = (int) $_POST['checagem'];
  echo $categorias_id = (int) $_POST['categorias_id'];

  $sql = "INSERT INTO perguntas (questao, resposta_correta, checagem, categorias_id)
  VALUES ('{$questao}','{$resposta_correta}',$checagem, $categorias_id)";

  $resultado = mysqli_query($conexao, $sql);

  if ($resultado) {
  	header("Location:listar-perguntas.php?sucesso=Adicionado+com+sucesso!");
  } else {
		echo("Descrição do Erro: " . mysqli_error($conexao));
		die();
	}
}
