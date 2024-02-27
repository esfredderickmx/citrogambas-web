@section('title', 'Control de usuarios |')

<div class="section container">
	<h1 class="header orange-text text-darken-4 margin all-20">
		Lista de {{ Auth::user()->role === 'admin' ? 'usuarios' : 'consumidores' }}
	</h1>
	<form class="padding top-20" wire:submit.prevent="handleSearch">
		<div class="row no-margin valign-wrapper">
			<div class="input-field col s10 m7 l6 xl4" wire:ignore>
				<i class="material-icons-round prefix">person_search</i>
				<input id="search" name="search" type="text" value="{{ request('search') }}" wire:model.debounce.300ms="search" autocomplete="off" required>
				<label for="search">Buscar por nombre / apellido</label>
			</div>
			<div class="col s2 m5 l6 xl8 no-padding">
				@if ($search)
					<a class="btn-flat transparent waves-effect hide-on-small-only" wire:click="clearSearch">
						Limpiar búsqueda <i class="material-icons-round right">backspace</i>
					</a>
					<a class="btn-flat transparent waves-effect hide-on-med-and-up" wire:click="clearSearch">
						<i class="material-icons-round no-margin">backspace</i>
					</a>
				@endif
			</div>
		</div>
	</form>
	<div class="table-area">
		<table class="highlight responsive-table">
			<thead>
				<tr>
					<th></th>
					<th>Nombre / usuario</th>
					<th>Correo electrónico</th>
					<th>Teléfono</th>
				</tr>
			</thead>
			<tbody wire:loading.remove>
				@foreach ($users as $user)
					<tr class="tooltipped table-row" id="user-row-{{ $user->id }}" data-position="left" data-tooltip="{{ $user->role === 'admin' ? 'Administrador' : ($user->role === 'employee' ? 'Empleado' : 'Consumidor') }}">
						<td><i class="material-icons-round hide-on-med-and-down">{{ $user->role === 'admin' ? 'local_police' : ($user->role === 'employee' ? 'perm_identity' : 'restaurant') }}</i>
						</td>
						<td>
							{{ $user->first_name ? 'Nombre: ' . strtok($user->first_name, ' ') . ' ' . strtok($user->last_name, ' ') : 'Usuario: ' . $user->username }}
						</td>
						<td>{{ $user->email }}</td>
						<td>
							{{ $user->phone ?? 'No proporcionado' }}
						</td>
						<td class="right-align">
							<a class="btn brown waves-effect waves-light modal-trigger" href="#edit-user-{{ $user->id }}">
								<i class="material-icons-round left no-margin">edit</i>
							</a>
							@if (Auth::user()->role === 'admin')
								<a class="btn deep-orange darken-4 waves-effect waves-light modal-trigger" href="#delete-user-{{ $user->id }}">
									<i class="material-icons-round left no-margin">delete</i>
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div wire:loading.remove>
			@include('layouts.partials.area')
		</div>
		<div class="empty tbody-area">
			<div wire:loading>
				@include('layouts.partials.loader')
			</div>
		</div>
	</div>

	@foreach ($modals as $modal)
		{{-- Modal para editar usuarios --}}
		<div class="modal form" id="edit-user-{{ $modal->id }}">
			@livewire('user.edit-user', ['user' => $modal], key('edit-user-' . $modal->id))
		</div>

		{{-- Modal para eliminar usuarios --}}
		@if (Auth::user()->role === 'admin')
			<div class="modal form" id="delete-user-{{ $modal->id }}">
				@livewire('user.delete-user', ['user' => $modal], key('delete-user' . $modal->id))
			</div>
		@endif
	@endforeach

	@if (Auth::user()->role === 'admin')
		{{-- Modal para registrar usuarios --}}
		<div class="modal form fixed-footer-s" id="create-user">
			@livewire('user.create-user')
		</div>
	@endif

	{{ $users->links() }}

	{{-- Botón de acciones flotante --}}
	<div class="fixed-action-btn custom-fixed-fab">
		<a class="btn-floating btn-large orange darken-3 waves-effect waves-light tooltipped modal-trigger" data-position="left" data-tooltip="Agregar usuario" href="#create-user">
			<i class="large material-icons">add</i>
		</a>
	</div>

	<script>
		let lastInfo = null;
		let open = false;

		document.addEventListener('livewire:load', () => {
			document.getElementById('search').focus();
		});

		document.addEventListener('livewire:update', () => {
			reinitializeRowTooltips();

			var modals = document.querySelectorAll('.modal');
			modals.forEach(modal => {
				var instance = M.Modal.getInstance(modal);

				if (instance.isOpen) {
					open = true;
				}
			});

			if (!open) {
				document.getElementById('search').focus();
			} else {
				document.getElementById('search').blur();
			}

			open = false;
		});

		document.addEventListener('DOMContentLoaded', function() {
			Livewire.on('info', message => {
				if (!lastInfo) {
					lastInfo = M.toast({
						html: '<h6 class="no-margin"><i class="material-icons-round tiny">info_outline</i> ' + message + '</h6>',
						classes: 'orange lighten-4 black-text rounded',
						displayLength: 5000,
						completeCallback: () => {
							lastInfo = null;
						}
					});
				}
			});

			Livewire.on('success', message => {
				M.toast({
					html: '<h6 class="no-margin"><i class="material-icons-round tiny">check_circle_outline</i> ' + message + '</h6>',
					classes: 'green lighten-4 black-text rounded',
					displayLength: 5000
				});
			});

			Livewire.on('created', (entity, message) => {
				var modal = document.getElementById('create-' + entity);
				var instance = M.Modal.getInstance(modal);
				instance.close();

				Livewire.emit('refreshTable');

				setTimeout(() => {
					initMaterializeModals();
					Livewire.emit('success', message)
				}, 500);
			});

			Livewire.on('updated', (entity, id, message) => {
				var modal = document.getElementById('edit-' + entity + '-' + id);
				var instance = M.Modal.getInstance(modal);
				instance.close();

				Livewire.emit('refreshTable');

				setTimeout(() => {
					Livewire.emit('success', message)
				}, 500);
			});

			Livewire.on('deleted', (entity, id, message) => {
				var modal = document.getElementById('delete-' + entity + '-' + id);
				var instance = M.Modal.getInstance(modal);
				instance.close();

				Livewire.emit('refreshTable');

				setTimeout(() => {
					Livewire.emit('success', message)
					instance.destroy();
				}, 500);
			});

			Livewire.on('dismiss', () => {
				if (lastInfo) {
					lastInfo.dismiss();
					lastInfo = null;
				}
			});
		});
	</script>
</div>
