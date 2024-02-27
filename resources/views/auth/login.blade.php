<div class="modal" id="auth-login" data-open-modal="{{ session('openLoginModal', false) }}" style="width: 25%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Iniciar sesión</h3>
		<div class="row no-margin">
			<form action="{{ route('auth.login') }}" method="POST">
				@csrf
				<div class="input-field col s12">
					<i class="material-icons-round prefix">alternate_email</i>
					<input id="login_username" name="login_username" type="text" autocomplete="off" required>
					<label for="login_username">Usuario / correo electrónico</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">password</i>
					<input id="login_password" name="login_password" type="password" autocomplete="off" required>
					<label for="login_password">Contraseña</label>
					<a class="margin all-20 orange-text text-darken-3 modal-trigger modal-close" href="#password-forgot"><strong>Olvidé mi contraseña</strong></a>
				</div>
				<label class="margin all-40">
					<input class="filled-in" id="login_remember" name="login_remember" type="checkbox" />
					<span>Mantener sesión iniciada</span>
				</label>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Acceder</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-trigger modal-close left" href="#auth-register">Registrarse</a>
		</form>
	</div>
</div>
