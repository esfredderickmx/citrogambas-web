@extends('layouts.app-master')

@section('title', 'Perfil de usuario | Citrogambas')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Perfil de usuario</h1>
		@include('layouts.partials.messages')
		<h3 class="header brown-text">Actualizar información del perfil</h3>
		<p>¡Mantenga su información actualizada! Complete los campos a continuación para editar su perfil. Asegúrese de que su información sea precisa para que podamos brindarle una experiencia personalizada.</p>
		<div class="row">
			<div class="col s8 no-padding">
				<form action="{{ route('profile.update') }}" method="POST">
					@csrf
					@method('PUT')
					<div class="input-field col s4">
						<input id="first_name" name="first_name" type="text" value="{{ Auth::user()->first_name }}" autocomplete="off" autofocus required>
						<label for="first_name">Nombre(s)</label>
					</div>
					<div class="input-field col s4">
						<input id="last_name" name="last_name" type="text" value="{{ Auth::user()->last_name }}" autocomplete="off" required>
						<label for="last_name">Apellido(s)</label>
					</div>
					<div class="input-field col s4">
						<input id="phone" name="phone" type="tel" value="{{ Auth::user()->phone }}" autocomplete="off" pattern="[0-9]{10}" minlength="10" maxlength="10" required>
						<label for="phone">Número de teléfono</label>
					</div>
					<div class="input-field col s6">
						<input id="username" name="username" type="text" value="{{ Auth::user()->username }}" autocomplete="off" required>
						<label for="username">Nombre de usuario</label>
					</div>
					<div class="input-field col s6">
						<input id="email" name="email" type="email" value="{{ Auth::user()->email }}" autocomplete="off" required>
						<label for="email">Correo electrónico</label>
					</div>
			</div>
		</div>
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar perfil</button>
		</form>
	</div>

	<div class="section padding container top-40 bottom-40">
		<h3 class="header brown-text">Actualizar contraseña</h3>
		<p>¡Es importante mantener su cuenta segura! Cambie su contraseña periódicamente para proteger su información. Complete los campos a continuación para actualizar su contraseña.</p>
		<div class="row">
			<form action="{{ route('profile.password') }}" method="POST">
				@csrf
				@method('PUT')
				<div class="col s8 no-padding">
					<div class="input-field col s12">
						<input id="current_password" name="current_password" type="password" autocomplete="off" required>
						<label for="current_password">Contraseña actual</label>
					</div>
					<div class="input-field col s6">
						<input id="password" name="password" type="password" autocomplete="off" required>
						<label for="password">Contraseña nueva</label>
					</div>
					<div class="input-field col s6">
						<input id="password_confirmation" name="password_confirmation" type="password" autocomplete="off" required>
						<label for="password_confirmation">Confirmar contraseña</label>
					</div>
				</div>
		</div>
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar contraseña</button>
		</form>
	</div>

	<div class="section padding container top-40 bottom-40">
		<h3 class="header brown-text">Acciones de la cuenta</h3>
		<p>Sentimos mucho verle en esta situación. Si decide eliminar su cuenta, tenga presente que se perderá toda la información asociada a ella, incluyendo sus compras, historial de pagos y preferencias de la cuenta. Si está seguro de querer continuar, haga clic en el botón de abajo para proceder con la eliminación de la cuenta.</p>
		<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#confirm-delete-account">
			<i class="material-icons-round left">delete</i>Eliminar cuenta
		</a>

		<div class="modal" id="confirm-delete-account" style="width: 30%;">
			<div class="modal-content yellow lighten-4 padding all-10">
				<h3 class="header brown-text margin all-20">Eliminar cuenta de usuario</h3>
				<p class="flow-text padding all-10 no-margin">¿Está seguro de que desea eliminar su cuenta permanentemente? Tenga en cuenta que esta acción no se puede deshacer. Si está seguro, escriba su contraseña en el campo de abajo y, a continuación, haga clic en "Sí, eliminar mi cuenta".</p>
				<div class="row no-margin">
					<form action="{{ route('profile.destroy') }}" method="POST">
						@csrf
						@method('DELETE')
						<div class="input-field col s7 offset-s2">
							<i class="material-icons-round prefix">password</i>
							<input id="password_destroy" name="password_destroy" type="password" autocomplete="off" required>
							<label for="password_destroy">Contraseña</label>
						</div>
				</div>
			</div>
			<div class="modal-footer brown">
				<button class="btn red darken-4 waves-effect waves-light" type="submit">Sí, eliminar mi cuenta</button>
				<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
@endsection
