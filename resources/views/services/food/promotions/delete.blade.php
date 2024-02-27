<div class="modal" id="delete-promotion-{{ $promotion->id }}" style="width: 30%;">
	<div class="modal-content yellow lighten-4 padding all-10">
		<h3 class="header brown-text margin all-20">Eliminar promoción seleccionada</h3>
		<p class="flow-text padding all-10 no-margin">¿Está seguro de que desea eliminar la promoción "{{ $promotion->code }}"?</p>
	</div>
	<div class="modal-footer brown">
		<form action="{{ route('promotion.destroy', $promotion->id) }}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn red darken-4 waves-effect waves-light modal-close" type="submit">Sí, eliminar</button>
			<a class="btn-flat transparent white-text waves-effect waves-light modal-close">Cancelar</a>
		</form>
	</div>
</div>
