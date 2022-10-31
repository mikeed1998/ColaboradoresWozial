<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/js/uikit.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/js/uikit-icons.min.js"></script>
</head>
<body>

<?php
	$connect = mysqli_connect("localhost", "root", "", "colaboradores");

	$caracteres_si_validos  = array('',' ','','','','','','','','','a','A','e','E','i','I','o','O','u','U','n','N');
	$caracteres_no_validos  = array('%','  ',',','_','|','/','®','¿','"',':','á','Á','é','É','í','Í','ó','Ó','ú','Ú','ñ','Ñ');

	function wordlimit($string, $length , $ellipsis) {
    	$words = explode(' ', strip_tags($string));
    	if (count($words) > $length) {
      		return implode(' ', array_slice($words, 0, $length)) ." ". $ellipsis;
    	} else {
      		return $string;
    	}
	}

	function mostarDatos($a, $b, $c, $d, $e, $f, $g, $h, $i) {
		//var_dump($a);
		
		$output = '';
		$output.='
		
		<ul class="js-filter uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center" uk-grid>
	 		<li data-servicio="'.$a.'" class="card-principal">
	 			<div uk-grid class="uk-grid-collapse" style="padding-top: 80px">
	 				<div class="uk-width-expand bg-white uk-text-center padding-top-20">
	 			  	</div>
	 			  	<div class="uk-width-auto uk-position-relative">
	 				  	<img src="img/design/testimonios-circulo.png" style="width: 150px;" alt="">
	 				  	<div class="uk-position-top-center" style="top:-65px; background: white; border-radius: 50%; height: 124px; width: 124px; overflow: hidden;">
	 						<img src="img/contenido/productos/'. $b .'" alt="" uk-cover>
	 				  	</div>
	 			  	</div>
	 				<div class="uk-width-expand bg-white uk-text-center padding-top-20">
	 			  	</div>
	 			</div>
	 			<div class="bg-white testimonios-card">
	 			  	<div class="testimonios-nombre">
	 					'.$c.'
	 			  	</div>
	 			  	<div class="testimonios-ramo uk-text-uppercase">
	 					'.$d.'
	 			  	</div>
	 			  	<div class="testimonios-texto">
	 			  		'.wordlimit($e ,'20','...').'
	 				</div>
	 			  	<div uk-grid class="padding-bottom-10 padding-top-20">
	 					<div class="uk-width-expand uk-text-left">
	 					  	<a target="_blank" href="https:wa.me/521'.$f.'?text=Me%20gustaría%20saber%20..." class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:whatsapp; ratio: .8"></a> &nbsp;
	 					  	<a target="_blank" href="'.$g.'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:facebook; ratio: .8"></a> &nbsp;
	 					  	<a target="_blank" href="'.$h.'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:instagram; ratio: .8"></a>
	 					</div>
	 					<div class="uk-width-auto testimonios-proyectos uk-flex uk-flex-middle">
	 						<a href="'.$i.'">
	 							Ver más <span class="color-negro" uk-icon="icon: arrow-right; ratio: .8"></span>
	 						</a>
	 					</div>
	 			  	</div>
	 			</div>
	 		</li>
		</ul>
		
		';
	
		echo $output;
	}

	if(isset($_POST["query"]))
	{
		$search = mysqli_real_escape_string($connect, $_POST["query"]);
		$query = "SELECT * FROM productos WHERE txt LIKE '%".$search."%'";
	
		$result = mysqli_query($connect, $query);

		while ($rowCONSULTA = $result->fetch_assoc()) {
			// var_dump($rowCONSULTA['titulo']);
			$id = $rowCONSULTA['id'];
			$idEmpresa = $rowCONSULTA['empresa'];
			$idServicio = $rowCONSULTA['servicio'];
			$whatsapp = $rowCONSULTA['whatsapp'];
			$urlTitulo = urlencode(str_replace($caracteres_no_validos, $caracteres_si_validos, html_entity_decode(strtolower($rowCONSULTA['titulo']))));
			$link = $id.'_'.$urlTitulo.'-.html';

			$queryS = "SELECT s.id, s.titulo FROM servicios as s INNER JOIN productos as p ON s.id = p.servicio";
			$serviciosS = mysqli_query($connect, $queryS);

			while($rowS = $serviciosS->fetch_assoc()) {
				if($idServicio == $rowS['id']) {
					$nombreServicio = $rowS['titulo'];
					break;
				}
			}

			$imagen = $rowCONSULTA['imagen']; 
		
			$final = '';
			$final .= '

				'. mostarDatos($nombreServicio, $rowCONSULTA['imagen'], $rowCONSULTA['titulo'], $rowCONSULTA['empresa'], $rowCONSULTA['txt'], $rowCONSULTA['whatsapp'], $rowCONSULTA['facebook'], $rowCONSULTA['instagram'], $link) .'
			
				';
	
			echo $final;
		}
	}
