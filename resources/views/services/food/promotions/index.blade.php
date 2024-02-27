@extends('layouts.app-master')

@section('title', 'Administrar promociones | Citrogambas')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Administrar promociones</h1>
		<div class="row no-margin">
			<form class="col s12" style="display: flex;" action="{{ route('promotions') }}" method="GET">
				<div class="input-field inline" style="width: 30%;">
					<input id="search" name="search" type="text" value="{{ request('search') }}" autofocus autocomplete="off" required>
					<label for="search">Buscar promoción por código</label>
				</div>
				<div class="input-field inline">
					<button class="btn orange darken-3 waves-effect waves-light" type="submit">
						<i class="material-icons-round right no-margin">saved_search</i>
					</button>
					@if ($search)
						<a class="btn-flat transparent waves-effect" href="{{ route('promotions') }}">
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
					<th>Código de promoción</th>
					<th>Descuento que se aplica</th>
					<th>Fecha de vencimiento</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($promotions as $promotion)
					<tr>
						<td>{{ $promotion->code }}</td>
						<td>{{ $promotion->discount }}%</td>
						<td>Hasta el {{ $promotion->valid_until }}</td>
						@if (Auth::user()->role === 'admin')
							<td class="right-align">
								<a class="btn brown waves-effect waves-light modal-trigger" href="#edit-promotion-{{ $promotion->id }}">
									<i class="material-icons-round left">edit</i>Editar
								</a>
								<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#delete-promotion-{{ $promotion->id }}">
									<i class="material-icons-round left">delete</i>Eliminar
								</a>
							</td>
						@endif
					</tr>

					@if (Auth::user()->role === 'admin')
						{{-- Modal para editar categoría --}}
						@include('services.food.promotions.edit')

						{{-- Modal para eliminar categoría --}}
						@include('services.food.promotions.delete')
					@endif
				@endforeach
			</tbody>
		</table>

		@if (Auth::user()->role === 'admin')
			{{-- Modal para registrar categoría --}}
			@include('services.food.promotions.create')
		@endif

		<ul class="pagination">
			@if ($promotions->onFirstPage())
				<li class="disabled"><a><i class="material-icons-round">chevron_left</i></a></li>
			@else
				<li class="waves-effect"><a href="{{ $promotions->previousPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_left</i></a></li>
			@endif

			@if ($promotions->currentPage() > 3)
				<li class="waves-effect"><a href="{{ $promotions->url(1) }}{{ !empty($search) ? '&search=' . $search : '' }}">1</a></li>
				@if ($promotions->currentPage() > 4)
					<li class="disabled"><a>...</a></li>
				@endif
			@endif

			@for ($i = max(1, $promotions->currentPage() - 2); $i <= min($promotions->currentPage() + 2, $promotions->lastPage()); $i++)
				@if ($i == $promotions->currentPage())
					<li class="active orange darken-3"><a>{{ $i }}</a></li>
				@else
					<li class="waves-effect"><a href="{{ $promotions->url($i) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $i }}</a></li>
				@endif
			@endfor

			@if ($promotions->currentPage() < $promotions->lastPage() - 2)
				@if ($promotions->currentPage() < $promotions->lastPage() - 3)
					<li class="disabled"><a>...</a></li>
				@endif
				<li class="waves-effect"><a href="{{ $promotions->url($promotions->lastPage()) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $promotions->lastPage() }}</a>
				</li>
			@endif

			@if ($promotions->hasMorePages())
				<li class="waves-effect"><a href="{{ $promotions->nextPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_right</i></a></li>
			@else
				<li class="disabled"><a><i class="material-icons-round">chevron_right</i></a></li>
			@endif
		</ul>
	</div>

	{{-- Botón de acciones flotante --}}
	@if (Auth::user()->role === 'admin')
		<div class="fixed-action-btn custom-fixed-fab">
			<a class="btn-floating btn-large orange darken-3 waves-effect waves-light tooltipped modal-trigger" data-position="left" data-tooltip="Agregar promoción" href="#create-promotion">
				<i class="large material-icons">add</i>
			</a>
		</div>
	@endif
@endsection
