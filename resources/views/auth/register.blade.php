<div class="modal" id="auth-register" style="width: 25%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Registrarse en el sitio</h3>
		<div class="row no-margin">
			<form action="{{ route('auth.register') }}" method="POST">
				@csrf
				<div class="input-field col s12">
					<i class="material-icons-round prefix">alternate_email</i>
					<input id="register_username" name="register_username" type="text" autocomplete="off" required>
					<label for="register_username">Nombre de usuario</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">email</i>
					<input id="register_email" name="register_email" type="email" autocomplete="off" required>
					<label for="register_email">Correo electrónico</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">password</i>
					<input id="register_password" name="register_password" type="password" autocomplete="off" required>
					<label for="register_password">Contraseña</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">gpp_good</i>
					<input id="register_password_confirmation" name="register_password_confirmation" type="password" autocomplete="off" required>
					<label for="register_password_confirmation">Confirmar contraseña</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrarse</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-trigger modal-close left" href="#auth-login">Iniciar sesión</a>
		</form>
	</div>
</div>
