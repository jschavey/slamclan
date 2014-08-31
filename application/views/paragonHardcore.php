<div class="panel panel-danger">
   <div class="panel-heading">
      <h1 class="panel-title" data-toggle="collapse" data-target="#paragonHardcore">
         Total Hardcore Paragon: <?= number_format( $paragonHardcore ) ?>
      </h1>
   </div>

   <div id="paragonHardcore" class="collapse panel-body">
      <? foreach( $careers as $career ) : ?>
         <? if( $career->paragonLevelHardcore ): ?>
         	<div class="row">
         		<div class="col-md-2">
                  <?= $career->battleTag ?>
               </div>
         				
         		<div class="col-md-10">
      	  			<div class="progress">
         				<div class="progress-bar" role="progressbar" aria-valuenow="<?= ( $paragon ) ? ($career->paragonLevelHardcore / $paragonHardcore * 100) : 0 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= ( $paragon ) ? ($career->paragonLevelHardcore / $paragonHardcore * 100) : 0 ?>%;">
             			   <span class="sr-only"><?= ( $paragon ) ? ($career->paragonLevelHardcore / $paragonHardcore * 100) : 0 ?>% Complete</span>
         				</div>
      				</div>
         		</div>
         	</div>
         <? endif ?>
      <? endforeach ?>
   </div>
</div>