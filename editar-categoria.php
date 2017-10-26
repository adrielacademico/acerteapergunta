<?php
require_once(__DIR__ ."/conexao.php");

$id = (int) $_GET['id'];
$sql = "SELECT * FROM categorias WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);
$categoria = mysqli_fetch_object($resultado);

require_once(__DIR__ ."/includes/header.php");
require_once(__DIR__ ."/includes/menu.php");

?>

  <div class="container">
    <h3>Editar Categoria</h3>

		<form action="alterar-categoria.php" method="post">

      <input type="hidden" name="id" value="<?php echo $categoria->id ?>">

      <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome"
        class="form-control"
        value="<?php echo $categoria->nome ?>">
      </div>

      <div class="form-group">
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
      </div>
    </form>
  </div>

<?php require_once(__DIR__ ."/includes/footer.php"); ?>
