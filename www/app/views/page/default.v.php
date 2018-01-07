<h2 class="display-5">Otestujte se online a zdarma</h2>
<p>Pracujete v týmu a zajímá Vás, jaké týmové role jsou pro Vás nejvhodnější?
Vypracujte si Belbinův test týmových rolí a zjistíte, jaké jsou vaše dominantní stránky, a co naopak není Váš šálek kávy.</p>
<p><a class="btn btn-success btn-lg" href="<?=$this->url('test') ?>" role="button">Zahájit test &raquo;</a></p>

<hr>

<?php
	$total_tests_finished = $this->getData('total_tests_finished');

	if ($total_tests_finished > 0) {
		?>
			<div class="row">
				<div class="col-md-6">
					<h2>Statistiky</h2>
					<p>
						K dnešnímu dni byl test vyplněn celkem <strong><?=$total_tests_finished ?></strong>-krát. 
						Vpravo se můžete podívat na celkové zastoupení jednotlivých týmových rolí.
					</p>
					<p><a class="btn btn-primary" href="<?=$this->url('statistiky') ?>" role="button">Více statistik &raquo;</a></p>			
				</div>
				<div class="col-md-6">
					<p>
						<canvas id="statistics_chart"></canvas>
						<script>					
							function initChart() {					
								var options = Chart.defaults.pie;
								options.animation.animateRotate = false;
								options.legend.position = 'bottom';
								
								var myPieChart = new Chart(
									'statistics_chart',
									{
										type: 'pie',
										data: chart_data,
										options: options
									}
								);
							}
							document.body.addEventListener('load', initChart, true);
						</script>
					</p>			
				</div>		
			</div>
		<?php
	} else {
		?>
			<div class="row">
				<div class="col-md-12">
					<h2>Statistiky</h2>					
					<p>Test zatím nebyl vyplněn ani jedenkrát. Poté, co bude test úspěšně dokončem alespoň jedním uživatelem, 
					budou k dispozici <a href="<?=$this->url('statistiky') ?>">statistiky</a>.</p>
				</div>
			</div>
		<?php
	}
?>

<div class="row">
	<div class="col-md-6">
		<h2>Týmové role</h2>
		<p>Belbinův test předpokládá existenci 9 různých týmových rolí, které jsou v různé míře dominanntní v každém členu týmu. Výsledkem testu je míra dominance jednotlivých rolí.</p>
		<p><a class="btn btn-primary" href="<?=$this->url('tymove-role');?>" role="button">Seznam rolí &raquo;</a></p>
	</div>
	<div class="col-md-6">
		<h2>O testu</h2>
		<p>Autorem testu je britský výzkumník a teoretik managementu Meredith Belbin, 
		nejlépe známý pro jeho práci o manažerských týmech.</p>
		<p><a class="btn btn-primary" href="<?=$this->url('o-testu');?>" role="button">Více &raquo;</a></p>
	</div>		
</div>