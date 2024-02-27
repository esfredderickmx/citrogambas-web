<div class="modal" id="edit-table-{{ $table->id }}" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Editar la info. de la mesa</h3>
		<div class="row no-margin">
			<form action="{{ route('table.update', $table->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="input-field col s6">
					<i class="material-icons-round prefix">tag</i>
					<input id="new_number" name="new_number" type="number" value="{{ $table->number }}" autocomplete="off" required>
					<label for="new_number">Número de mesa</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons-round prefix">groups</i>
					<input id="new_capacity" name="new_capacity" type="number" value="{{ $table->capacity }}" autocomplete="off" required>
					<label for="new_capacity">Capacidad de personas</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar info.</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
