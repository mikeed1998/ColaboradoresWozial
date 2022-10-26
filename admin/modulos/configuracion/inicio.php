<?php
$archivoes[] = array(
	  'title' => 'Contacto',
    'archivo' => 'contacto',
	   'icon' => 'envelope');

$archivoes[] = array(
	  'title' => 'FAQ',
    'archivo' => 'faq',
	   'icon' => 'question');

$archivoes[] = array(
	  'title' => 'Generales',
    'archivo' => 'general',
	   'icon' => 'cogs');

$archivoes[] = array(
	  'title' => 'Políticas',
    'archivo' => 'politicas',
	   'icon' => 'info');


$archivoes[] = array(
	  'title' => 'Usuarios',
    'archivo' => 'usuarios',
	   'icon' => 'users');


echo '
<div class="uk-width-auto@m margin-top-20">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'" class="color-red">Configuración</a></li>
	</ul>
</div>




<div class="uk-width-1-1">
	<div class="uk-container">
		<div uk-grid class="uk-flex-center uk-grid-small" style="margin-top: 30px;">';

		foreach ($archivoes as $key => $value) {
			echo '
			<div class="uk-width-auto">
				<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$value['archivo'].'">
					<div class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle uk-text-center uk-text-capitalize" style="width: 180px;height: 180px;">
						<div>
							<i class="fa fa-3x fa-'.$value['icon'].'"></i>
							<br><br>
							'.$value['title'].'
						</div>
					</div>
				</a>
			</div>';
		}

	echo '
		</div>
	</div>
</div>';



