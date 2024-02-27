<div>
	<form wire:submit.prevent="submitForm" wire:reset="resetForm">
		<div class="modal-content yellow lighten-4 padding all-10">
			<h3 class="header brown-text margin all-20">Editar info. del usuario</h3>
			<div class="row no-margin">
				@include('layouts.partials.messages')
				@csrf
				<div wire:ignore>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix">person</i>
						<input id="first_name_{{ $user->id }}" name="first_name_{{ $user->id }}" type="text" value="{{ $user->first_name }}" wire:model="user.first_name" autocomplete="off" required>
						<label for="first_name_{{ $user->id }}">Nombre(s)</label>
						@error('user.first_name')
							<span class="helper-text deep-orange-text text-darken-3">{{ $message }}</span>
						@enderror
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons-round prefix hide-on-med-and-up">person_outline</i>
						<input id="last_name_{{ $user->id }}" name="last_name_{{ $user->id }}" type="text" value="{{ $user->last_name }}" wire:model="user.last_name" autocomplete="off" required>
						<label for="last_name_{{ $user->id }}">Apellido(s)</label>
						@error('user.last_name')
							<span class="helper-text deep-orange-text text-darken-3">{{ $message }}</span>
						@enderror
					</div>
					<div class="input-field col s12 m5">
						<i class="material-icons-round prefix">phone</i>
						<input id="phone_{{ $user->id }}" name="phone_{{ $user->id }}" type="tel" value="{{ $user->phone }}" wire:model="user.phone" autocomplete="off" pattern="[0-9]{10}" minlength="10" maxlength="10" required>
						<label for="phone_{{ $user->id }}">Número de teléfono</label>
						@error('user.phone')
							<span class="helper-text deep-orange-text text-darken-3">{{ $message }}</span>
						@enderror
					</div>
					<div class="input-field col s12 m7">
						<i class="material-icons-round prefix">verified</i>
						{{-- Este select se llamaba new_role_null --}}
						<select id="role_{{ $user->id }}" name="role_{{ $user->id }}" wire:model="user.role" {{ Auth::user()->role !== 'admin' ? 'disabled' : '' }} required>
							<option value="consumer" {{ $user->role === 'consumer' ? 'selected' : '' }}>Consumidor</option>
							<option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Empleado</option>
							<option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
						</select>
						<label for="role_{{ $user->id }}">Rol en la empresa</label>
						@error('user.role')
							<span class="helper-text deep-orange-text text-darken-3">{{ $message }}</span>
						@enderror
					</div>
					{{-- <input id="new_role" name="new_role" type="hidden" wire:model="user.role"> --}}
				</div>
			</div>
		</div>
		<div class="modal-footer brown">
			<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar</button>
			<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</div>
	</form>
</div>
