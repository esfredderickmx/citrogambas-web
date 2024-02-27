<div class="modal" id="create-table" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
    <h3 class="header brown-text margin all-20">Registrar una mesa nueva</h3>
		<div class="row no-margin">
			<form action="{{ route('table.store') }}" method="POST">
				@csrf
				<div class="input-field col s6">
          <i class="material-icons-round prefix">tag</i>
					<input id="number" name="number" type="number" autocomplete="off" required>
					<label for="number">Número de mesa</label>
				</div>
				<div class="input-field col s6">
          <i class="material-icons-round prefix">groups</i>
					<input id="capacity" name="capacity" type="number" autocomplete="off" required>
					<label for="capacity">Capacidad de personas</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrar mesa</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</form>
	</div>
</div>
