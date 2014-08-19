<div class="panel panel-default">
   <div class="panel-heading">
      <h1 class="panel-title" data-toggle="collapse" data-target="#paragon">
         Total Paragon: <?= number_format( $paragon ) ?>
      </h1>
   </div>

   <div id="paragon" class="collapse panel-body">
      <div id="body">
      		<? foreach( $careers as $career ) : ?>
      			<div class="row">
      				<div class="col-md-2">
                     <?= $career->battleTag ?>
                  </div>
      				
      				<div class="col-md-10">
   		   			<div class="progress">
   						<div class="progress-bar" role="progressbar" aria-valuenow="<?= $career->paragonLevel / $paragon * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $career->paragonLevel / $paragon * 100 ?>%;">
   						    <span class="sr-only"><?= $career->paragonLevel / $paragon * 100 ?>% Complete</span>
   						</div>
   					</div>
      				</div>
      			</div>
      		<? endforeach ?>
      </div>
   </div>
</div>