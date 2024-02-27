<div class="modal modal-fixed-footer" id="create-dish" style="width: 30%; height: 80%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<div class="row no-margin">
			<h3 class="header brown-text margin all-20">Registrar un platillo nuevo</h3>
			<form action="{{ route('dish.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="input-field col s12">
          <i class="material-icons-round prefix">abc</i>
					<input id="name" name="name" type="text" autocomplete="off" required>
					<label for="name">Nombre del platillo</label>
				</div>
				<div class="file-field input-field col s12">
					<div class="btn orange darken-3">
						<span>Imagen</span>
						<input id="image" name="image" type="file" accept=".jpg, .jpeg, .png" required>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path" id="image_name" name="image_name" type="text" readonly placeholder="Seleccione una imagen referente al platillo" autocomplete="off" required>
					</div>
				</div>
				<div class="input-field col s12">
					<textarea class="materialize-textarea" id="description" name="description" data-length="250" autocomplete="off" maxlength="250" required></textarea>
					<label for="description">Descripción del platillo</label>
				</div>
				<div class="input-field col s5">
					<i class="material-icons-round prefix">price_change</i>
					<input id="price" name="price" type="number" step=".01" autocomplete="off" required>
					<label for="price">Precio por platillo</label>
				</div>
				<div class="input-field col s7">
          <i class="material-icons-round prefix">groups_3</i>
					<select id="audience" name="audience" required>
						<option disabled selected>Seleccione el público objetivo</option>
						<option value="childlike">Infantil</option>
						<option value="mature">Adulto</option>
						<option value="elder">Edad avanzada</option>
						<option value="general">General</option>
					</select>
					<label for="audience">Público objetivo</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">wb_twilight</i>
					<select id="season" name="season" required>
						<option disabled selected>Seleccione el momento ideal del año para consumir el platillo
						</option>
						<option value="winter">Invierno</option>
						<option value="spring">Primavera</option>
						<option value="summer">Verano</option>
						<option value="autumn">Otoño</option>
						<option value="cold">Estaciones frias</option>
						<option value="hot">Estaciones cálidas</option>
						<option value="any">Cualquiera</option>
					</select>
					<label for="season">Estación del año ideal</label>
				</div>
				<div class="input-field col s12">
          <i class="material-icons-round prefix">style</i>
					<select id="categories" name="categories[]" multiple required>
						<option disabled>Seleccione al menos una categoría</option>
						@foreach ($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
					<label for="categories[]">Categorías en las que clasifica el platillo</label>
				</div>
		</div>
	</div>
	<div class="modal-footer brown">
		<button class="btn orange darken-3 waves-effect waves-light" type="submit">Registrar platillo</button>
		<button class="btn-flat transparent white-text waves-effect waves-light modal-close" type="reset">Cancelar</button>
		</form>
	</div>
</div>
