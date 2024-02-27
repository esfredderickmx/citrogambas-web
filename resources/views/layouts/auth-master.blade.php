<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title')</title>
	<link href="{{ url('assets/css/materialize.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
</head>

<body class="yellow lighten-5">
	@include('layouts.partials.navbar')

	<main>
		@yield('content')
	</main>

	@include('layouts.partials.footer')

	<script src="{{ url('assets/js/materialize.min.js') }}"></script>
	<script src="{{ url('assets/js/script.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRPZOjcSdOe9aiFWpVnpSRo2pjfI6Esg&callback=initMap" async
		defer></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRPZOjcSdOe9aiFWpVnpSRo2pjfI6Esg&libraries=places">
	</script>
</body>

</html>
