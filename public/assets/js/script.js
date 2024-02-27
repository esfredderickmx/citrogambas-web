document.addEventListener('DOMContentLoaded', function () {
  // Obtener el elemento select
  var select = document.getElementById("categories");

  // Obtener el primer option
  var first_option = select.options[0];

  // Agregar el atributo deseado
  first_option.setAttribute("selected", "");

  select.addEventListener("change", function () {
    // Obtener el primer option
    var first_option = select.options[0];

    // Verificar si hay opciones seleccionadas
    if (select.selectedIndex === -1) {
      // Agregar el atributo deseado al primer option
      first_option.setAttribute("selected", "");
    } else {
      // Quitar el atributo deseado al primer option
      first_option.removeAttribute("selected");
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  // Obtener todos los elementos select
  const containers = document.querySelectorAll('.input-field');

  // Iterar sobre cada elemento select y agregar un evento focus
  for (let container of containers) {
    const selects = container.getElementsByTagName("select");

    for (let select of selects) {
      const icono = select.previousElementSibling;
      let timeout = null;

      select.addEventListener("change", function () {
        icono.classList.add("active");

        // Cancelar cualquier llamada anterior a setTimeout()
        if (timeout) {
          clearTimeout(timeout);
        }

        // Establecer una nueva llamada a setTimeout()
        timeout = setTimeout(function () {
          icono.classList.remove("active");
        }, 1000);
      });
    }
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var codeInputs = document.querySelectorAll('input[name="code"], input[name="new_code"]');

  codeInputs.forEach(function (input) {
    input.addEventListener('input', function () {
      this.value = this.value.toUpperCase();
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.dropdown-trigger');
  var instances = M.Dropdown.init(elems, {
    coverTrigger: false
  });
});

document.addEventListener('DOMContentLoaded', function () {
  initMaterializeModals();
});

function initMaterializeModals() {
  M.Modal.init(document.querySelectorAll('.modal'), {
    dismissible: false,
    onOpenStart: function () {
      M.updateTextFields();
    }
  });
  initializeMaterializeForms();
}

let rowTooltips = null;

function initializeMaterializeForms() {
  M.updateTextFields();
  M.CharacterCounter.init(document.querySelectorAll('textarea'));
  M.FormSelect.init(document.querySelectorAll('select'));
  M.Datepicker.init(document.querySelectorAll('.datepicker'), {
    container: 'body',
    autoClose: true,
    showDaysInNextAndPreviousMonths: true,
    yearRange: 2,
    minDate: new Date(),
    format: 'dd mmmm, yyyy',
    i18n: {
      'cancel': 'Cancelar',
      'clear': 'Limpiar',
      'done': 'Ok',
      'previousMonth': '‹',
      'nextMonth': '›',
      'months': [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
      ],
      'monthsShort': [
        'Ene',
        'Feb',
        'Mar',
        'Abr',
        'May',
        'Jun',
        'Jul',
        'Ago',
        'Sep',
        'Oct',
        'Nov',
        'Dic'
      ],
      'weekdays': [
        'Domingo',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado'
      ],
      'weekdaysShort': [
        'Dom',
        'Lun',
        'Mar',
        'Mié',
        'Jue',
        'Vie',
        'Sáb'
      ],
      'weekdaysAbbrev': ['D', 'L', 'M', 'X', 'J', 'V', 'S']
    },
    onOpen: function () {
      // Comprobar si el atributo value del elemento actual no está vacío
      if (this.el.value) {
        var date_value = this.el.value;

        // Agregar 'T00:00:00' al valor de la fecha para evitar problemas de zona horaria
        var parsed_date = new Date(date_value + 'T00:00:00');

        // Establecer la fecha seleccionada utilizando el método setDate
        this.setDate(parsed_date);
      } else {
        // Limpiar la fecha seleccionada en el datepicker
        this.setDate();
      }
    },
    onClose: function () {
      document.getElementById('second-continue').disabled = !document.getElementById('persons').selectedIndex || !this.el.value || !document.getElementById('time').value;
    }
  });
  M.Timepicker.init(document.querySelectorAll('.timepicker'), {
    container: 'body',
    autoClose: true,
    twelveHour: true,
    i18n: {
      'cancel': 'Cancelar',
      'clear': 'Limpiar',
      'done': 'Ok',
    },
    onCloseEnd: function () {
      document.getElementById('second-continue').disabled = !document.getElementById('persons').selectedIndex || !document.getElementById('date').value || !this.el.value;
    }
  });

  // Mover los elementos desplegables al contenedor principal para que puedan mostrarse por encima de los modales
  const dropdownContents = document.querySelectorAll(".dropdown-content");
  dropdownContents.forEach((dropdownContent) => {
    document.body.appendChild(dropdownContent);
  });
}

function reinitializeRowTooltips() {
  if (rowTooltips !== null) {
    rowTooltips.forEach(elem => {
      var instance = M.Tooltip.getInstance(elem);

      if (instance.isOpen) {
        instance.close();
      }
      instance.destroy();
    });
  }

  rowTooltips = document.querySelectorAll('.table-row');

  M.Tooltip.init(rowTooltips, {
    outDuration: 200
  });
}

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.tooltipped');
  var instances = M.Tooltip.init(elems, {
    outDuration: 200
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.collapsible');
  var instances = M.Collapsible.init(elems, {
    accordion: false
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.fixed-action-btn');
  var instances = M.FloatingActionButton.init(elems, {
    hoverEnabled: false
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, {
    draggable: false
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.tabs');
  var instance = M.Tabs.init(elems, {
    swipeable: false
  });
});

document.addEventListener('DOMContentLoaded', function () {
  // Inicializa el stepper
  var stepper = document.querySelector('.stepper');
  var stepperInstance = new MStepper(stepper, {
    // Configuración del stepper
    firstActive: 0,
    linearStepsNavigation: false,
    autoFocusInput: true,
    autoFormCreation: false,
    stepTitleNavigation: false
  });

  // Recuperar el modal
  var modal = document.getElementById('create-reservation');
  var modalInstance = M.Modal.getInstance(modal);

  //Recuperar ambos pickers
  var datepicker = document.getElementById('date');
  var timepicker = document.getElementById('time');
  var datepickerInstance = M.Datepicker.getInstance(datepicker);

  //Inicializar elementos que se muestran, se ocultan o cambian
  var register_button = document.getElementById('register-button');
  var verify_button = document.getElementById('verify-button');
  var third_step_p = document.getElementById('third-step-p');

  // Eventos para habilitar o deshabilitar el botón del primer paso
  document.getElementById('table_id').addEventListener('change', function () {
    document.getElementById('first-continue').disabled = !this.value;

    var capacity = parseInt(this.options[this.selectedIndex].getAttribute('data-capacity'));
    var persons = document.getElementById('persons');
    persons.innerHTML = '<option disabled selected>Seleccione el número de personas</option>';

    for (var i = 1; i <= capacity; i++) {
      var option = document.createElement('option');
      option.value = i;
      option.textContent = i + ' personas';
      persons.appendChild(option);
    }

    document.getElementById('second-continue').disabled = true;

    if (verify_button.classList.contains('hide')) {
      third_step_p.textContent = 'Ya has verificado que todo esté correcto, sin embargo, has realizado algunos cambios. Utiliza el siguiente botón en caso de que desees volver confirmar los datos de la reservación para realizarla sin preocupaciones.';
    }

    register_button.classList.remove('scale-in');
    register_button.classList.add('scale-out');
    verify_button.classList.remove('hide');
    verify_button.classList.remove('scale-out');
    verify_button.classList.add('scale-in');

    M.FormSelect.init(persons);

    // Mover los elementos desplegables al contenedor principal para que puedan mostrarse por encima de los modales
    const dropdownContents = document.querySelectorAll(".dropdown-content");
    dropdownContents.forEach((dropdownContent) => {
      document.body.appendChild(dropdownContent);
    });
  });

  // Eventos para habilitar o deshabilitar el botón del segundo paso
  document.getElementById('persons').addEventListener('change', function () {
    document.getElementById('second-continue').disabled = !this.selectedIndex || !datepicker.value || !timepicker.value;
  });

  // Evento para ir al primer paso al hacer clic en el botón de verificar
  document.getElementById('verify-button').addEventListener('click', function () {
    stepperInstance.openStep(0);
    this.classList.remove('scale-in');
    this.classList.add('scale-out');

    setTimeout(function () {
      third_step_p.textContent = 'Ya has verificado que todo esté correcto, ahora puedes registrar la reservación sin preocupaciones.';
      verify_button.classList.add('hide');
    }, 500);
  });

  // Evento para mostrar el botón de registro al hacer clic en el botón second-continue
  document.getElementById('second-continue').addEventListener('click', function () {
    register_button.classList.remove('scale-out');
    register_button.classList.add('scale-in');
  });

  // Evento para reiniciar el formulario
  document.getElementById('cancel-button').addEventListener('click', function () {
    stepperInstance.resetStepper();

    setTimeout(function () {
      document.getElementById('first-continue').disabled = true;
      document.getElementById('second-continue').disabled = true;

      // Vuelve a ocultar el botón de registro
      register_button.classList.remove('scale-in');
      register_button.classList.add('scale-out');

      // Vuelve a mostrar el botón de verificar
      verify_button.classList.remove('hide');
      verify_button.classList.remove('scale-out');
      verify_button.classList.add('scale-in');

      //Reiniciar el texto del párrafo del tercer paso
      third_step_p.textContent = 'Por favor, utiliza el siguiente botón para revisar y poder confirmar los datos de la reservación antes de realizarla.';

      //Devolver el modal a la fecha actual
      datepickerInstance.gotoDate(new Date());

      // Cierra el modal después de la pausa
      modalInstance.close();
    }, 500); // Pausa de 500 ms
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var url = window.location.href;
  var modal = document.getElementById('auth-login');
  var open = modal.getAttribute('data-open-modal') === '1';

  if (url.includes('/login') || open) {
    var modalInstance = M.Modal.getInstance(modal);

    modalInstance.open();
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var url = window.location.href;
  var modal = document.getElementById('password-reset');
  var open = modal.getAttribute('data-open-modal') === '1';

  if (url.includes('/reset-password') || open) {
    var modalInstance = M.Modal.getInstance(modal);

    modalInstance.open();
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var selectElems = document.querySelectorAll('#new_role_null');
  var hiddenInputs = document.querySelectorAll('#new_role');

  selectElems.forEach((selectElem, index) => {
    var hiddenInput = hiddenInputs[index];

    selectElem.addEventListener('change', function () {
      hiddenInput.value = selectElem.options[selectElem.selectedIndex].value;
    });
  });
});

function initMap() {
  // Crea un mapa con los marcadores
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: { lat: 20.06361776097229, lng: -97.05387642287005 } // Coordenadas del centro del mapa
  });

  // Crea los marcadores en el mapa
  const marker1 = new google.maps.Marker({
    position: { lat: 20.064100807363808, lng: -97.05250850491545 }, // Coordenadas del primer marcador
    map: map,
    title: "Citrogambas", // Título del marcador
  });

  const marker2 = new google.maps.Marker({
    position: { lat: 20.07139943039899, lng: -97.06323168894897 }, // Coordenadas del segundo marcador
    map: map,
    title: "Citrogambas", // Título del marcador
  });

  const marker3 = new google.maps.Marker({
    position: { lat: 20.0614483930768, lng: -97.05462514661961 }, // Coordenadas del tercer marcador
    map: map,
    title: "Las Gambas", // Título del marcador
  });

  const marker4 = new google.maps.Marker({
    position: { lat: 20.063060843455, lng: -97.05700694806276 }, // Coordenadas del cuarto marcador
    map: map,
    title: "Las Gambas", // Título del marcador
  });

  // Crea el objeto DirectionsService
  const directionsService = new google.maps.DirectionsService();

  // Agrega un evento click a cada marcador
  marker1.addListener("click", () => {
    calculateAndDisplayRoute(map, directionsService, marker1.getPosition());
  });

  marker2.addListener("click", () => {
    calculateAndDisplayRoute(map, directionsService, marker2.getPosition());
  });

  marker3.addListener("click", () => {
    calculateAndDisplayRoute(map, directionsService, marker3.getPosition());
  });

  marker4.addListener("click", () => {
    calculateAndDisplayRoute(map, directionsService, marker4.getPosition());
  });
}

function calculateAndDisplayRoute(map, directionsService, destination) {
  // Obtiene la ubicación actual del usuario
  navigator.geolocation.getCurrentPosition((position) => {
    const origin = {
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    };

    // Llama al método route de DirectionsService para obtener las direcciones
    directionsService.route(
      {
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
      },
      (result, status) => {
        if (status === "OK") {
          // Crea un objeto DirectionsRenderer para mostrar las direcciones en el mapa
          const directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            directions: result,
          });
        } else {
          window.alert("No se encontraron direcciones para el marcador seleccionado.");
        }
      }
    );
  });
}
