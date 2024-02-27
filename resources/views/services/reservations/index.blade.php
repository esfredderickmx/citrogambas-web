@php
	function formatDate($date)
	{
	    $months = [
	        '01' => 'Enero',
	        '02' => 'Febrero',
	        '03' => 'Marzo',
	        '04' => 'Abril',
	        '05' => 'Mayo',
	        '06' => 'Junio',
	        '07' => 'Julio',
	        '08' => 'Agosto',
	        '09' => 'Septiembre',
	        '10' => 'Octubre',
	        '11' => 'Noviembre',
	        '12' => 'Diciembre',
	    ];
	
	    $date_parts = explode('-', $date);
	    $year = $date_parts[0];
	    $month = $months[$date_parts[1]];
	    $day = $date_parts[2];
	
	    return $day . ' ' . $month . ', ' . $year;
	}
@endphp

@extends('layouts.app-master')

@section('title', 'Administrar reservaciones | Citrogambas')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Administrar reservaciones</h1>
		@if (Auth::user()->role !== 'consumer')
			<div class="row no-margin">
				<form class="col s12" style="display: flex;" action="{{ route('reservations') }}" method="GET">
					<div class="input-field inline" style="width: 30%;">
						<input id="search" name="search" type="text" value="{{ request('search') }}" autofocus autocomplete="off" required>
						<label for="search">Buscar reservación por usuario</label>
					</div>
					<div class="input-field inline">
						<button class="btn orange darken-3 waves-effect waves-light" type="submit">
							<i class="material-icons-round right no-margin">saved_search</i>
						</button>
						@if ($search)
							<a class="btn-flat transparent waves-effect" href="{{ route('reservations') }}">
								<i class="material-icons-round right">backspace</i>Limpiar búsqueda
							</a>
						@endif
					</div>
				</form>
			</div>
		@endif
		@include('layouts.partials.messages')
		<table class="highlight">
			<thead>
				<tr>
					<th>Nombre / usuario</th>
					<th>Fecha y hora de reserva</th>
					<th>Número de mesa</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reservations as $reservation)
					<tr class="{{ Auth::user()->role !== 'consumer' ? 'tooltipped' : '' }}" data-position="left" data-tooltip="Para {{ $reservation->persons }} personas">
						<td>
							{{ $reservation->user->first_name ? 'Nombre: ' . strtok($reservation->user->first_name, ' ') . ' ' . strtok($reservation->user->last_name, ' ') : 'Usuario: ' . $reservation->user->username }}
						</td>
						<td>
							@php
								$time = DateTime::createFromFormat('H:i:s', $reservation->time);
								$formatted_time = $time->format('h:i A');
								$formatted_date = formatDate($reservation->date);
							@endphp
							Para el {{ $formatted_date }} a las {{ $formatted_time }}
						</td>
						<td>En la mesa #{{ $reservation->table->number }}</td>
						<td class="right-align">
							{{-- <a class="btn brown waves-effect waves-light modal-trigger" href="#edit-reservation-{{ $reservation->id }}">
								<i class="material-icons-round left">edit</i>Editar
							</a> --}}
							<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger {{ Auth::user()->role === 'employee' ? ($reservation->user->id !== Auth::user()->id ? 'hide' : '') : '' }}" href="#delete-reservation-{{ $reservation->id }}">
								<i class="material-icons-round left">event_busy</i>Cancelar
							</a>
						</td>
					</tr>

					@if (Auth::user()->role === 'admin')
						{{-- Modal para editar reservación --}}
						@include('services.reservations.edit')
					@endif

					{{-- Modal para eliminar reservación --}}
					@include('services.reservations.delete')
				@endforeach
			</tbody>
		</table>

		{{-- Modal para registrar reservación --}}
		@include('services.reservations.create')

		<ul class="pagination">
			@if ($reservations->onFirstPage())
				<li class="disabled"><a><i class="material-icons-round">chevron_left</i></a></li>
			@else
				<li class="waves-effect"><a href="{{ $reservations->previousPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_left</i></a></li>
			@endif

			@if ($reservations->currentPage() > 3)
				<li class="waves-effect"><a href="{{ $reservations->url(1) }}{{ !empty($search) ? '&search=' . $search : '' }}">1</a></li>
				@if ($reservations->currentPage() > 4)
					<li class="disabled"><a>...</a></li>
				@endif
			@endif

			@for ($i = max(1, $reservations->currentPage() - 2); $i <= min($reservations->currentPage() + 2, $reservations->lastPage()); $i++)
				@if ($i == $reservations->currentPage())
					<li class="active orange darken-3"><a>{{ $i }}</a></li>
				@else
					<li class="waves-effect"><a href="{{ $reservations->url($i) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $i }}</a></li>
				@endif
			@endfor

			@if ($reservations->currentPage() < $reservations->lastPage() - 2)
				@if ($reservations->currentPage() < $reservations->lastPage() - 3)
					<li class="disabled"><a>...</a></li>
				@endif
				<li class="waves-effect"><a href="{{ $reservations->url($reservations->lastPage()) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $reservations->lastPage() }}</a>
				</li>
			@endif

			@if ($reservations->hasMorePages())
				<li class="waves-effect"><a href="{{ $reservations->nextPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_right</i></a></li>
			@else
				<li class="disabled"><a><i class="material-icons-round">chevron_right</i></a></li>
			@endif
		</ul>
	</div>

	{{-- Botón de acciones flotante --}}
	@if (Auth::user()->role !== 'consumer')
		<div class="fixed-action-btn custom-fixed-fab">
			<a class="btn-floating btn-large deep-orange darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Más opciones">
				<i class="large material-icons">more_vert</i>
			</a>
			<ul>
				<li>
					<a class="btn-floating btn-small yellow darken-3 tooltipped" data-position="left" data-tooltip="Administrar mesas" href="{{ route('tables') }}">
						<i class="material-icons-round">table_restaurant</i>
					</a>
				</li>
				{{-- <li>
					<a class="btn-floating btn-small lime darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Reservar para un cliente" href="#create-reservation-for-customer">
						<i class="material-icons-round">person_add</i>
					</a>
				</li> --}}
				<li>
					<a class="btn-floating orange darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Realizar reservación" href="#create-reservation">
						<i class="material-icons-round">add</i>
					</a>
				</li>
			</ul>
		</div>
	@else
		<div class="fixed-action-btn custom-fixed-fab">
			<a class="btn-floating btn-large orange darken-3 waves-effect waves-light tooltipped modal-trigger" data-position="left" data-tooltip="Realizar reservación" href="#create-reservation">
				<i class="large material-icons">add</i>
			</a>
		</div>
	@endif
@endsection
