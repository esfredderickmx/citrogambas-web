<div>
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Eliminar usuario</h3>
		@include('layouts.partials.messages')
		<p class="flow-text margin all-20">¿Seguro de que desea eliminar el registro del {{ $user->role === 'admin' ? 'administrador' : ($user->role === 'employee' ? 'empleado' : 'consumidor') }} "{{ $user->first_name ? strtok($user->first_name, ' ') . ' ' . strtok($user->last_name, ' ') : $user->username }}"?</p>
	</div>
	<div class="modal-footer brown">
		<form wire:submit.prevent="submitForm" wire:reset="resetForm">
			@csrf
			<button class="btn red darken-4 waves-effect waves-light" type="submit">Sí, eliminar</button>
			<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</form>
	</div>
</div>
