<div class="modal" id="create-category" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
    <h3 class="header brown-text margin all-20">Registrar una categoría nueva</h3>
		<div class="row no-margin">
			<form action="{{ route('category.store') }}" method="POST">
				@csrf
				<div class="input-field col s12">
          <i class="material-icons-round prefix">abc</i>
					<input id="name" name="name" type="text" autocomplete="off" required>
					<label for="name">Nombre de la categoría</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">css</i>
					<input id="icon" name="icon" type="text" autocomplete="off" required>
					<label for="icon">Nombre del icono</label>
          <a class="margin all-20 orange-text text-darken-3" href="https://fonts.google.com/icons?hl=es-419&icon.style=Rounded&icon.set=Material+Icons" target="_blank"><strong>¿Qué nombres de iconos puedo usar en este campo?</strong></a>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrar categoría</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</form>
	</div>
</div>
