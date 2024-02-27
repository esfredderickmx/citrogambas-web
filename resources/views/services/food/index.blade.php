@extends('layouts.app-master')

@section('title', 'Menú de alimentos y bebidas | Citrogambas')

@section('content')
	<div class="section padding container bottom-40 block">
		<h1 class="header orange-text text-darken-4">Menú de alimentos y bebidas</h1>
		<div class="row no-margin">
			<form class="col s12" style="display: flex;" action="{{ route('dishes') }}" method="GET">
				<div class="input-field inline" style="width: 30%;">
					<input id="search" name="search" type="text" value="{{ request('search') }}" autofocus autocomplete="off" required>
					<label for="search">Buscar alimento / bebida por nombre</label>
				</div>
				<div class="input-field inline">
					<button class="btn orange darken-3 waves-effect waves-light" type="submit">
						<i class="material-icons-round right no-margin">content_paste_search</i>
					</button>
					@if ($search)
						<a class="btn-flat transparent waves-effect" href="{{ route('dishes') }}">
              <i class="material-icons-round right">backspace</i>Limpiar búsqueda
            </a>
					@endif
				</div>
			</form>
		</div>
		@include('layouts.partials.messages')
		<div class="row">
			@foreach ($dishes as $dish)
				<div class="col s4">
					<div class="card sticky-action hoverable">
						<div class="card-image waves-effect waves-block waves-light" style="height: 375px;">
							<img class="activator" src="{{ url('assets/images/dishes/' . $dish->image) }}" style="height: 100%; object-fit: cover;">
						</div>
						<div class="fixed-action-btn @auth {{ Auth::user()->role !== 'consumer' ? 'admin-card-fab' : 'custom-card-fab' }} @endauth @guest custom-card-fab @endguest">
							<a class="btn-floating btn-large orange darken-3 waves-effect waves-light">
								<i class="large material-icons">add</i>
							</a>
						</div>
						<div class="card-content @auth {{ Auth::user()->role === 'consumer' ? 'custom-card-content' : '' }} @endauth @guest custom-card-content @endguest yellow lighten-4">
							@foreach ($dish->categories as $category)
								<div class="chip amber accent-3">
									<i class="material-icons-round tiny">{{ $category->icon }}</i>
								</div>
							@endforeach
							<span class="card-title truncate"><dfn>{{ $dish->name }}</dfn></span>
							<strong class="truncate">{{ $dish->description }}</strong>
						</div>
						@auth
							@if (Auth::user()->role !== 'consumer')
								<div class="card-action brown padding all-10 right-align">
									<button class="btn-flat transparent white-text waves-effect waves-light modal-trigger" href="#edit-dish-{{ $dish->id }}">
										<i class="material-icons-round left">edit</i>Editar info.
									</button>
									@if (Auth::user()->role === 'admin')
										<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#delete-dish-{{ $dish->id }}">
											<i class="material-icons-round left">delete</i>Eliminar
										</a>
									@endif
								</div>
							@endif
						@endauth
						<div class="card-reveal yellow lighten-5">
							<span class="card-title grey-text text-darken-4">
								<h5><strong><dfn>${{ number_format($dish->price, 2) }} MXN</dfn></strong></h5>
								<i class="material-icons-round tiny right">close</i>
							</span>
							<span class="grey-text text-darken-4">
								<h6><dfn>{{ $dish->name }}</dfn></h6>
							</span>
							<p>{{ $dish->description }}</p>
							@switch($dish->audience)
								@case('childlike')
									<div class="chip deep-purple lighten-4">
										<i class="material-icons-round tiny">escalator_warning</i> Para público infantil
									</div>
								@break

								@case('mature')
									<div class="chip brown lighten-4">
										<i class="material-icons-round tiny">hail</i> Para público adulto
									</div>
								@break

								@case('elder')
									<div class="chip pink lighten-4">
										<i class="material-icons-round tiny">elderly</i> Para adultos mayores
									</div>
								@break

								@default
									<div class="chip green lighten-4">
										<i class="material-icons-round tiny">groups_2</i> Para todo público
									</div>
							@endswitch
							@switch($dish->season)
								@case('winter')
									<div class="chip light-blue lighten-4">
										<i class="material-icons-round tiny">ac_unit</i> Ideal para invierno
									</div>
								@break

								@case('spring')
									<div class="chip red lighten-4">
										<i class="material-icons-round tiny">filter_vintage</i> Ideal para primavera
									</div>
								@break

								@case('summer')
									<div class="chip light-green lighten-4">
										<i class="material-icons-round tiny">beach_access</i> Ideal para verano
									</div>
								@break

								@case('autumn')
									<div class="chip orange lighten-4">
										<i class="material-icons-round tiny">forest</i> Ideal para otoño
									</div>
								@break

								@case('hot')
									<div class="chip deep-orange lighten-4">
										<i class="material-icons-round tiny">wb_sunny</i> Ideal en temporada de calor
									</div>
								@break

								@case('cold')
									<div class="chip blue-grey lighten-4">
										<i class="material-icons-round tiny">cloud</i> Ideal en temporada de frío
									</div>
								@break

								@default
									<div class="chip purple lighten-4">
										<i class="material-icons-round tiny">cloud_done</i> Ideal en todo momento
									</div>
							@endswitch
							<p><strong>Categoría(s) del platillo:</strong></p>
							@foreach ($dish->categories as $category)
								<div class="chip amber accent-3">
									<i class="material-icons-round tiny">{{ $category->icon }}</i> {{ $category->name }}
								</div>
							@endforeach
						</div>
					</div>
				</div>

				@auth
					{{-- Modal para editar platillos --}}
					@if (Auth::user()->role !== 'consumer')
						@include('services.food.edit')
					@endif

					{{-- Modal para eliminar platillos --}}
					@if (Auth::user()->role === 'admin')
						@include('services.food.delete')
					@endif
				@endauth
			@endforeach
		</div>

		@auth
			@if (Auth::user()->role !== 'consumer')
				{{-- Modal para registrar platillos --}}
				@include('services.food.create')
			@endif
		@endauth

		<ul class="pagination">
			@if ($dishes->onFirstPage())
				<li class="disabled"><a><i class="material-icons-round">chevron_left</i></a></li>
			@else
				<li class="waves-effect"><a href="{{ $dishes->previousPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_left</i></a></li>
			@endif

			@if ($dishes->currentPage() > 3)
				<li class="waves-effect"><a href="{{ $dishes->url(1) }}{{ !empty($search) ? '&search=' . $search : '' }}">1</a></li>
				@if ($dishes->currentPage() > 4)
					<li class="disabled"><a>...</a></li>
				@endif
			@endif

			@for ($i = max(1, $dishes->currentPage() - 2); $i <= min($dishes->currentPage() + 2, $dishes->lastPage()); $i++)
				@if ($i == $dishes->currentPage())
					<li class="active orange darken-3"><a>{{ $i }}</a></li>
				@else
					<li class="waves-effect"><a href="{{ $dishes->url($i) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $i }}</a></li>
				@endif
			@endfor

			@if ($dishes->currentPage() < $dishes->lastPage() - 2)
				@if ($dishes->currentPage() < $dishes->lastPage() - 3)
					<li class="disabled"><a>...</a></li>
				@endif
				<li class="waves-effect"><a href="{{ $dishes->url($dishes->lastPage()) }}{{ !empty($search) ? '&search=' . $search : '' }}">{{ $dishes->lastPage() }}</a>
				</li>
			@endif

			@if ($dishes->hasMorePages())
				<li class="waves-effect"><a href="{{ $dishes->nextPageUrl() }}{{ !empty($search) ? '&search=' . $search : '' }}"><i class="material-icons-round">chevron_right</i></a></li>
			@else
				<li class="disabled"><a><i class="material-icons-round">chevron_right</i></a></li>
			@endif
		</ul>
	</div>

	{{-- Botón de acciones flotante --}}
	@auth
		@if (Auth::user()->role !== 'consumer')
			<div class="fixed-action-btn custom-fixed-fab">
				<a class="btn-floating btn-large deep-orange darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Más opciones">
					<i class="large material-icons">more_vert</i>
				</a>
				<ul>
					<li>
						<a class="btn-floating btn-small yellow darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Administrar promociones" href="{{ route('promotions') }}">
							<i class="material-icons-round">local_activity</i>
						</a>
					</li>
					<li>
						<a class="btn-floating btn-small lime darken-3 tooltipped" data-position="left" data-tooltip="Administrar categorías" href="{{ route('categories') }}">
							<i class="material-icons-round">checklist</i>
						</a>
					</li>
					<li>
						<a class="btn-floating orange darken-3 tooltipped modal-trigger" data-position="left" data-tooltip="Agregar platillo" href="#create-dish">
							<i class="material-icons-round">add</i>
						</a>
					</li>
				</ul>
			</div>
		@endif
	@endauth
@endsection
