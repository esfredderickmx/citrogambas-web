<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReservationController extends Controller {
  public function show(Request $request) {
    $user = Auth::user();
    $search = $request->input('search');

    if ($user->role !== 'consumer') {
      if (!empty($search)) {
        $reservations = Reservation::whereHas('user', function ($query) use ($search) {
          $query->where('username', 'like', "%$search%");
        })->orderBy('date')->paginate(6);
      } else {
        $reservations = Reservation::orderBy('date')->paginate(6);
      }
    } else {
      /* if (!empty($search)) {
        $reservations = Reservation::whereHas('user', function ($query) use ($search) {
          $query->where('username', 'like', "%$search%");
        })->orderBy('date')->paginate(6);
      } else {
        $reservations = Reservation::whereHas('user', function ($query) use ($user) {
          $query->where('username', 'like', "%$user%");
        })->orderBy('date')->paginate(6);
      } */
      $reservations = Reservation::whereHas('user', function ($query) use ($user) {
        $query->where('username', 'like', "%$user->username%");
      })->orderBy('date')->paginate(6);
    }

    $tables = Table::all();

    if ($reservations->count() === 0) {
      /* return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.'); */
      return view('services.reservations.index', compact('search', 'reservations', 'tables'));
    } else {
      return view('services.reservations.index', compact('search', 'reservations', 'tables'));
    }
  }

  public function store(Request $request) {
    $request['user_id'] = Auth::user()->id;
    $request['date'] = $this->convertDate($request['date']);

    $validated = $request->validate([
      'user_id' => 'required|numeric|integer|exists:users,id',
      'table_id' => 'required|numeric|integer|exists:tables,id',
      'persons' => 'required|numeric|integer',
      'date' => 'required|date|after_or_equal:today',
      'time' => [
        'required',
        function ($attribute, $value, $fail) {
          if (!preg_match('#^([0-1][0-9]|2[0-3]):[0-5][0-9] (AM|PM)$#', $value)) {
            $fail('El formato de la hora de reserva debe ser hh:mm A (12 horas).');
          }
        },
      ],
    ]);

    // Validación adicional para el horario entre 8am a 12am
    $time = DateTime::createFromFormat('h:i A', $validated['time']);
    $min_time = DateTime::createFromFormat('h:i A', '08:00 AM');
    $max_time = DateTime::createFromFormat('h:i A', '11:59 PM');

    if ($time < $min_time || $time > $max_time) {
      return redirect()->back()->withErrors('La hora de reserva debe estar entre las 8:00 AM y las 11:59 PM.');
    }

    // Convertir el campo 'time' a formato hh:mm:ss
    $validated['time'] = $time->format('H:i:s');

    if (!$this->checkReservationAvailability($validated['table_id'], $validated['date'], $validated['time'])) {
      return redirect()->back()->withErrors('La mesa seleccionada no está disponible en la fecha y hora solicitadas. Intente reservar otra mesa, o la misma mesa con al menos una hora y media de diferencia.');
    }

    $reservation = Reservation::create($validated);

    return redirect()->back()->with('success', 'La reservación ha sido registrada correctamente.');
  }

  public function destroy($id) {
    $reservation = Reservation::find($id);

    $reservation->delete();

    if (Auth::user()->role !== 'admin') {
      return redirect()->back()->with('success', 'La reservación seleccionada ha sido cancelada correctamente.');
    } else {
      return redirect()->back()->with('success', 'El registro de la reservación seleccionada ha sido eliminado correctamente.');
    }
  }

  private function convertDate($date) {
    $months = [
      'Enero' => '01',
      'Febrero' => '02',
      'Marzo' => '03',
      'Abril' => '04',
      'Mayo' => '05',
      'Junio' => '06',
      'Julio' => '07',
      'Agosto' => '08',
      'Septiembre' => '09',
      'Octubre' => '10',
      'Noviembre' => '11',
      'Diciembre' => '12'
    ];

    $date_parts = explode(' ', $date);
    $day = $date_parts[0];
    $month = str_replace(',', '', $date_parts[1]); // Elimina la coma
    $month = $months[$month]; // Busca el mes en el array $months
    $year = $date_parts[2];

    return $year . '-' . $month . '-' . $day;
  }

  private function checkReservationAvailability($table_id, $date, $time) {
    $reservation_interval = 89; // 1 hora y media

    $requested_time = DateTime::createFromFormat('H:i:s', $time);
    $start_time = clone $requested_time;
    $start_time->sub(new DateInterval('PT' . $reservation_interval . 'M'));
    $end_time = clone $requested_time;
    $end_time->add(new DateInterval('PT' . $reservation_interval . 'M'));

    $existing_reservations = Reservation::where('table_id', $table_id)
      ->where('date', $date)
      ->whereBetween('time', [$start_time->format('H:i:s'), $end_time->format('H:i:s')])
      ->count();

    return $existing_reservations == 0;
  }
}
