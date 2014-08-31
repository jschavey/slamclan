<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" data-toggle="collapse" data-target="#seasons">
        	Season Heroes: <?= number_format( $seasons ) ?>
      	</h1>
    </div>

    <div id="seasons" class="collapse panel-body">
   		<? foreach( $heroes as $hero ): ?>
  			<? if( $hero->seasonal ): ?>
		      	<div class="row">
		      		<div class="col-md-2">
		               <?= $hero->battleTag ?>
		            </div>

		            <div class="col-md-2">
		            	<?= $hero->class ?>
		            </div>
		      				
		      		<div class="col-md-8">
		   	  			<div class="progress">
		      				<div class="progress-bar" role="progressbar" aria-valuenow="<?= $hero->level / 70 * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $hero->level / 70 * 100 ?>%;">
		          			   <span class="sr-only"><?= $hero->level / 70 * 100 ?>% Complete</span>
		      				</div>
		   				</div>
		      		</div>
		      	</div>
		    <? endif ?>
      	<? endforeach ?>
   </div>
</div>