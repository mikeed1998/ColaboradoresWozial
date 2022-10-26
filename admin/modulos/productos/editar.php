<?php
	$consulta = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
	$row_catalogo = $consulta -> fetch_assoc();
	$idServicio = $row_catalogo['servicio'];

// BREADCRUMB
	echo '
	<div class="uk-width-1-1 margin-v-20">
		<ul class="uk-breadcrumb uk-text-center">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Productos</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'">'.$row_catalogo['titulo'].'</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=editar&id='.$id.'" class="color-red">Editar</a></li>
		</ul>
	</div>';
	

// inicio
	echo '
	<div class="uk-width-1-1 margin-top-20 uk-form">
		<div class="uk-container">
			<form action="index.php" method="post" enctype="multipart/form-data" name="datos" onsubmit="return checkForm(this);">
				<input type="hidden" name="editar" value="1">
				<input type="hidden" name="modulo" value="'.$modulo.'">
				<input type="hidden" name="archivo" value="detalle">
				<input type="hidden" name="id" value="'.$id.'">
				<div uk-grid class="uk-grid-small uk-child-width-1-3@s">
					<div>
						<label for="titulo">Titulo</label>
						<input type="text" class="uk-input" name="titulo" value="'.$row_catalogo['titulo'].'" required>
					</div>
					<div>
						<label for="empresa">empresa</label>
						<input type="text" class="uk-input" name="empresa" value="'.$row_catalogo['empresa'].'" required>
					</div>
					<div>
						<label for="servicio">Servicio</label>
						<div>
							<select name="servicio" data-placeholder="Seleccione una" class="select uk-select">';
								$CONSULTA1 = $CONEXION -> query("SELECT * FROM servicios ORDER BY titulo");
								while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
									$activo = '';
									if ($row_CONSULTA1['id'] == $idServicio) {
										$activo = 'selected';
									}

									echo '
									<option value="'.$row_CONSULTA1['id'].'" '.$activo.'>'.$row_CONSULTA1['titulo'].'</option>';
								}
								echo '
							</select>
						</div>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-3@s">
					<div>
						<label for="url">Página Web</label>
						<input type="text" class="uk-input" name="url" value="'.$row_catalogo['url'].'">
					</div>
					<div>
						<label for="facebook">facebook</label>
						<input type="text" class="uk-input" name="facebook" value="'.$row_catalogo['facebook'].'">
					</div>
					<div>
						<label for="instagram">instagram</label>
						<input type="text" class="uk-input" name="instagram" value="'.$row_catalogo['instagram'].'">
					</div>
					<div>
						<label for="whatsapp">whatsapp</label>
						<input type="text" class="uk-input" name="whatsapp" value="'.$row_catalogo['whatsapp'].'">
					</div>
				</div>
				<div class="uk-margin">
					<label for="txt">Descripción</label>
					<textarea class="editor" name="txt" id="txt">'.$row_catalogo['txt'].'</textarea>
				</div>

				<div class="uk-margin">
					<label for="title">Título google</label>
					<input type="text" class="uk-input" name="title" value="'.$row_catalogo['title'].'">
				</div>
				<div class="uk-margin">
					<label for="metadescription">Descripción google</label>
					<textarea class="uk-textarea" name="metadescription">'.$row_catalogo['metadescription'].'</textarea>
				</div>
				<div class="uk-margin uk-text-center">
					<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'" class="uk-button uk-button-default uk-button-large" tabindex="10">Cancelar</a>					
					<button name="send" class="uk-button uk-button-primary uk-button-large">Guardar</button>
				</div>

			</form>
		</div>
	</div>
	';

