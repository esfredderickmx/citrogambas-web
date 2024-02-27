<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', isset($title) ? $title : '') Citrogambas</title>
	<link href="{{ url('assets/css/materialize.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/mstepper.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	@livewireStyles
</head>

<body class="yellow lighten-5">
	@include('layouts.partials.navbar')

	@if (Route::currentRouteName() !== 'home' && Route::currentRouteName() !== 'index' && Route::currentRouteName() !== 'auth.form')
		{{ Breadcrumbs::render() }}
	@endif

	@guest
		@include('auth.login')
		@include('auth.register')
		@include('auth.password.forgot')
		@include('auth.password.reset')
	@endguest

	<main>
    {{ $slot }}
		@yield('content')
	</main>

	@include('layouts.partials.footer')

	<script src="{{ url('assets/js/materialize.min.js') }}"></script>
	<script src="{{ url('assets/js/mstepper.min.js') }}"></script>
	<script src="{{ url('assets/js/script.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRPZOjcSdOe9aiFWpVnpSRo2pjfI6Esg&callback=initMap" async defer></script>
	@livewireScripts
</body>

</html>
