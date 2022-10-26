<?php
// BREADCRUMB
	echo '
	<div class="uk-width-1-1 margin-v-20 uk-text-left">
		<ul class="uk-breadcrumb uk-text-capitalize">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Productos</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=nuevo" class="color-red">Nuevo</a></li>
		</ul>
	</div>';

// DATOS
	echo '
	<div class="uk-width-1-1 margin-top-20 uk-form">
		<div class="uk-container">
			<form action="index.php" method="post" enctype="multipart/form-data" name="datos" onsubmit="return checkForm(this);">
				<input type="hidden" name="nuevo" value="1">
				<input type="hidden" name="modulo" value="'.$modulo.'">
				<input type="hidden" name="archivo" value="'.$archivo.'">
				<div uk-grid class="uk-grid-small uk-child-width-1-3@s">
					<div>
						<label for="titulo">Titulo</label>
						<input type="text" class="uk-input" name="titulo" autofocus required>
					</div>
					<div>
						<label for="empresa">Empresa</label>
						<input type="text" class="uk-input" name="empresa" required>
					</div>
					<div>
						<label for="servicio">Servicio</label>
						<div>
							<select name="servicio" data-placeholder="Seleccione una" class="chosen-select uk-select">
								<option value=""></option>';
								$CONSULTA1 = $CONEXION -> query("SELECT * FROM servicios ORDER BY titulo");
								while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
									echo '
									<option value="'.$row_CONSULTA1['id'].'">'.$row_CONSULTA1['titulo'].'</option>';
								}
								echo '
							</select>
						</div>
					</div>
					<div>
						<label for="url">Página Web</label>
						<input type="text" class="uk-input" name="url">
					</div>
					<div>
						<label for="facebook">facebook</label>
						<input type="text" class="uk-input" name="facebook">
					</div>
					<div>
						<label for="instagram">instagram</label>
						<input type="text" class="uk-input" name="instagram">
					</div>
					<div>
						<label for="whatsapp">whatsapp</label>
						<input type="text" class="uk-input" name="whatsapp">
					</div>
				</div>

				<div class="uk-margin">
					<label for="txt">Descripción</label>
					<textarea class="editor" name="txt" id="txt"></textarea>
				</div>

				<div class="uk-margin">
					<label for="title">Título google</label>
					<input type="text" class="uk-input" name="title">
				</div>
				<div class="uk-margin">
					<label for="metadescription">Descripción google</label>
					<textarea class="uk-textarea" name="metadescription"></textarea>
				</div>
				<div class="uk-margin uk-text-center">
					<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'" class="uk-button uk-button-default uk-button-large" tabindex="10">Cancelar</a>
					<button name="send" class="uk-button uk-button-primary uk-button-large">Guardar</button>
				</div>

			</form>
		</div>
	</div>
	';