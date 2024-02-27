<div class="modal modal-fixed-footer" id="edit-dish-{{ $dish->id }}" style="width: 30%; height: 80%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<div class="row no-margin">
			<h3 class="header brown-text margin all-20">Editar la info. del platillo</h3>
			<form action="{{ route('dish.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="input-field col s12">
          <i class="material-icons-round prefix">abc</i>
					<input id="new_name" name="new_name" type="text" value="{{ $dish->name }}" autocomplete="off" required>
					<label for="new_name">Nombre del platillo</label>
				</div>
				<div class="file-field input-field col s12">
					<div class="btn orange darken-3">
						<span>Imagen</span>
						<input id="new_image" name="new_image" type="file" accept=".jpg, .jpeg, .png">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path" id="new_image_name" name="new_image_name" type="text" readonly placeholder="Puede seleccionar una nueva imagen para al platillo" autocomplete="off">
					</div>
				</div>
				<div class="input-field col s12">
					<textarea class="materialize-textarea" id="new_description" name="new_description" data-length="250" autocomplete="off" maxlength="250" required>{{ $dish->description }}</textarea>
					<label for="new_description">Descripción del platillo</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons-round prefix">price_change</i>
					<input id="new_price" name="new_price" type="number" value="{{ number_format($dish->price, 2) }}" step=".01" autocomplete="off" required>
					<label for="new_price">Precio por platillo</label>
				</div>
				<div class="input-field col s6">
          <i class="material-icons-round prefix">groups_3</i>
					<select id="new_audience" name="new_audience" required>
						<option value="childlike" {{ $dish->audience === 'childlike' ? 'selected' : '' }}>Infantil</option>
						<option value="mature" {{ $dish->audience === 'mature' ? 'selected' : '' }}>Adulto</option>
						<option value="elder" {{ $dish->audience === 'elder' ? 'selected' : '' }}>Edad avanzada</option>
						<option value="general" {{ $dish->audience === 'general' ? 'selected' : '' }}>General</option>
					</select>
					<label for="new_audience">Público objetivo</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">wb_twilight</i>
					<select id="new_season" name="new_season" required>
						<option value="winter" {{ $dish->season === 'winter' ? 'selected' : '' }}>Invierno</option>
						<option value="spring" {{ $dish->season === 'spring' ? 'selected' : '' }}>Primavera</option>
						<option value="summer" {{ $dish->season === 'summer' ? 'selected' : '' }}>Verano</option>
						<option value="autumn" {{ $dish->season === 'autumn' ? 'selected' : '' }}>Otoño</option>
						<option value="cold" {{ $dish->season === 'cold' ? 'selected' : '' }}>Estaciones frias</option>
						<option value="hot" {{ $dish->season === 'hot' ? 'selected' : '' }}>Estaciones cálidas</option>
						<option value="any" {{ $dish->season === 'any' ? 'selected' : '' }}>Cualquiera</option>
					</select>
					<label for="new_season">Estación del año ideal</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">style</i>
					<select id="new_categories" name="new_categories[]" multiple required>
						@foreach ($categories as $category)
							<option value="{{ $category->id }}" @foreach ($dish->categories as $category_dish) {{ $category_dish->id === $category->id ? 'selected' : '' }} @endforeach>{{ $category->name }}</option>
						@endforeach
					</select>
					<label for="new_categories[]">Categorías en las que clasifica el platillo</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Actualizar info.</button>
		<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
