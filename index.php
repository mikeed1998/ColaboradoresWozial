<?php
	session_start();
	require_once 'includes/connection.php';
	require_once 'includes/login.php';
	require_once 'includes/widgets.php';
	
	// obtenemos el identificador
	if(isset($_GET['identificador'])){ $identificador=$_GET['identificador']; }else{ $identificador=0; }
	//echo $identificador;

	$nav1='';
	$nav2='';
	$nav3='';
	$nav4='';
	$nav5='';
	$nav6='';
	$nav7='';
	$nav8='';
	$nav9='';


// %%%%%%%%%%%%%%      IMPORTANTE      %%%%%%%%%%%%%%%% //
//                                                      //
//       PONER EL DETALLE EN EL IDENTIFICADOR 15        //
//                                                      //
// %%%%%%%%%%%%%%      IMPORTANTE      %%%%%%%%%%%%%%%% //
	
switch ($identificador) {
	// Inicio en default


	// Detalle de producto
	case 15:
		// Importante poner los valores del SEO
		// title, description y picOg 
		$nav3='uk-active';
		$id=$_GET['id'];
		$CONSULTA = $CONEXION -> query("SELECT * FROM productos WHERE id = $id");
		$numProds=$CONSULTA->num_rows;
		$rowCONSULTA = $CONSULTA -> fetch_assoc();
		$titulo=html_entity_decode($rowCONSULTA['titulo']);
		$idServicio = $rowCONSULTA['servicio'];
		$empresa = $rowCONSULTA['empresa'];
		$txt = nl2br($rowCONSULTA['txt']);
		$imagen = $rowCONSULTA['imagen'];
		$telefonoW = $rowCONSULTA['whatsapp'];
		$url = $rowCONSULTA['url'];

		$title=(strlen($rowCONSULTA['title'])>0)?html_entity_decode($rowCONSULTA['title']):html_entity_decode($rowCONSULTA['titulo']);
		$description=(strlen($rowCONSULTA['metadescription'])>0)?html_entity_decode($rowCONSULTA['metadescription']):$description;
		$linkTwitter='<a href="https://twitter.com/intent/tweet?button_hashtag=GrupoAga '.str_replace('+', '-', $rutaEstaPagina).'" class="uk-icon-button uk-button-default" data-lang="es" data-show-count="false" uk-icon="twitter"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';

		$picOg='img/design/logo-og.jpg';
		$consultaPIC = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden LIMIT 1");
		$numPics=$consultaPIC->num_rows;
		if ($numPics>0) {
			$row_consultaPIC = $consultaPIC -> fetch_assoc();
			$picOgRuta='img/contenido/productos/';
			$picOg=$picOgRuta.$row_consultaPIC['id'].'.jpg';
		}
		include 'includes/includes.php';
		include 'pages/detalle.php';
		break;










	// Buscar
	case 910:
		if(isset($_GET['consulta'])){ $consulta=$_GET['consulta']; }else{ header('Location: '.$ruta); }
		include "includes/includes.php";
		include 'pages/search.php';
		break;


	case 990:
		session_destroy();
		include "includes/includes.php";
		header('location: salir');
		break;

	case 991:
		$nav1='uk-active';
		$mensaje='Hasta pronto';
		$mensajeClase='success';
		include "includes/includes.php";
		$scriptGNRL.='<script> setTimeout(function(){ window.location = ("'.$ruta.'"); },2000); </script>';
		include 'pages/inicio.php';
		break;

	case 994:
		include "includes/includes.php";
		include 'includes/humans.php';
		break;

	case 995:
		include "includes/includes.php";
		include 'includes/google-verify.php';
		break;

	case 996:
		include "includes/includes.php";
		include 'includes/robots.php';
		break;

	case 997:
		include "includes/includes.php";
		include 'includes/sitemap.php';
		break;

	case 998:
		include "includes/includes.php";
		include 'pages-cart/faq.php';
		break;

	case 999:
		$id=$_GET['id'];
		include "includes/includes.php";
		include 'pages-cart/politicas.php';
		break;

	default:
		$nav1='uk-active';
		include "includes/includes.php";	
		include 'pages/inicio.php';
		break;
}


mysqli_close($CONEXION);
if (file_exists('error_log')) {
	unlink('error_log');
}

