@extends('layouts.app-master')

@section('title', 'Administrar mesas | Citrogambas')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Administrar mesas</h1>
		<div class="row no-margin">
			<form class="col s12" style="display: flex;" action="{{ route('tables') }}" method="GET">
				<div class="input-field inline" style="width: 30%;">
					<select id="search" name="search" required>
						<option value="" disabled selected>Seleccione el estado de la mesa</option>
						<option value="free" {{ request('search') === 'free' ? 'selected' : '' }}>Disponibles</option>
						<option value="reserved" {{ request('search') === 'reserved' ? 'selected' : '' }}>Reservadas</option>
						<option value="occupied" {{ request('search') === 'occupied' ? 'selected' : '' }}>Ocupadas</option>
					</select>
					<label for="search">Buscar mesa por estado</label>
				</div>
				<div class="input-field inline">
					<button class="btn orange darken-3 waves-effect waves-light" type="submit">
						<i class="material-icons-round right no-margin">saved_search</i>
					</button>
					@if ($search)
						<a class="btn-flat transparent waves-effect" href="{{ route('tables') }}">
							<i class="material-icons-round right">backspace</i>Limpiar búsqueda
						</a>
					@endif
				</div>
			</form>
		</div>
		@include('layouts.partials.messages')
		<table class="highlight">
			<thead>
				<tr>
					<th>Número de mesa</th>
					<th>Capacidad</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tables as $table)
					<tr>
						<td>Mesa #{{ $table->number }}</td>
						<td>{{ $table->capacity }} personas</td>
						<td>{{ $table->status === 'free' ? 'Disponible' : ($table->status === 'reserved' ? 'Reservada' : 'Ocupada') }}</td>
						<td class="right-align">
							<a class="btn brown waves-effect waves-light modal-trigger" href="#edit-table-{{ $table->id }}">
								<i class="material-icons-round left">edit</i>Editar
							</a>
							@if (Auth::user()->role === 'admin')
								<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#delete-table-{{ $table->id }}">
									<i class="material-icons-round left">delete</i>Eliminar
								</a>
							@endif
						</td>
					</tr>

					{{-- Modal para editar categoría --}}
					@include('services.reservations.tables.edit')

					@if (Auth::user()->role === 'admin')
						{{-- Modal para eliminar categoría --}}
						@include('services.reservations.tables.delete')
					@endif
				@endforeach
			</tbody>
		</table>

		{{-- Modal para registrar categoría --}}
		@include('services.reservations.tables.create')

		<ul class="pagination">
			@if ($tables->onFirstPage())
				<li class="disabled"><a><i class="material-icons-round">chevron_left</i></a></li>
			@else
				<li class="waves-effect"><a href="{{ $tables->previousPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_left</i></a></li>
			@endif

			@if ($tables->currentPage() > 3)
				<li class="waves-effect"><a href="{{ $tables->url(1) }}{{ !empty($search) ? '&search=' . $search : '' }}">1</a></li>
				@if ($tables->currentPage() > 4)
					<li class="disabled"><a>...</a></li>
				@endif
			@endif

			@for ($i = max(1, $tables->currentPage() - 2); $i <= min($tables->currentPage() + 2, $tables->lastPage()); $i++)
				@if ($i == $tables->currentPage())
					<li class="active orange darken-3"><a>{{ $i }}</a></li>
				@else
					<li class="waves-effect"><a href="{{ $tables->url($i) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $i }}</a></li>
				@endif
			@endfor

			@if ($tables->currentPage() < $tables->lastPage() - 2)
				@if ($tables->currentPage() < $tables->lastPage() - 3)
					<li class="disabled"><a>...</a></li>
				@endif
				<li class="waves-effect"><a href="{{ $tables->url($tables->lastPage()) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $tables->lastPage() }}</a>
				</li>
			@endif

			@if ($tables->hasMorePages())
				<li class="waves-effect"><a href="{{ $tables->nextPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_right</i></a></li>
			@else
				<li class="disabled"><a><i class="material-icons-round">chevron_right</i></a></li>
			@endif
		</ul>
	</div>

	{{-- Botón de acciones flotante --}}
	<div class="fixed-action-btn custom-fixed-fab">
		<a class="btn-floating btn-large orange darken-3 waves-effect waves-light tooltipped modal-trigger" data-position="left" data-tooltip="Agregar mesa" href="#create-table">
			<i class="large material-icons">add</i>
		</a>
	</div>
@endsection
