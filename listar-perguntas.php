<?php
require_once(__DIR__ ."/conexao.php");

//busca linhas da tabela perguntas
$sqlPerguntas = "SELECT * FROM perguntas";
$resultadoPerguntas = mysqli_query($conexao, $sqlPerguntas);

//pegando as categorias
$sqlCategorias = "SELECT * FROM categorias";
$resultadoCategorias = mysqli_query($conexao, $sqlCategorias);

$categorias = array();
while ($cat = mysqli_fetch_object($resultadoCategorias)) {
		array_push($categorias, $cat);
	}

require_once(__DIR__ ."/includes/header.php");
require_once(__DIR__ ."/includes/menu.php");
?>


	<div class="container">
		<h3>Perguntas no Sistema</h3>
		<hr>

		<?php if(isset($_GET['sucesso'])): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close"
				data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<?php echo $_GET['sucesso']; ?>
			</div>
		<?php endif; ?>

		<a href="form-pergunta.php" class="btn btn-success botao-new">+ Adicionar uma nova Pergunta</a>
	</div> <!-- end container -->

	<section class="container">
		<div class="table-responsive">

			<table class="table table-striped table-hover">
				<tr>
					<th>Categoria</th>
					<th>Questão</th>
					<th>Checagem</th>
					<th>Resposta Correta</th>
					<th>Ações</th>
				</tr>

				<?php
				// começo do loop while
				while ($pergunta = mysqli_fetch_object($resultadoPerguntas)) { ?>
					<tr>
						<td>
							<?php 
								foreach ($categorias as $categoria) {
									if ($pergunta->categorias_id == $categoria->id) {
										echo $categoria->nome;
										break;
									}
								}
							?>
						</td>

						<td><?php echo $pergunta->questao ?></td>

						<td>
							<?php 
								echo ($pergunta->checagem) 
								? "<span class='text-success'>Verdade</span>" 
								: "<span class='text-danger'>Falso</span>";
							?>
						</td>

						<td>
							<?php echo $pergunta->resposta_correta ?>
						</td>

						<td>
							<div class="btn-group">
								<a href='editar-pergunta.php?id=<?php echo $pergunta->id ?>'
									class='btn btn-default btn-xs'>
									Editar
								</a>
								<a href='#'
										class='btn btn-warning btn-xs'
										data-toggle="modal" data-target="#<?php echo $pergunta->id ?>">
										Excluir
								</a>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="<?php echo $pergunta->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title text-danger" id="myModalLabel">Excluir Registro</h4>
							      </div>
							      <div class="modal-body">
							        Tem certeza que deseja excluir o registro
											<strong><?php echo $pergunta->questao ?> </strong>
											permanentemente do Banco de Dados? <br>
											<strong class="text-danger">Observação: Essa ação não poderá ser revertida.</strong>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
											<a href='excluir-pergunta.php?id=<?php echo $pergunta->id ?>'
												class="btn btn-danger" id="confirm" >Excluir
											</a>
							      </div>
							    </div>
							  </div>
							</div>

						</td>
					</tr>
				<?php } // fim do loop while ?>
				</table>
			</div>  <!-- end row -->
		</section> <!-- end section -->

<?php require_once(__DIR__ ."/includes/footer.php"); ?>