?>


</body>
</html>


<?php
	/*

	else
{
	$query = "SELECT * FROM productos ORDER BY empresa";

	$result = mysqli_query($connect, $query);

	while ($rowCONSULTA = $result->fetch_assoc()) {
		// var_dump($rowCONSULTA['titulo']);
		$id = $rowCONSULTA['id'];
		$idEmpresa = $rowCONSULTA['empresa'];
		$idServicio = $rowCONSULTA['servicio'];
		$whatsapp = $rowCONSULTA['whatsapp'];
		$urlTitulo = urlencode(str_replace($caracteres_no_validos, $caracteres_si_validos, html_entity_decode(strtolower($rowCONSULTA['titulo']))));
		$link = $id.'_'.$urlTitulo.'-.html';

		
		$queryS = "SELECT s.id, s.titulo FROM servicios as s INNER JOIN productos as p ON s.id = p.servicio";
		$serviciosS = mysqli_query($connect, $queryS);
		
		while($rowS = $serviciosS->fetch_assoc()) {
			if($idServicio == $rowS['id']) {
				$nombreServicio = $rowS['titulo'];
			}
		}

		$imagen = $rowCONSULTA['imagen']; 
		
		$final = '';
		$final .= '
			<ul class="js-filter uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center" uk-grid>
			'. mostarDatos($nombreServicio, $rowCONSULTA['imagen'], $rowCONSULTA['titulo'], $rowCONSULTA['empresa'], $rowCONSULTA['txt'], $rowCONSULTA['whatsapp'], $rowCONSULTA['facebook'], $rowCONSULTA['instagram'], $link) .'
			</ul>
		';
	
		echo $final;
	}
}


	//	$CONSULTASERV = $result->query("SELECT * FROM servicios WHERE id = $idServicio");
		// 	$rowCONSULTASERV = $CONSULTASERV -> fetch_assoc();
		// 	$nombreServicio = $rowCONSULTASERV['titulo'];
	 	// $nombreServicio = '';

	$output.='
		<ul class="js-filter uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center" uk-grid>
			<li data-servicio="'.$nombreServicio.'" class="card-principal">
				<div uk-grid class="uk-grid-collapse" style="padding-top: 80px">
					<div class="uk-width-expand bg-white uk-text-center padding-top-20">
				  	</div>
				  	<div class="uk-width-auto uk-position-relative">
					  	<img src="img/design/testimonios-circulo.png" style="width: 150px;" alt="">
					  	<div class="uk-position-top-center" style="top:-65px; background: white; border-radius: 50%; height: 124px; width: 124px; overflow: hidden;">
							<img src="img/contenido/productos/'. $rowCONSULTA['imagen'] .'" alt="" uk-cover>
					  	</div>
				  	</div>
					<div class="uk-width-expand bg-white uk-text-center padding-top-20">
				  	</div>
				</div>
				<div class="bg-white testimonios-card">
				  	<div class="testimonios-nombre">
						'.$rowCONSULTA['titulo'].'
				  	</div>
				  	<div class="testimonios-ramo uk-text-uppercase">
						'.$rowCONSULTA['empresa'].'
				  	</div>
				  	<div class="testimonios-texto">
				  		'.wordlimit($rowCONSULTA['txt'] ,'20','...').'
					</div>
				  	<div uk-grid class="padding-bottom-10 padding-top-20">
						<div class="uk-width-expand uk-text-left">
						  	<a target="_blank" href="https://wa.me/521'.$whatsapp.'?text=Me%20gustaría%20saber%20..." class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:whatsapp; ratio: .8"></a> &nbsp;
						  	<a target="_blank" href="'.$rowCONSULTA['facebook'].'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:facebook; ratio: .8"></a> &nbsp;
						  	<a target="_blank" href="'.$rowCONSULTA['instagram'].'" class="uk-icon-button" style="height: 20px; width: 20px;" uk-icon="icon:instagram; ratio: .8"></a>
						</div>
						<div class="uk-width-auto testimonios-proyectos uk-flex uk-flex-middle">
							<a href="'.$link.'">
								Ver más <span class="color-negro" uk-icon="icon: arrow-right; ratio: .8"></span>
							</a>
						</div>
				  	</div>
				</div>
			</li>
		</ul>'; 




	echo '
		<ul class="uk-subnav uk-subnav-pill uk-flex uk-flex-center">
			<li class="uk-active" uk-filter-control>
				<a href="#">
					Todos
				</a>
			</li>
	';

	$serv = $connect->query("SELECT * FROM servicios ORDER BY titulo");
	while ($rowSERV = $serv->fetch_assoc()) {
		$titulo = $rowSERV['titulo'];
		echo '
			<li uk-filter-control="[data-servicio='. $titulo .']">
				<a href="#">
					'. $titulo .'
				</a>
			</li>
		';
	}
	
	echo '
		</ul>
	';
	*/
?>