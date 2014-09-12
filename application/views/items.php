<? foreach( $items as $item ): ?>
<?
switch( $item->displayColor )
{
	case 'orange':
		$class = 'danger';
		break;
	case 'green':
		$class = 'success';
		break;
	case 'blue':
		$class = 'info';
		break;
	case 'yellow':
		$class = 'warning';
		break;
	default:
		$class = 'default';
		break;
}
?>

	<div class="panel panel-<?= $class ?>">
		<div class="panel-heading">
			<h1 class="panel-title"><?= $item->name ?></h1>
		</div>
		<div class="panel-body">
			<? foreach( $item->attributes as $category ): ?>
				<? foreach( $category as $attribute ): ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title"><?= $attribute->text ?></h1>
						</div>
					</div>
				<? endforeach ?>
			<? endforeach ?>
		</div>
	</div>
	<? #print_r( $item ) ?>
<? endforeach ?>