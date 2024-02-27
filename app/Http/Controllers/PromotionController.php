<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
  public function show(Request $request) {
    $search = $request->input('search');

    if (!empty($search)) {
      $promotions = Promotion::where('code', 'like', "%$search%")
        ->orderBy('discount')->paginate(6);
    } else {
      $promotions = Promotion::orderBy('discount')->paginate(6);
    }

    if ($promotions->count() === 0) {
      return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.');
    } else {
      return view('services.food.promotions.index', compact('search', 'promotions'));
    }
  }

  public function store(Request $request) {
    $validated = $request->validate([
      'code' => 'required|string|unique:promotions,code',
      'discount' => 'required|numeric|integer',
      'valid_until' => 'required|date|after_or_equal:today',
    ]);

    $promotion = Promotion::create($validated);

    return redirect()->back()->with('success', 'La promoción ha sido registrada correctamente.');
  }

  public function update(Request $request, $id) {
    $promotion = Promotion::find($id);

    $validated = $request->validate([
      'new_code' => 'required|string|unique:promotions,code,'.$promotion->id,
      'new_discount' => 'required|numeric|integer',
      'new_valid' => 'required|date|after_or_equal:today',
    ]);

    $promotion->code = $validated['new_code'];
    $promotion->discount = $validated['new_discount'];
    $promotion->valid_until = $validated['new_valid'];
    
    if ($promotion->isDirty()) {
      $promotion->save();
      return redirect()->back()->with('success', 'La información de la promoción seleccionada ha sido actualizada correctamente.');
    } else {
      return redirect()->back()->with('info', 'No se han realizado cambios en la información de la promoción seleccionada.');
    }
  }

  public function destroy($id) {
    $promotion = Promotion::find($id);

    $promotion->delete();

    return redirect()->back()->with('success', 'El registro de la promoción seleccionada ha sido eliminado correctamente.');
  }
}
