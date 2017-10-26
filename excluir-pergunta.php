<?php
require_once(__DIR__ ."/conexao.php");
$id = (int) $_GET['id'];
$sql = "DELETE FROM perguntas WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
if($resultado){
  header("Location:listar-perguntas.php?sucesso=Excluído+com+Sucesso!");
  die();
}
