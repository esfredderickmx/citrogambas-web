<div class="modal" id="delete-reservation-{{ $reservation->id }}" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Cancelar reservación</h3>
		<p class="flow-text padding all-10 no-margin">¿Está seguro de que desea cancelar la reservación agendada {{$reservation->user->id !== Auth::user()->id ? 'por '.($reservation->user->first_name ? strtok($reservation->user->first_name, ' ') . ' ' . strtok($reservation->user->last_name, ' ') : $reservation->user->username) : ''}} para el {{ $formatted_date }} a las {{ $formatted_time }}?</p>
	</div>
	<div class="modal-footer brown">
		<form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn red darken-4 waves-effect waves-light modal-close" type="submit">Sí, cancelar</button>
			<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
