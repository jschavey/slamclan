<div class="panel panel-default">
   <div class="panel-heading">
      <h1 class="panel-title" data-toggle="collapse" data-target="#paragon">
         Total Paragon: <?= number_format( $paragon ) ?>
      </h1>
   </div>

   <div id="paragon" class="collapse panel-body">
      <div class="alert alert-danger" role="alert">
         Paragon API broken by 2.1 patch
      </div>

      <? foreach( $careers as $career ) : ?>
      	<div class="row">
      		<div class="col-md-2">
               <?= $career->battleTag ?>
            </div>
      				
      		<div class="col-md-10">
   	  			<div class="progress">
      				<div class="progress-bar" role="progressbar" aria-valuenow="<?= ( $paragon ) ? ($career->paragonLevel / $paragon * 100) : 0 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= ( $paragon ) ? ($career->paragonLevel / $paragon * 100) : 0 ?>%;">
          			   <span class="sr-only"><?= ( $paragon ) ? ($career->paragonLevel / $paragon * 100) : 0 ?>% Complete</span>
      				</div>
   				</div>
      		</div>
      	</div>
      <? endforeach ?>
   </div>
</div>