

<div class="uk-width-expand margin-top-20">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<?php 
		echo '
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'" class="color-red">'.$modulo.'</a></li>
		';
		?>

	</ul>
</div>

<div class="uk-width-auto margin-top-20">
	<div>
		<a href="index.php?rand=<?=rand(1,1000)?>&modulo=<?=$modulo?>&archivo=nuevo" class="uk-button uk-button-success"><i uk-icon="icon: plus;ratio:1.4"></i> &nbsp; Nuevo</a>
	</div>
</div>

<div class="uk-width-1-1 margin-v-50">
	<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle uk-table-responsive" id="ordenar">
		<thead>
			<tr class="uk-text-muted">
				<th width="90px"></th>
				<th onclick="sortTable(0)">Titulo</th>
				<th width="120px" onclick="sortTable(1)">Color</th>
				<th width="120px"></th>
			</tr>
		</thead>
		<tbody class="sortable" data-tabla="<?=$modulo?>">
		<?php
		$consulta1 = $CONEXION -> query("SELECT * FROM $modulo ORDER BY orden");
		while ($row_Consulta1 = $consulta1 -> fetch_assoc()) {
			$prodID=$row_Consulta1['id'];
			
			$picTxt='';
			$pic=$rutaFinal.$row_Consulta1['imagen'];
			if(strlen($row_Consulta1['imagen'])>0 AND file_exists($pic)){
				$picTxt='
					<div class="uk-inline">
						<i uk-icon="camera"></i>
						<div uk-drop="pos: right-justify">
							<img src="'.$pic.'" class="uk-border-rounded">
						</div>
					</div>';
			}elseif(strlen($row_Consulta1['imagen'])>0 AND strpos($row_Consulta1['imagen'], 'ttp')>0){
				$pic=$row_Consulta1['imagen'];
				$picTxt= '
					<div class="uk-inline">
						<i uk-icon="camera"></i>
						<div uk-drop="pos: right-justify">
							<img src="'.$pic.'" class="uk-border-rounded">
						</div>
					</div>';
			}

			$link='index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$row_Consulta1['id'];

			$estatusIcon=($row_Consulta1['estatus']==1)?'off uk-text-muted':'on uk-text-primary';

			echo '
			<tr id="'.$row_Consulta1['id'].'">
				<td>
					'.$picTxt.'
				</td>
				<td>
					<input type="text" class="uk-input selector uk-form-blank" data-tabla="'.$modulo.'" data-campo="titulo" data-id="'.$row_Consulta1['id'].'" name="titulo" value="'.$row_Consulta1['titulo'].'">
				</td>
				<td>
					<input id="color-input" type="text" class="uk-input selector" data-tabla="'.$modulo.'" data-campo="color" data-id="'.$row_Consulta1['id'].'" name="color" value="'.$row_Consulta1['color'].'" style="background-color: '.$row_Consulta1['color'].'; color: white;">
				</td>
				<td class="uk-text-center">
					<!--<button data-id="'.$row_Consulta1['id'].'" class="eliminaprod uk-icon-button uk-button-danger" tabindex="1" uk-icon="icon:trash"></button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
					<a href="'.$link.'" class="uk-icon-button uk-button-primary" uk-icon="search"></a>
				</td>
			</tr>';
		}
		?>

		</tbody>
	</table>
</div>

<?php 
$scripts='
	// Eliminar producto
	$(".eliminaprod").click(function() {
		var id = $(this).attr(\'data-id\');
		var statusConfirm = confirm("Realmente desea eliminar este Producto?"); 
		if (statusConfirm == true) { 
			window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&borrarProd&id="+id);
		} 
	});

	$(document).ready(function() {
	     $("#color-input").change(function(){
	     	var color = $(this).val();
	     	console.log(color);
			$(this).css("background-color",color);
	     });
	     $("#color-input2").change(function(){
	     	var color = $(this).val();
	     	console.log(color);
			$(this).css("background-color",color);
	     });
	     $("#color-input3").change(function(){
	     	var color = $(this).val();
	     	console.log(color);
			$(this).css("background-color",color);
	     });
	});

	';
?>

