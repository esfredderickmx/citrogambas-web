@extends('layouts.app-master')

@section('title', 'Preguntas frecuentes | Citrogambas')

@section('breadcrumb', 'faq')

@section('content')
	<div class="section padding container bottom-40">
		<h1 class="header orange-text text-darken-4">Preguntas frecuentes</h1>
		<p class="flow-text">
			En Citrogambas, nos esforzamos por brindar el mejor servicio y experiencia a nuestros clientes. Sabemos que es
			importante estar al tanto de todo lo que ofrecemos y responder a las preguntas que puedan tener nuestros clientes. Por
			eso, hemos creado esta sección de preguntas frecuentes, donde podrás encontrar información detallada sobre nuestros
			servicios, reservaciones, menú, promociones y mucho más. Esperamos que esta sección sea de gran ayuda y puedas
			resolver todas tus dudas. Si tienes alguna otra pregunta, no dudes en ponerte en contacto con nosotros a través de
			nuestro sitio web, redes sociales o por teléfono. ¡Estamos aquí para ayudarte!
		</p>
		<ul class="collapsible popout">
			<li class="active">
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Cuáles son los horarios de Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Los horarios de Citrogambas varían según la temporada y las
						festividades. Siempre publicamos nuestros horarios actualizados en nuestro sitio web y en nuestras redes sociales
						para que puedas planificar tu visita con anticipación, aunque, en general, nuestro horario de atención es de lunes
						a viernes de 8:00am a 10:00pm, los sábados de 9:00am a 12:00am, y los domingos de 10:00am a 10:00pm.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Qué tipos de bebidas sirven en Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Ofrecemos una amplia variedad de bebidas en Citrogambas, desde
						cocteles clásicos hasta creaciones únicas de nuestra casa. En nuestro sitio web, puedes encontrar nuestro menú de
						bebidas completo con descripciones detalladas, fotos y precios.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen opciones sin alcohol?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, contamos con una selección de bebidas sin alcohol para
						aquellos que prefieren evitar el alcohol. Puedes encontrar nuestras opciones sin alcohol en nuestro sitio web en la
						sección de "Bebidas sin Alcohol" en el menú de bebidas.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Puedo llevar a mis hijos a Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Por supuesto, en Citrogambas somos un lugar familiar y queremos
						que todos nuestros clientes se sientan bienvenidos. Aunque nuestro menú está diseñado para adultos, ofrecemos
						opciones para niños en caso de que deseen acompañar a sus padres. Sin embargo, ten en cuenta que nuestro ambiente
						es más bien de adultos y en ocasiones puede haber música y actividades que no sean apropiadas para niños muy
						pequeños. Si deseas llevar a tus hijos, te recomendamos hacerlo en horas tempranas y supervisarlos en todo momento.
						¡Esperamos verte pronto en Citrogambas!</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Es necesario hacer reservaciones?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">No es necesario hacer reservaciones, pero recomendamos hacer
						reservaciones, especialmente durante las horas punta, para garantizar que tengas una mesa asegurada. Puedes hacer
						tu reserva directamente en nuestro sitio web en la sección de "Reservaciones" en el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen opciones vegetarianas o veganas en su menú de alimentos?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, contamos con opciones vegetarianas y veganas en nuestro
						menú. En nuestro sitio web, puedes encontrar nuestro menú de alimentos completo con descripciones detalladas, fotos
						y precios, así como las opciones vegetarianas y veganas disponibles.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Aceptan tarjetas de crédito?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, aceptamos tarjetas de crédito, incluyendo Visa, Mastercard
						y American Express. Puedes consultar nuestros métodos de pago aceptados en la sección de "Información de Pago" en
						nuestro sitio web.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen opciones sin gluten en su menú de alimentos?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, contamos con opciones sin gluten en nuestro menú. En
						nuestro sitio web, puedes encontrar nuestras opciones sin gluten en la sección de "Menú sin Gluten" en el menú de
						alimentos.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Cuál es el precio promedio de una bebida en Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">El precio de las bebidas varía según el tipo de bebida, pero el
						precio promedio es de alrededor de $150 pesos. En nuestro sitio web, puedes encontrar nuestro menú de bebidas
						completo con precios actualizados.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen música en vivo en Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, contamos con música en vivo en ocasiones especiales. Puedes
						encontrar nuestro calendario de eventos en nuestro sitio web en la sección de "Eventos" en el menú
						principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Ofrecen promociones especiales en días festivos?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, ofrecemos promociones especiales en días festivos. Puedes
						encontrar información sobre nuestras promociones actuales en nuestro sitio web en la sección de "Promociones" en el
						menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Ofrecen descuentos para grupos grandes?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, ofrecemos descuentos para grupos de 10 personas o más. Para
						obtener más información sobre nuestras opciones de grupo, por favor contáctanos directamente a través de nuestro
						sitio web o por teléfono.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Ofrecen servicios de catering para eventos?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, ofrecemos servicios de catering para eventos. Puedes
						encontrar más información sobre nuestros servicios de catering en nuestro sitio web en la sección de "Catering" en
						el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Cuál es la política de cancelación para las reservaciones?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Si necesitas cancelar una reservación, te pedimos que nos
						avises con anticipación para que podamos darle tu mesa a otra persona. En nuestro sitio web, puedes encontrar
						nuestra política de cancelación en la sección de "Reservaciones" en el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen un programa de lealtad para clientes frecuentes?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, tenemos un programa de lealtad para clientes frecuentes
						llamado "CitroPuntos". Puedes encontrar más información sobre nuestro programa de lealtad en nuestro sitio web en
						la sección de "CitroPuntos" en el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Cuál es el código de vestimenta en Citrogambas?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">No tenemos un código de vestimenta estricto en Citrogambas. Nos
						enorgullece ser un lugar donde la gente pueda ser cómoda y relajarse. Dicho esto, sugerimos que los clientes eviten
						usar ropa inapropiada o incómoda. Para eventos especiales, como bodas o cenas formales, el dress code puede
						requerir ropa más formal, pero esto se anunciará previamente.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen opciones de delivery o para llevar?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, ofrecemos opciones de delivery y para llevar. Puedes hacer
						tu pedido en línea en nuestro sitio web en la sección de "Delivery y Para Llevar" en el menú principal.</span>
				</div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen opciones de eventos privados?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, contamos con opciones de eventos privados para grupos
						grandes. Puedes encontrar más información sobre nuestros servicios de eventos privados en nuestro sitio web en la
						sección de "Eventos Privados" en el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Puedo comprar los ingredientes de los cocteles en línea?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">No ofrecemos la venta de ingredientes de los cocteles en línea,
						pero si tienes alguna duda sobre cómo preparar tus cocteles favoritos en casa, puedes consultar nuestro blog en
						nuestro sitio web en la sección de "Blog" en el menú principal.</span></div>
			</li>
			<li>
				<div class="collapsible-header yellow lighten-4 brown-text">
					<h4 class="header margin all-20">¿Tienen una política de responsabilidad social corporativa?</h4>
				</div>
				<div class="collapsible-body"><span class="flow-text">Sí, en Citrogambas estamos comprometidos con la responsabilidad
						social corporativa. Puedes encontrar más información sobre nuestras prácticas de responsabilidad social en nuestro
						sitio web en la sección de "Responsabilidad Social" en el menú principal.</span></div>
			</li>
		</ul>
	</div>
@endsection
