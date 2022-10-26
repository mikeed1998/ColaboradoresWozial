<?php 
	$consulta = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
	$rowConsultaItem = $consulta -> fetch_assoc();

	$fechaSQL=$rowConsultaItem['fecha'];
	$segundos=strtotime($fechaSQL);
	$fechaUI=date('m/d/Y',$segundos);


// BREADCRUMB
	echo '
	<div class="uk-width-auto margin-v-20">
		<ul class="uk-breadcrumb uk-text-capitalize">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Proyecto</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'" class="color-red">'.$rowConsultaItem['titulo'].'</a></li>
		</ul>
	</div>';

// BOTONES SUPERIORES
	echo '
	<div class="uk-width-expand@xl margin-v-20">
		<div uk-grid class="uk-grid-small uk-flex-right">
			<div>
				<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=editar&id='.$id.'" class="uk-button uk-button-primary"><i uk-icon="pencil"></i> &nbsp; Editar</a>
			</div>
			<div>
				<button data-id="'.$rowConsultaItem['id'].'" class="eliminaprod uk-button uk-button-danger" tabindex="1"><i uk-icon="trash"></i> &nbsp; Eliminar</button> 
			</div>
			<div>
				<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=nuevo&cat='.$cat.'" class="uk-button uk-button-success"><i uk-icon="plus"></i> &nbsp; Nuevo</a>
			</div>
		</div>
	</div>';

// INFO DEL PRODUCTO
	echo '
	<div uk-grid class="uk-width-1-1">
		<div class="uk-width-1-2@s margin-bottom-20">
			<div class="uk-card uk-card-default uk-card-body">
				<div>
					<span class="uk-text-capitalize uk-text-muted">titulo:</span>
					'.$rowConsultaItem['titulo'].'
				</div>
				<div class="padding-top-20">
					<span class="uk-text-capitalize uk-text-muted">Facebook:</span>
					'.$rowConsultaItem['facebook'].'
				</div>
				<div>
					<span class="uk-text-capitalize uk-text-muted">Instagram:</span>
					'.$rowConsultaItem['instagram'].'
				</div>
				<div>
					<span class="uk-text-capitalize uk-text-muted">whatsapp:</span>
					'.$rowConsultaItem['whatsapp'].'
				</div>
				<div>
					<span class="uk-text-capitalize uk-text-muted">Página Web:</span>
					'.$rowConsultaItem['url'].'
				</div>
				<div class="uk-margin bordered">
					<span class="uk-text-capitalize uk-text-muted">Descripción:</span>

					'.$rowConsultaItem['txt'].'
				</div>
				<div class="uk-width-1-1 uk-text-right">
					<span class="uk-text-muted">Fecha de captura:</span>
					'.$fechaUI.'
				</div>
			</div>
		</div>
		<div class="uk-width-1-2@s">
			<div class="uk-card uk-card-default uk-card-body">
				<div class="uk-width-1-1">
					<h4>SEO</h4>
					<span class="uk-text-capitalize uk-text-muted">titulo google:</span>
					'.$rowConsultaItem['title'].'
				</div>
				<div class="uk-width-1-1">
					<span class="uk-text-capitalize uk-text-muted">descripción google:</span>
					'.$rowConsultaItem['metadescription'].'
				</div>
			</div>
		</div>
	</div>
		';

// IMAGEN PRINCIPAL
		echo '	
		<div uk-grid class="uk-width-1-1">	
			<div class="uk-width-1-2@s uk-text-center margin-v-20">
				<div>
					<h3 class="uk-text-center">Imagen de principal</h3>
				</div>
				<div class="uk-width-1-1">
					<div class="margin-bottom-50 uk-text-muted">
						Medidas recomendadas: <br> 400 px de ancho 400 px de alto
					</div>
					<div id="fileuploadermain">
						Cargar
					</div>
				</div>
			</div>
			<div class="uk-width-1-2@s uk-text-center margin-v-20">';

			$pic='../img/contenido/'.$modulo.'/'.$rowConsultaItem['imagen'];
			if(strlen($rowConsultaItem['imagen'])>0 AND file_exists($pic)){
				echo '	
				<div class="uk-panel uk-text-center">
					<a href="'.$pic.'" target="_blank">
						<img src="'.$pic.'" class=" uk-border-rounded margin-top-20">
					</a><br><br>
					<button class="uk-button uk-button-danger borrarpic"><i uk-icon="icon:trash"></i> Eliminar imagen</button>
				</div>';
			}else{
				echo '
				<div class="uk-panel uk-text-center">
					<div class="uk-width-1-1">
						<p class="uk-scrollable-box"><i uk-icon="icon:image;ratio:5;"></i><br><br>
							<br><br>
						</p>
					</div>
				</div>';
			}
		echo '
			</div>
		</div>';

