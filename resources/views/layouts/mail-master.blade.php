<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Correo electrónico</title>
	<link href="{{ url('assets/css/materialize.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
	<link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
</head>

<body>
	<p><strong>Nombre del remitente: </strong>{{ $received['name'] }}</p>
	<p><strong>Dirección electrónico del remitente: </strong>{{ $received['email'] }}</p>
	<br>
	<h3>Mensaje:</h3>
	<p>{{ $received['message'] }}</p>
	<script src="{{ url('assets/js/materialize.min.js') }}"></script>
	<script src="{{ url('assets/js/script.js') }}"></script>
</body>

</html>
