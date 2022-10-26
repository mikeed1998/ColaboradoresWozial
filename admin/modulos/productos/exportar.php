<?php
header('Content-Type: text/csv; charset=utf-8');
require_once('../../../includes/connection.php'); 

$caracteres_no_validos  = array('|','"','®','¿','á','Á','é','É','í','Í','ó','Ó','ú','Ú','ñ','Ñ');
$caracteres_si_validos  = array('',  '', '', '', 'a','A','e','E','i','I','o','O','u','U','n','N');

$conSalto  = array("\r", "\n", ",");
$sinSalto  = array("",   "",   " ");

$csv = '"No. categoría","SKU","Título","Descripción","Título google","Descripción de google","Precio","Existencias"';


$CONULTA = $CONEXION -> query("SELECT * FROM productos");
while ($rowCONSULTA = $CONULTA -> fetch_assoc()) {

	$csv .= '
"'.str_replace($conSalto,$sinSalto,$rowCONSULTA['categoria']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['edad']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['titulo']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['txt']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['title']).'","'.str_replace($conSalto,$sinSalto, $rowCONSULTA['metadescription']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['precio']).'","'.str_replace($conSalto,$sinSalto,$rowCONSULTA['existencias']).'"';

}
echo str_replace($caracteres_no_validos,$caracteres_si_validos,$csv);