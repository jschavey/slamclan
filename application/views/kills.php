<div id="container">
   <h1>Lifetime Kills: <?= $kills ?></h1>

   <div id="body">
   		<? foreach( $careers as $career ) : ?>
   			<div id="container">
   				<h1><?= $career->battleTag ?></h1>
   				
   				<div id="body">
		   			<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?= $career->kills->monsters / $kills * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $career->kills->monsters / $kills * 100 ?>%;">
						    <span class="sr-only"><?= $career->kills->monsters / $kills * 100 ?>% Complete</span>
						</div>
					</div>
   				</div>
   			</div>
   		<? endforeach ?>
   </div>

   <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>