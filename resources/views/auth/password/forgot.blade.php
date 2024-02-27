<div class="modal" id="password-forgot" style="width: 25%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Solicitar restablecimiento</h3>
		<p class="margin all-20">¿Olvidaste tu contraseña? No te preocupes, estamos aquí para ayudarte a recuperar el acceso a tu cuenta. Ingresa tu dirección de correo electrónico asociada con tu cuenta y te enviaremos un enlace para restablecer tu contraseña.</p>
		<div class="row no-margin">
			<form action="{{ route('password.forgot') }}" method="POST">
				@csrf
				<div class="input-field col s12">
					<i class="material-icons-round prefix">email</i>
					<input id="forgot_email" name="forgot_email" type="email" autocomplete="off" required>
					<label for="forgot_email">Correo electrónico</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Solicitar</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-trigger modal-close left" href="#auth-login">Iniciar sesión</a>
		</form>
	</div>
</div>
