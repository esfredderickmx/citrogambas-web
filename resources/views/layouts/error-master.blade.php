<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title')</title>
	<link href="{{ url('assets/css/materialize.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
	<link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
</head>

<body class="amber lighten-5">
	<div class="error-semicentro">
		<h1 class="orange-text text-darken-4 logotipo">ERROR @yield('code')</h1>
		<div class="divider brown"></div>
		<h3 class="header brown-text no-margin">@yield('message')</h3>
		<a class="btn-flat transparent waves-effect right" href="/home">Volver</a>
	</div>
	<script src="{{ url('assets/js/materialize.min.js') }}"></script>
	<script src="{{ url('assets/js/script.js') }}"></script>
</body>

</html>
