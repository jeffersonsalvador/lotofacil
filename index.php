<?php
ini_set('display_erros', true);
require __DIR__ . '/vendor/autoload.php';
use JSC\Lotofacil\Sorteio;

$soteados = [];
if (isset($_GET['sorteio'])) {
		$sorteados = $_GET['sorteio'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sorteio Lotofacil</title>
	<!-- Bootstrap -->
    <link href="assets/components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/default.css" rel="stylesheet">
</head>
<body>
	<?php
	$fixos = [1, 2, 6];
	$fora = [4, 21];
	$obSorteio = new Sorteio($fixos, $fora);
	?>
	<div class="container">
		<h1>Sorteio Lotofácil</h1>
		<div class="col-md-8">
			<?php $obSorteio->getApostas($random = true, $sorteados); ?>
		</div>
		<div class="col-md-4">
			<strong>Escolha 03 números mais sorteados nos últimos 10 sorteios</strong>
			<h4><?= $obSorteio->getMaisSorteados(); ?></h4>
			<strong>02 números menos sorteados nos últimos 10 sorteios</strong>
			<h4><?= $obSorteio->getMenosSorteados(); ?></h4>

			<fieldset>
				<legend> Conferir resultado </legend>
				<?php echo (isset($_GET['sorteio'])) ? implode(', ', $_GET['sorteio']) : ''; ?>
				<form action="<?php $_SERVER['PHP_SELF']; ?>">
					<!--<textarea name="sorteio" class="form-control" rows="10"></textarea>-->
					<div data-toggle="buttons">
					<?php for($x=1; $x<=25; $x++): ?>
						<label class="btn btn-success resultado">
							<input type="checkbox" name="sorteio[]" value="<?= $x; ?>"><?php echo str_pad($x, 2, 0, STR_PAD_LEFT); ?>
						</label>
					<?php endfor; ?>
				</div>
					<input type="submit" value="Consultar" class="btn btn-primary">
				</form>
			</fieldset>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/components/jquery/dist/jquery.min.js"></script>
    <script src="assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
