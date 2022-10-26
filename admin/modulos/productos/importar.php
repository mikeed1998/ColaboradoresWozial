<?php
echo '
	<div class="uk-width-auto margin-v-20">
		<ul class="uk-breadcrumb uk-text-capitalize">
			<li><a href="index.php?rand='.rand(1,1000).'&carpeta='.$carpeta.'">Productos</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&carpeta='.$carpeta.'&archivo=importar" class="color-red">Importar</a></li>
		</ul>
	</div>
	<div class="uk-width-expand@m margin-v-20">
		<div uk-grid class="uk-flex-right">
			<div>
				<button class="uk-button uk-button-default color-red" id="eliminatodo"><i uk-icon="trash"></i> &nbsp; Borrar todo</button>
			</div>
			<div>
				<a href="modulos/productos/exportar.php" class="uk-button uk-button-primary" targer="_blank" download="productos.csv"><i uk-icon="download"></i> &nbsp; Exportar</a>
			</div>
		</div>
	</div>
';
?>


<div class="uk-width-1-1">
</div>

<div class="uk-width-1-2@m margin-v-50">
	<div id="fileuploader">
		Cargar
	</div>
</div>

<div class="uk-width-1-2@m margin-v-50">
	El archivo debe ser formato CSV<br>
	CSV = Valores separados por comas<br>
	No se deben poner comas adicionles dentro de los campos
</div>

<div class="uk-width-1-1">
	<p>Ejemplo:</p>
	<p>
		No. categoría,SKU,Título español,Descripción español,Título google español,Descripción de google español,Título inglés,Descripción inglés,Título google inglés,Descripción de google inglés<br>
		1,PROD001,Refrigerador de 15 pies cúbicos,Refrigerador marca Whirlpool con capacidad de 15 pies cúbicos,Refrigerador de 15 pies en venta,Refrigerador marca Whirlpool con capacidad de 15 pies cúbicos,15 cubic foot refrigerator,Whirlpool brand refrigerator with 15 cubic feet capacity,15 foot refrigerator for sale,Whirlpool brand refrigerator with capacity of 15 cubic feet
	</p>
	<a href="../img/contenido/importar/ejemplo.csv" download class="uk-button uk-button-white"><i class="fa fa-download"></i> Ejemplo</a>
</div>

<div id="errormessage" class="uk-width-1-1">
	<div class="uk-alert-danger" uk-alert>
		<a class="uk-alert-close" uk-close></a>
		<p>Ocurrió un error.<br>Revise la sintaxis de su archivo</p>
	</div>
</div>

<?php
if (isset($showTable)) {
	echo '
	<div class="uk-width-1-1">
		<div class="uk-margin uk-text-center">
			<a href="index.php?rand='.rand(1,1000).'&carpeta=productos&archivo=importar&importardatos&file='.$fileFinal.'" class="continuebutton uk-button uk-button-primary uk-hidden">Continuar</a>
		</div>
		<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle uk-text-center" id="ordenar">
			<thead>
				<tr>
					<th class="pointer uk-text-center" onclick="sortTable(0)">No. categoría</th>
					<th class="pointer uk-text-center" onclick="sortTable(1)">SKU</th>
					<th class="pointer uk-text-center" onclick="sortTable(2)">Título</th>
					<th class="pointer uk-text-center" onclick="sortTable(3)">Descripción</th>
					<th class="pointer uk-text-center" onclick="sortTable(4)">Título google</th>
					<th class="pointer uk-text-center" onclick="sortTable(5)">Descripción de google</th>
					<th class="pointer uk-text-center" onclick="sortTable(6)">Precio</th>
					<th class="pointer uk-text-center" onclick="sortTable(7)">Existencias</th>
				</tr>
			</thead>
			<tbody>';
	foreach ($infoImportar as $key => $value) {
		$CONSULTA = $CONEXION -> query("SELECT * FROM $carpetacat WHERE id = $value[0]");
		$rowCONSULTA = $CONSULTA -> fetch_assoc();

		$catName = $rowCONSULTA['txt'];
		$rowError = '';

		$bg = ($rowCONSULTA['parent']==0)?'bg-red color-white':'';
		$bg = (!isset($value[8]))?'bg-red color-white':$bg;
		$bg = ( isset($value[9]))?'bg-red color-white':$bg;

		$rowError .= ($rowCONSULTA['parent']==0)?'<br>El producto '.$value[1].' tiene mal la categoría':'';
		$rowError .= (!isset($value[8]))?'<br>Al producto '.$value[1].' le faltan celdas':'';
		$rowError .= ( isset($value[9]))?'<br>Al producto '.$value[1].' le sobran celdas':'';

		if (strlen($rowError)>0) {
			$dontConinue=1;
			echo '
				<tr>
					<td colspan="30" class="bg-red color-white text-xl uk-text-left">
						'.$rowError.'
						<div style="width:0;overflow:hidden;">
							<input type="text" autofocus>
						</div>
					</td>
				</tr>';
		}

		echo "
				<tr>
					<td class='$bg'>$catName</td>
					<td class='$bg'>$value[1]</td>
					<td class='$bg'>$value[2]</td>
					<td class='$bg'>$value[3]</td>
					<td class='$bg'>$value[4]</td>
					<td class='$bg'>$value[5]</td>
					<td class='$bg'>$value[6]</td>
					<td class='$bg'>$value[7]</td>
					<td class='$bg'>$value[8]$value[9]$value[10]$value[11]$value[12]$value[13]$value[14]</td>
				</tr>";
	}
	echo '
			</tbody>
		</table>
	</div>';
}




$scripts.='
	$(document).ready(function() {
		$("#fileuploader").uploadFile({
			url:"../library/upload-file/php/upload.php",
			fileName:"myfile",
			maxFileCount:1,
			showDelete: \'false\',
			allowedTypes: "csv",
			maxFileSize: 9999999,
			showFileCounter: false,
			showPreview:false,
			returnType:\'json\',
			onSuccess:function(data){ 
				window.location = (\'index.php?rand='.rand(1,1000).'&carpeta='.$carpeta.'&archivo='.$archivo.'&csvfile=\'+data);
			}
		});

		// Eliminar todo los productos
		$("#eliminatodo").click(function() {
			UIkit.modal.confirm("Desea borrar todos los productos?").then(function () {
				var statusConfirm2 = confirm("Perdona la insistencia, pero es muy importante. Estás a punto de borrar todos los productos. Estás seguro?"); 
				if (statusConfirm2 == true) {
					$.post("modulos/'.$carpeta.'/acciones.php",{
						borrartodoslosproductos: 1
					},function(msg){
						datos = JSON.parse(msg);
						UIkit.notification.closeAll();
						UIkit.notification(datos.msg);
					});
				}
			}, function () {
				console.log("Rejected.")
			});
		});

		';

		if (!isset($dontConinue)) {
			$scripts.= '
			$(".continuebutton").removeClass("uk-hidden");
			$("#errormessage").remove();
			';
		}
	$scripts.= '
	});
	';



?>