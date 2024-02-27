@extends('layouts.app-master')

@section('title', 'Contacto | Citrogambas')

@section('content')
	<form action="/contact" method="POST">
		@csrf
		<div class="formulario-padre padding bottom-40">
			<div class="card formulario-centro yellow lighten-4">
				<div class="row">
					<h3 class="header brown-text margin all-20">Formulario de contacto</h3>
					<p class="margin all-20">Nos encantaría escuchar de ti. Si tienes alguna pregunta, comentario o sugerencia, no dudes
						en contactarnos. Por favor, completa el formulario a continuación y nos comunicaremos contigo lo antes posible.</p>
					@include('layouts.partials.messages')
					<div class="input-field col s12">
						<input id="name" name="name" type="text" autocomplete="off" autofocus required>
						<label for="name">Nombre personal</label>
					</div>
					<div class="input-field col s12">
						<input id="email" name="email" type="email" autocomplete="off" required>
						<label for="email">Correo electrónico</label>
					</div>
					<div class="input-field col s12">
						<input id="subject" name="subject" type="text" autocomplete="off" required>
						<label for="subject">Asunto</label>
					</div>
					<div class="input-field col s12">
						<textarea class="materialize-textarea" id="message" name="message" data-length="250" autocomplete="off"
						 maxlength="250" required></textarea>
						<label for="message">Mensaje</label>
					</div>
					<div class="campo-captcha col s12">
						{!! NoCaptcha::renderJS() !!}
						{!! NoCaptcha::display() !!}
					</div>
				</div>
				<div class="card-action brown">
					<button class="btn orange darken-3 waves-effect waves-light" type="submit">Enviar mensaje</button>
					<a class="btn-flat transparent white-text waves-effect waves-light" href="/home">Volver al inicio</a>
				</div>
			</div>
		</div>
	</form>
@endsection
