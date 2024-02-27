<div>
	<form wire:submit.prevent="submitForm" wire:reset="resetForm">
		<div class="modal-content yellow lighten-4 padding all-10">
			<h3 class="header brown-text margin all-20">Registrar usuario</h3>
			<div class="row no-margin">
				@include('layouts.partials.messages')
				@csrf
				<div wire:ignore>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix">person</i>
						<input id="first_name" name="first_name" type="text" wire:model="first_name" autocomplete="off" required>
						<label for="first_name">Nombre(s)</label>
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix hide-on-med-and-up">person_outline</i>
						<input id="last_name" name="last_name" type="text" wire:model="last_name" autocomplete="off" required>
						<label for="last_name">Apellido(s)</label>
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix">alternate_email</i>
						<input id="username" name="username" type="text" wire:model="username" autocomplete="off" required>
						<label for="username">Nombre de usuario</label>
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix hide-on-med-and-up">email</i>
						<input id="email" name="email" type="email" wire:model="email" autocomplete="off" required>
						<label for="email">Correo electrónico</label>
					</div>
					<div class="input-field col s12 m5">
						<i class="material-icons-round prefix">phone</i>
						<input id="phone" name="phone" type="tel" wire:model="phone" autocomplete="off" pattern="[0-9]{10}" minlength="10" maxlength="10" required>
						<label for="phone">Número de teléfono</label>
					</div>
					<div class="input-field col s12 m7">
						<i class="material-icons-round prefix">verified</i>
						<select id="role" name="role" wire:model="role" required {{ Auth::user()->role !== 'admin' ? 'disabled' : '' }}>
							<option selected>Seleccione el rol del usuario</option>
							<option value="consumer">Consumidor</option>
							<option value="employee">Empleado</option>
							<option value="admin">Administrador</option>
						</select>
						<label for="role">Público objetivo</label>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer brown">
			<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrar</button>
			<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</div>
	</form>
</div>
