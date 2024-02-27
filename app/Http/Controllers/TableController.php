<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller {
  public function show(Request $request) {
    $search = $request->input('search');

    if (!empty($search)) {
      $tables = Table::where('status', $search)
        ->orderBy('number')->paginate(6);
    } else {
      $tables = Table::orderBy('number')->paginate(6);
    }

    if ($tables->count() === 0) {
      /* return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.'); */
      return view('services.reservations.tables.index', compact('search', 'tables'));
    } else {
      return view('services.reservations.tables.index', compact('search', 'tables'));
    }
  }

  public function store(Request $request) {
    $validated = $request->validate([
      'number' => 'required|numeric|integer|unique:tables,number',
      'capacity' => 'required|numeric|integer'
    ]);

    $table = Table::create($validated);

    return redirect()->back()->with('success', 'La mesa ha sido registrada correctamente.');
  }

  public function update(Request $request, $id) {
    $table = Table::find($id);

    $validated = $request->validate([
      'new_number' => 'required|numeric|integer|unique:tables,number,'.$table->id,
      'new_capacity' => 'required|numeric|integer'
    ]);

    $table->number = $validated['new_number'];
    $table->capacity = $validated['new_capacity'];
    
    if ($table->isDirty()) {
      $table->save();
      return redirect()->back()->with('success', 'La información de la mesa seleccionada ha sido actualizada correctamente.');
    } else {
      return redirect()->back()->with('info', 'No se han realizado cambios en la información de la mesa seleccionada.');
    }
  }

  public function destroy($id) {
    $table = Table::find($id);

    $table->delete();

    return redirect()->back()->with('success', 'El registro de la mesa seleccionada ha sido eliminado correctamente.');
  }
}
