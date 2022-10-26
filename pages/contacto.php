<!DOCTYPE html>
<?=$headGNRL?>
<body>
  
<?=$header?>

<div class="uk-container uk-container-small uk-flex uk-flex-middle" style="min-height: 80vh;">
	<div class="uk-width-1-1 uk-card uk-card-default uk-card-body">
		<div uk-grid class="uk-child-width-1-3@s">
			<div>
				<label>Nombre
				<input type="text" class="uk-input input-personal" id="footernombre"></label>
			</div>
			<div>
				<label>Correo
				<input type="email" class="uk-input input-personal" id="footeremail"></label>
			</div>
			<div>
				<label>Teléfono
				<input type="text" class="uk-input input-personal" id="footertelefono"></label>
			</div>
		</div>
		<div class="margin-top-20">
			<div>
				<label>Mensaje
				<textarea type="text" class="uk-textarea input-personal" id="footercomentarios"></textarea></label>
			</div>
		</div>
		<div class="margin-top-20 uk-text-center">
			<button class="uk-button uk-button-personal footer-enviar" id="footersend">Enviar</button>
		</div>
	</div>

</div>

<?=$footer?>

<?=$scriptGNRL?>

</body>
</html>