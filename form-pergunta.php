<?php

require_once(__DIR__ ."/includes/header.php");
require_once(__DIR__ ."/includes/menu.php");

require_once(__DIR__ ."/conexao.php");

$sql = "SELECT * FROM categorias ORDER BY nome";
$resultado = mysqli_query($conexao, $sql);

?>

    <div class="container">
    <h3>Cadastrar Pergunta</h3>
    <form action="create-pergunta.php" method="post">

      <div class="form-group">
        <label>Questão</label>
        <textarea class="form-control" name="questao"></textarea>
      </div>

      <div class="form-group">
        <label>Resposta Correta <span class="text-danger">(apenas se houver)</span></label>
        <textarea class="form-control" name="resposta_correta"></textarea>
      </div>

      <div class="form-group">
        <label>Categoria</label>
        <select name="categorias_id">
          <?php while ($categoria = mysqli_fetch_object($resultado)) : ?>
          <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nome ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Checagem</label>
        <select class="form-control" name="checagem">
          <option value="0">Falso</option>
          <option value="1">Verdadeiro</option>
        </select>
      </div>

      <div class="form-group">
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
      </div>
    </form>
  </div>

<?php require_once(__DIR__ ."/includes/footer.php"); ?>
