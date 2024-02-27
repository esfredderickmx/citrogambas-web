@if (Session::get('area', false))
	@php
		$message = Session::get('area');
	@endphp
	<div class="yellow lighten-5 center-align empty tbody-area">
		<h5>{{ $message }}</h5>
	</div>
@endif
