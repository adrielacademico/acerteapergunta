<?php
require_once(__DIR__ ."/conexao.php");

$id = (int) $_POST['id'];
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);

$sql = "UPDATE categorias
        SET nome='{$nome}'
        WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
if($resultado){
  header("Location:listar-categorias.php?sucesso=Alterado+com+Sucesso!");
  die();
} else {
	echo("Descrição do Erro: " . mysqli_error($conexao));
	die();
}
