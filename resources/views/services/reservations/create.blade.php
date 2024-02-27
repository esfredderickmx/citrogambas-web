<div class="modal" id="create-reservation" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Realizar una reservación</h3>
		<div class="row no-margin">
			<form action="{{ route('reservation.store') }}" method="POST">
				@csrf
				<ul class="stepper linear no-margin padding all-10">
					<li class="step active no-padding">
						<div class="step-title waves-effect" data-step-label="Elegir una mesa">Primer paso</div>
						<div class="step-content">
							<div class="input-field">
								<i class="material-icons-round prefix">table_bar</i>
								<select id="table_id" name="table_id" required>
									<option disabled selected>Seleccione la mesa de su preferencia</option>
									@foreach ($tables as $table)
										<option data-capacity="{{ $table->capacity }}" value="{{ $table->id }}">Mesa #{{ $table->number }} (Capacidad para {{ $table->capacity }} personas)</option>
									@endforeach
								</select>
								<label for="table_id">Mesa</label>
							</div>
							<div class="step-actions">
								<button class="btn orange darken-3 waves-effect waves-light next-step" id="first-continue" disabled>Continuar</button>
							</div>
						</div>
					</li>
					<li class="step no-padding">
						<div class="step-title waves-effect" data-step-label="Detallar la reservación">Segundo paso</div>
						<div class="step-content">
							<div class="row no-margin">
								<div class="input-field col s12">
									<i class="material-icons-round prefix">groups_2</i>
									<select id="persons" name="persons" required></select>
									<label for="persons">Número de personas</label>
								</div>
								<div class="input-field col s6">
									<i class="material-icons-round prefix">event</i>
									<input class="datepicker" id="date" name="date" type="text" autocomplete="off" readonly required>
									<label for="date">Fecha para reservar</label>
								</div>
								<div class="input-field col s6">
									<i class="material-icons-round prefix">schedule</i>
									<input class="timepicker" id="time" name="time" type="text" autocomplete="off" readonly required>
									<label for="time">Hora para reservar</label>
								</div>
							</div>
							<div class="step-actions">
								<button class="btn orange darken-3 waves-effect waves-light next-step" id="second-continue" disabled>Continuar</button>
								<button class="btn-flat transparent waves-effect previous-step">Retroceder</button>
							</div>
						</div>
					</li>
					<li class="step no-padding">
						<div class="step-title waves-effect" data-step-label="Confirmar datos de la reservación">Tercer y último paso</div>
						<div class="step-content">
							<p id="third-step-p">Por favor, utiliza el siguiente botón para revisar y poder confirmar los datos de la reservación antes de realizarla.</p>
							<button class="btn brown waves-effect waves-light scale-transition" id="verify-button" type="button">Verificar</button>
						</div>
					</li>
				</ul>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light scale-transition scale-out" id="register-button" type="submit">Registrar reservación</button>
		<button class="btn-flat transparent white-text waves-effect waves-light" id="cancel-button" type="reset">Cancelar</button>
		</form>
	</div>
</div>
