@extends('layouts.app-master')

@section('title', 'Control de usuarios | Citrogambas')

@section('content')
	<div class="section container">
    @livewire('user.show-users')
	</div>
@endsection
