<div class="modal" id="edit-promotion-{{ $promotion->id }}" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Editar la info. de la promoción</h3>
		<div class="row no-margin">
			<form action="{{ route('promotion.update', $promotion->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="input-field col s6">
					<i class="material-icons-round prefix">confirmation_number</i>
					<input id="new_code" name="new_code" type="text" value="{{ $promotion->code }}" autocomplete="off" required>
					<label for="new_code">Código de promoción</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons-round prefix">percent</i>
					<input id="new_discount" name="new_discount" type="number" value="{{ $promotion->discount }}" autocomplete="off" required>
					<label for="new_discount">Descuento que aplica</label>
				</div>
				<div class="input-field col s7 offset-s2">
					<i class="material-icons-round prefix">event_available</i>
					<input class="datepicker" id="new_valid" name="new_valid" type="text" value="{{ $promotion->valid_until }}" autocomplete="off" readonly required>
					<label for="new_valid">Vencimiento</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar info.</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
