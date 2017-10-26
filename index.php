<?php

require_once(__DIR__ ."/conexao.php");

//busca linhas da tabela perguntas
$sqlPerguntas = "SELECT * FROM perguntas WHERE repondido = 0";
$resultadoPerguntas = mysqli_query($conexao, $sqlPerguntas);

$perguntas = array();

while ($p = mysqli_fetch_array($resultadoPerguntas)) {
	array_push($perguntas, $p);
}

//echo "<pre>";
//var_dump($perguntas);

/*pegando, aleatóriamente, o índice da pergunta no array de perguntas.
tem que calcular o tamanho do array menos 1, pois o array começa em 0.
*/
$indice = rand( 0, (count($perguntas) - 1));

//echo "índice " . $indice;
//echo count($perguntas);

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
		<h3>Acerte a Pergunta!</h3>
		<h5 class="alert alert-info"><strong>Categoria:</strong>
			<?php 
				foreach ($categorias as $categoria) {
					if ($perguntas[$indice]['categorias_id'] == $categoria->id) {
						echo $categoria->nome;
						break;
					}
				}
			?>
		</h5>

		<div class="jumbotron">
			<input type="hidden" id="valorChecagem" value="<?php echo $perguntas[$indice]['checagem'] ?>">
			<p><?php echo $perguntas[$indice]['questao'] ?>?</p>

			<div class="alert alert-danger" id="errou">Errou!!!</div>
			<div class="alert alert-success" id="acertou">Acertou!!!</div>
			<img src="" id="imagem" class="center-block">

			<div class="alert alert-success" id="resposta_correta">
				<?php 
					echo $perguntas[$indice]['resposta_correta'];
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-6">
				<button class="btn btn-success btn-block" onclick="verdade()">
					<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
					 Verdadeira
				</button>
			</div>
			<div class="col-xs-6 col-md-6">
				<button class="btn btn-danger btn-block" onclick="falso()">
					<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
					 Falsa
				</button>
			</div>
		</div>

		<div class="proxima-pergunta">
			<button class="center-block btn btn-md btn-primary" onclick="proximaPergunta()">
				Ir para a Próxima Pergunta <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
			</button>
		</div>


	</div>

	<script type="text/javascript">

		function imprime(valor){
			document.write(valor + "<br><br>");
		}

		//pegando valor da checagem para sabe se a questão é verdadeira ou falsa.
		var valorChecagemDaResposta = document.getElementById('valorChecagem').value;
		//imprime(valorChecagemDaResposta);


		function verdade(){
			verificaResposta("verdadeira", valorChecagemDaResposta);
		}

		function falso(){
			verificaResposta("falsa", valorChecagemDaResposta);
		}

		function proximaPergunta(){
			location.reload();
		}

		function verificaResposta(resposta, valorChecagemDaResposta){

			//imprime(resposta);
			//imprime(valorChecagemDaResposta);

			if (valorChecagemDaResposta == "1" && resposta == "verdadeira") {
				document.getElementById("resposta_correta").style.display = "block";
				document.getElementById("acertou").style.display = "block";
				document.getElementById("errou").style.display = "none";
				document.getElementById("imagem").src = "happy.gif";
			} else if (valorChecagemDaResposta == "0" && resposta == "falsa"){
				document.getElementById("resposta_correta").style.display = "block";
				document.getElementById("acertou").style.display = "block";
				document.getElementById("errou").style.display = "none";
				document.getElementById("imagem").src = "happy.gif";
			} else {
				//document.getElementById("resposta_correta").style.display = "block";
				document.getElementById("errou").style.display = "block";
				document.getElementById("acertou").style.display = "none";
				document.getElementById("imagem").style.height = "100px";
				document.getElementById("imagem").src = "crying.gif";
			}
		}


	</script>

<?php require_once(__DIR__ ."/includes/footer.php"); ?>