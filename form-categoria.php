<?php
require_once(__DIR__ ."/includes/header.php");
require_once(__DIR__ ."/includes/menu.php");
?>

  <div class="container">
    <h3>Cadastrar Nova Categoria</h3>
    <form action="create-categoria.php" method="post">
      <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
      </div>
    </form>
  </div>

<?php require_once(__DIR__ ."/includes/footer.php"); ?>
