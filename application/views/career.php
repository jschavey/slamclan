<!--
<pre>
	<? print_r( $career ) ?>
</pre>
-->
<!--
<? foreach( $career->heroes as $hero ) : ?>
	<? print_r( $hero ) ?>
<? endforeach ?>
-->

<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="panel-title"><?= $career->battleTag ?></h1>
	</div>

	<div class="panel-body">
		Paragon Level: <?= $career->paragonLevel ?>
		Kills: <?= $career->kills->monsters ?>
	</div>
</div>