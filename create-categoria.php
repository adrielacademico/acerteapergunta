<?php
require_once(__DIR__ ."/conexao.php");

if (isset($_POST['enviar'])) {
  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);

  echo $sql = "INSERT INTO categorias (nome) VALUES ('{$nome}')";

  $resultado = mysqli_query($conexao, $sql);

  if ($resultado) {
  	header("Location:listar-categorias.php?sucesso=Adicionado+com+sucesso!");
  } else {
		echo("Descrição do Erro: " . mysqli_error($conexao));
		die();
	}
}
