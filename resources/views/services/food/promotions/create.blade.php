<div class="modal" id="create-promotion" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
    <h3 class="header brown-text margin all-20">Registrar una promoción nueva</h3>
		<div class="row no-margin">
			<form action="{{ route('promotion.store') }}" method="POST">
				@csrf
				<div class="input-field col s6">
          <i class="material-icons-round prefix">confirmation_number</i>
					<input id="code" name="code" type="text" autocomplete="off" required>
					<label for="code">Código de promoción</label>
				</div>
				<div class="input-field col s6">
          <i class="material-icons-round prefix">percent</i>
					<input id="discount" name="discount" type="number" autocomplete="off" required>
					<label for="discount">Descuento que aplica</label>
				</div>
				<div class="input-field col s7 offset-s2">
          <i class="material-icons-round prefix">event_available</i>
					<input class="datepicker" id="valid_until" name="valid_until" type="text" autocomplete="off" readonly required>
					<label for="valid_until">Vencimiento</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrar promoción</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</form>
	</div>
</div>
