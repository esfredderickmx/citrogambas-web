<div class="modal" id="password-reset" data-open-modal="{{ session('openResetModal', false) }}" style="width: 25%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Restablecer contraseña</h3>
		<p class="margin all-20">¡Genial, has llegado al paso final para restablecer tu contraseña! Ingresa una nueva contraseña segura y confírmala para completar el proceso y recuperar el acceso a tu cuenta.</p>
		<div class="row no-margin">
			<form action="{{ route('password.update') }}" method="POST">
				@csrf
				<input class="hide" name="token" type="hidden" value="{{ session('token', null) }}">
				<div class="input-field col s12">
					<i class="material-icons-round prefix">alternate_email</i>
					<input id="reset_email" name="reset_email" type="email" value="{{ session('email', null) }}" readonly autocomplete="off" required>
					<label for="reset_email">Correo electrónico</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">password</i>
					<input id="reset_password" name="reset_password" type="password" autocomplete="off" required>
					<label for="reset_password">Contraseña</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons-round prefix">gpp_good</i>
					<input id="reset_password_confirmation" name="reset_password_confirmation" type="password" autocomplete="off" required>
					<label for="reset_password_confirmation">Confirmar contraseña</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Restablecer</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-trigger modal-close left" href="#auth-login">Iniciar sesión</a>
		</form>
	</div>
</div>
