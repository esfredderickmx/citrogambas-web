@if (Session::get('info', false))
	@php
		$infos = Session::get('info');
	@endphp
	<div class="margin all-10">
		<ul class="z-depth-1 orange lighten-3 border-radius-4 padding all-10 no-margin">
			@if (is_array($infos))
				@foreach ($infos as $info)
					<li>
						<h6 class="no-margin"><i class="material-icons-round tiny">info_outline</i> {{ $info }}</h6>
					</li>
				@endforeach
			@else
				<li>
					<h6 class="no-margin"><i class="material-icons-round tiny">info_outline</i> {{ $infos }}</h6>
				</li>
			@endif
		</ul>
	</div>
@endif

@if (Session::get('warning', false))
	@php
		$warnings = Session::get('warning');
	@endphp
	<div class="margin all-10">
		<ul class="z-depth-1 amber lighten-3 border-radius-4 padding all-10 no-margin">
			@if (is_array($warnings))
				@foreach ($warnings as $warning)
					<li>
						<h6 class="no-margin"><i class="material-icons-round tiny">warning_amber</i> {{ $warning }}</h6>
					</li>
				@endforeach
			@else
				<li>
					<h6 class="no-margin"><i class="material-icons-round tiny">warning_amber</i> {{ $warnings }}</h6>
				</li>
			@endif
		</ul>
	</div>
@endif

@if (Session::get('success', false))
	@php
		$successes = Session::get('success');
	@endphp
	<div class="margin all-10">
		<ul class="z-depth-1 green lighten-3 border-radius-4 padding all-10 no-margin">
			@if (is_array($successes))
				@foreach ($successes as $success)
					<li>
						<h6 class="no-margin"><i class="material-icons-round tiny">check_circle_outline</i> {{ $success }}</h6>
					</li>
				@endforeach
			@else
				<li>
					<h6 class="no-margin"><i class="material-icons-round tiny">check_circle_outline</i> {{ $successes }}</h6>
				</li>
			@endif
		</ul>
	</div>
@endif

@if (isset($errors) && count($errors) > 0)
	<div class="margin all-10">
		<ul class="z-depth-1 deep-orange lighten-3 border-radius-4 padding all-10 no-margin">
			@foreach ($errors->all() as $error)
				<li>
					<h6 class="no-margin"><i class="material-icons-round tiny">error_outline</i> {{ $error }}</h6>
				</li>
			@endforeach
		</ul>
	</div>
@endif
