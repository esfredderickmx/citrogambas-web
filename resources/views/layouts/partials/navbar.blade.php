<div class="navbar-fixed">
	<nav class="orange darken-3">
		<div class="nav-wrapper container">
			<a class="brand-logo brown-text logotipo" href="{{ route('index') }}">CITROGAMBAS</a>
			<a class="sidenav-trigger" data-target="mobile-nav"><i class="material-icons-round">menu</i></a>
			<ul class="right hide-on-med-and-down hide-on-large">
				<li {{-- class="{{ Route::currentRouteName()=='home' ? 'active' : '' }}" --}}><a href="{{ route('home') }}">Inicio</a></li>
				<li><a class="dropdown-trigger" data-target="services">
						Nuestros servicios<i class="material-icons-round right">arrow_drop_down</i>
					</a></li>
				@auth
					<li><a class="dropdown-trigger" data-target="user">
							{{ Auth::user()->first_name ? strtok(Auth::user()->first_name, ' ') . ' ' . strtok(Auth::user()->last_name, ' ') : Auth::user()->username }}<i class="material-icons-round right">arrow_drop_down</i>
						</a></li>
				@endauth
				@guest
					<li><a class="modal-trigger" href="#auth-login">Iniciar sesión</a></li>
				@endguest
			</ul>
		</div>
	</nav>
</div>

<ul class="dropdown-content yellow darken-3" id="services">
	<li><a class="grey-text text-darken-4" href="{{ route('dishes') }}">Comida</a></li>
	<li><a class="grey-text text-darken-4" href="{{ route('reservations') }}">Reservaciones</a></li>
</ul>
@auth
	<ul class="dropdown-content yellow darken-3" id="user">
		<li><a class="grey-text text-darken-4" href="{{ route('profile') }}">Perfil de usuario</a></li>
		@if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
			<li><a class="grey-text text-darken-4" href="{{ route('users') }}">Control de usuarios</a></li>
		@endif
		<li class="divider brown"></li>
		<li><a class="grey-text text-darken-4" href="{{ route('logout') }}">Cerrar sesión</a></li>
	</ul>
@endauth

<ul class="sidenav yellow lighten-4 collapsible" id="mobile-nav">
	<h4 class="header brown-text margin all-40">Menú de navegación</h4>
	<li><a class="collapsible-header waves-effect" href="{{ route('home') }}"><i class="material-icons-round">home</i>Inicio</a></li>
	<li class="active">
		<a class="collapsible-header waves-effect"><i class="material-icons-round">storefront</i>Nuestros servicios</a>
		<ul class="collapsible-body yellow lighten-4">
			<li><a class="waves-effect" href="{{ route('dishes') }}"><i class="material-icons-round">restaurant</i>Comida</a></li>
			<li><a class="waves-effect" href="{{ route('reservations') }}"><i class="material-icons-round">event_seat</i>Reservaciones</a></li>
			<li>
				<div class="divider brown no-margin"></div>
			</li>
		</ul>
	</li>
	@auth
		<li>
			<a class="collapsible-header waves-effect"><i class="material-icons-round">person</i>{{ Auth::user()->first_name ? strtok(Auth::user()->first_name, ' ') . ' ' . strtok(Auth::user()->last_name, ' ') : Auth::user()->username }}</a>
			<ul class="collapsible-body yellow lighten-4">
				<li><a class="waves-effect" href="{{ route('profile') }}"><i class="material-icons-round">account_circle</i>Perfil de usuario</a></li>
				@if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
					<li><a class="waves-effect" href="{{ route('users') }}"><i class="material-icons-round">manage_accounts</i>Control de usuarios</a></li>
				@endif
				<li>
					<div class="divider brown no-margin"></div>
				</li>
				<li><a class="waves-effect" href="{{ route('logout') }}"><i class="material-icons-round">logout</i>Cerrar sesión</a></li>
			</ul>
		</li>
	@endauth
	@guest
		<li><a class="collapsible-header waves-effect modal-trigger" href="#auth-login"><i class="material-icons-round">login</i>Iniciar sesión</a></li>
	@endguest
</ul>
