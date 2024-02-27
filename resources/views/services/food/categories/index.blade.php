@extends('layouts.app-master')

@section('title', 'Administrar categorías | Citrogambas')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Administrar categorías</h1>
		<div class="row no-margin">
			<form class="col s12" style="display: flex;" action="{{ route('categories') }}" method="GET">
				<div class="input-field inline" style="width: 30%;">
					<input id="search" name="search" type="text" value="{{ request('search') }}" autofocus autocomplete="off" required>
					<label for="search">Buscar categoría por nombre</label>
				</div>
				<div class="input-field inline">
					<button class="btn orange darken-3 waves-effect waves-light" type="submit">
						<i class="material-icons-round right no-margin">manage_search</i>
					</button>
					@if ($search)
						<a class="btn-flat transparent waves-effect" href="{{ route('categories') }}">
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
					<th>#</th>
					<th>Icono</th>
					<th>Nombre de la categoría</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $category)
					<tr class="tooltipped" data-position="left" data-tooltip="Icono: {{ $category->icon }}">
						<th>{{ $category->id }}</th>
						<td><i class="material-icons-round">{{ $category->icon }}</i></td>
						<td>{{ $category->name }}</td>
						<td class="right-align">
							<a class="btn brown waves-effect waves-light modal-trigger" href="#edit-category-{{ $category->id }}">
								<i class="material-icons-round left">edit</i>Editar
							</a>
							@if (Auth::user()->role === 'admin')
								<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#delete-category-{{ $category->id }}">
									<i class="material-icons-round left">delete</i>Eliminar
								</a>
							@endif
						</td>
					</tr>

					{{-- Modal para mostrar la gráfica --}}
					<div class="modal" id="show-graphic" style="width: 30%">
						<div class="modal-content yellow lighten-4 padding all-10">
							<h3 class="header brown-text margin all-20">Relación categorías-platillos</h3>
							<div id="piechart"></div>
						</div>
						<div class="modal-footer brown">
							<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Aceptar</a>
						</div>
					</div>

					{{-- Modal para editar categoría --}}
					@include('services.food.categories.edit')

					{{-- Modal para eliminar categoría --}}
					@if (Auth::user()->role === 'admin')
						@include('services.food.categories.delete')
					@endif
				@endforeach
			</tbody>
		</table>

		{{-- Modal para registrar categoría --}}
		@include('services.food.categories.create')

		<ul class="pagination">
			@if ($categories->onFirstPage())
				<li class="disabled"><a><i class="material-icons-round">chevron_left</i></a></li>
			@else
				<li class="waves-effect"><a href="{{ $categories->previousPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_left</i></a></li>
			@endif

			@if ($categories->currentPage() > 3)
				<li class="waves-effect"><a href="{{ $categories->url(1) }}{{ !empty($search) ? '&search=' . $search : '' }}">1</a></li>
				@if ($categories->currentPage() > 4)
					<li class="disabled"><a>...</a></li>
				@endif
			@endif

			@for ($i = max(1, $categories->currentPage() - 2); $i <= min($categories->currentPage() + 2, $categories->lastPage()); $i++)
				@if ($i == $categories->currentPage())
					<li class="active orange darken-3"><a>{{ $i }}</a></li>
				@else
					<li class="waves-effect"><a href="{{ $categories->url($i) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $i }}</a></li>
				@endif
			@endfor

			@if ($categories->currentPage() < $categories->lastPage() - 2)
				@if ($categories->currentPage() < $categories->lastPage() - 3)
					<li class="disabled"><a>...</a></li>
				@endif
				<li class="waves-effect"><a href="{{ $categories->url($categories->lastPage()) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $categories->lastPage() }}</a>
				</li>
			@endif

			@if ($categories->hasMorePages())
				<li class="waves-effect"><a href="{{ $categories->nextPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_right</i></a></li>
			@else
				<li class="disabled"><a><i class="material-icons-round">chevron_right</i></a></li>
			@endif
		</ul>
	</div>

	{{-- Botón de acciones flotante --}}
	<div class="fixed-action-btn custom-fixed-fab">
		<a class="btn-floating btn-large deep-orange darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Más opciones">
			<i class="large material-icons">more_vert</i>
		</a>
		<ul>
			<li>
				<a class="btn-floating btn-small yellow darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Mostrar gráfico" href="#show-graphic">
					<i class="material-icons-round">pie_chart</i>
				</a>
			</li>
			<li>
				<a class="btn-floating orange darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Agregar categoría" href="#create-category">
					<i class="material-icons-round">add</i>
				</a>
			</li>
		</ul>
	</div>

	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable(@json($data));

			var options = {
				title: 'Número de platillos por categoría',
				height: 400,
				backgroundColor: '#fff9c4',
				chartArea: {
					width: '90%',
					height: '75%',
				},
				titleTextStyle: {
					fontSize: 20,
					color: '#ef6c00',
				},
				legend: {
					position: 'labeled'
				},
				tooltip: {
					showColorCode: true,
					trigger: 'selection',
				},
				colors: [
					'#7cb342',
					'#689f38',
					'#558b2f',
					'#33691e',
					'#cddc39',
					'#c0ca33',
					'#afb42b',
					'#9e9d24',
					'#827717',
					'#ffc107',
					'#ffb300',
					'#ffa000',
					'#ff8f00',
					'#ff6f00',
					'#ff9800',
					'#fb8c00',
					'#f57c00',
					'#ef6c00',
					'#e65100',
					'#ff5722',
					'#f4511e',
					'#e64a19',
					'#d84315',
					'#bf360c',
				]
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
		}
	</script>
@endsection