// FOTOGRAFÍAS
	echo '
		<div class="uk-width-1-1 margin-top-50">
			<h3 class="uk-text-center">Fotografías</h3>
		</div>

		<div class="uk-width-1-1">
			<div id="fileuploader">
				Cargar
			</div>
		</div>
		<div class="uk-width-1-1 uk-text-center">
			<div uk-grid id="pics" class="uk-grid-small uk-grid-match sortable" data-tabla="'.$modulopic.'">';

		$consultaPIC = $CONEXION -> query("SELECT * FROM $modulopic WHERE producto = $id ORDER BY orden,id");
		$numProds=$consultaPIC->num_rows;
		while ($row_consultaPIC = $consultaPIC -> fetch_assoc()) {
			$picId=$row_consultaPIC['id'];
			$pic=$rutaFinal.$picId.'.jpg';
			if(file_exists($pic)){
				echo '
					<div id="'.$picId.'">
						<div class="uk-card uk-card-default uk-card-body uk-text-center">
							<a href="'.$pic.'" class="uk-icon-button uk-button-white" target="_blank" uk-icon="icon:image"></a> &nbsp;
							<a href="javascript:borrarfoto(picID='.$picId.')" class="uk-icon-button uk-button-danger" tabindex="1" uk-icon="icon:trash"></a>
							<br>
							<img src="'.$pic.'" class="uk-border-rounded margin-top-20" style="max-width:200px;">
						</div>
					</div>';
			}else{
				echo '
					<div class="uk-width-1-4@l uk-width-1-2@m uk-width-1-1@s uk-margin-bottom" id="'.$picId.'">
						<div class="uk-card uk-card-default uk-card-body uk-text-center">
							<a href="javascript:borrarfoto(picID='.$picId.')" class="uk-icon-button uk-button-danger" tabindex="1" uk-icon="icon:trash"></a>
							<br>
							Imagen rota<br>
							<i uk-icon="icon:ban;ratio:2;"></i>
						</div>
					</div>';
			}
		}

		echo '
			</div>
		</div>

		';

$scripts='
	// Eliminar foto
		function borrarfoto (id) { 
			var statusConfirm = confirm("Realmente desea eliminar esto?"); 
			if (statusConfirm == true) { 
				$.ajax({
					method: "POST",
					url: "modulos/'.$modulo.'/acciones.php",
					data: { 
						borrarfoto: 1,
						id: id
					}
				})
				.done(function( msg ) {
					UIkit.notification.closeAll();
					UIkit.notification(msg);
					$("#"+id).addClass( "uk-invisible" );
				});
			}
		}

	// Eliminar foto redes
		$(".borrarpicredes").click(function() {
			var statusConfirm = confirm("Realmente desea borrar esto?"); 
			if (statusConfirm == true) { 
				window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&borrarpicredes");
			} 
		});

	// Subir imagen de galería
	$(document).ready(function() {
		$("#fileuploader").uploadFile({
			url:"modulos/'.$modulo.'/acciones.php?id='.$id.'",
			multiple: true,
			maxFileCount:1000,
			fileName:"uploadedfile",
			allowedTypes: "jpeg,jpg",
			maxFileSize: 6000000,
			showFileCounter: false,
			showDelete: "false",
			showPreview:false,
			showQueueDiv:true,
			returnType:"json",
			onSuccess:function(files,data,xhr){
				console.log(data);
				var l = data[0].indexOf(".");
				var id = data[0].substring(0,l);
				$("#pics").append("';
				$scripts.='<div id=\'"+id+"\'>';
				$scripts.='<div class=\'uk-card uk-card-default uk-card-body uk-text-center\'>';
				$scripts.='<div>';
				$scripts.='<a href=\'javascript:borrarfoto(\""+id+"\")\' class=\'uk-icon-button uk-button-danger\' uk-icon=\'trash\'></a>';
				$scripts.='</div>';
				$scripts.='<div class=\'uk-margin\' uk-lightbox>';
				$scripts.='<a href=\''.$rutaFinal.'"+data+"\'>';
				$scripts.='<img src=\''.$rutaFinal.'"+data+"\' style=\'max-width:200px;\'>';
				$scripts.='</a>';
				$scripts.='</div>';
				$scripts.='</div>';
				$scripts.='</div>';
				$scripts.='");';
				$scripts.='
			}
		});
	});

	// Subir imagen redes
		$(document).ready(function() {
			$("#fileuploadermain").uploadFile({
				url:"../library/upload-file/php/upload.php",
				fileName:"myfile",
				maxFileCount:1,
				showDelete: \'false\',
				allowedTypes: "jpeg,jpg,png",
				maxFileSize: 6291456,
				showFileCounter: false,
				showPreview:false,
				returnType:\'json\',
				onSuccess:function(data){ 
					window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&cat='.$cat.'&id='.$id.'&position=main&filename=\'+data);
				}
			});
		});


	// Eliminar producto
		$(".eliminaprod").click(function() {
			var id = $(this).attr(\'data-id\');
			//console.log(id);
			var statusConfirm = confirm("Realmente desea eliminar este Producto?"); 
			if (statusConfirm == true) { 
				window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=items&borrarPod&cat='.$cat.'&id="+id);
			} 
		});

		';
