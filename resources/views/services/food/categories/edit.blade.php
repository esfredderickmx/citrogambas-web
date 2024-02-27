<div class="modal" id="edit-category-{{ $category->id }}" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
    <h3 class="header brown-text margin all-20">Editar la info. de la categoría</h3>
		<div class="row no-margin">
			<form action="{{ route('category.update', $category->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="input-field col s12">
          <i class="material-icons-round prefix">abc</i>
					<input id="new_name" name="new_name" type="text" value="{{ $category->name }}" autocomplete="off" required>
					<label for="new_name">Nombre de la categoría</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">css</i>
					<input id="new_icon" name="new_icon" type="text" value="{{ $category->icon }}" autocomplete="off" required>
					<label for="new_icon">Nombre del icono</label>
          <a class="margin all-20 orange-text text-darken-3" href="https://fonts.google.com/icons?hl=es-419&icon.style=Rounded&icon.set=Material+Icons" target="_blank"><strong>¿Qué nombres de iconos puedo usar en este campo?</strong></a>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar info.</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
