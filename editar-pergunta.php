<?php
require_once(__DIR__ ."/conexao.php");

$id = (int) $_GET['id'];
$sql = "SELECT * FROM perguntas WHERE id = $id";

$resultadoPergunta = mysqli_query($conexao, $sql);
$pergunta = mysqli_fetch_object($resultadoPergunta);

//buscar categorias
$sql = "SELECT * FROM categorias ORDER BY nome";
$categoriasNoBancoDeDados = mysqli_query($conexao, $sql);

require_once(__DIR__ ."/includes/header.php");
require_once(__DIR__ ."/includes/menu.php");

?>

  <div class="container">
    <h3>Editar Pergunta</h3>

		<form action="alterar-pergunta.php" method="post">

      <input type="hidden" name="id" value="<?php echo $pergunta->id ?>">

       <div class="form-group">
        <label>Questão</label>
        <textarea class="form-control" name="questao"><?php echo $pergunta->questao ?></textarea>
      </div>

      <div class="form-group">
        <label>Resposta Correta <span class="text-danger">(apenas se houver)</span></label>
        <textarea class="form-control" name="resposta_correta"><?php echo $pergunta->resposta_correta ?></textarea>
      </div>

      <div class="form-group">
        <label>Categoria</label>
        <select class="form-control" name="categorias_id">
            <?php while ($categoria = mysqli_fetch_object($categoriasNoBancoDeDados)) { ?>
              <option value="<?php echo $categoria->id ?>"
                <?php echo ($categoria->id === $pergunta->categorias_id) ? "selected >" : ">" ?>
                <?php echo $categoria->nome ?>
              </option>
            <?php } ?>
          </select>
      </div>

      <div class="form-group">
        <label>Checagem</label>
        <select class="form-control" name="checagem">
          <?php if ($pergunta->checagem == 1): ?>
              <option value="0">Falso</option>
              <option value="1" selected="">Verdadeiro</option>
            <?php else : ?>
              <option value="0" selected="">Falso</option>
              <option value="1">Verdadeiro</option>
            <?php endif; ?>
        </select>
      </div>

      <div class="form-group">
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
      </div>
    </form>
  </div>

<?php require_once(__DIR__ ."/includes/footer.php"); ?>
