<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller {
  public function show(Request $request) {
    $search = $request->input('search');

    if (!empty($search)) {
      $categories = Category::where('name', 'like', "%$search%")
        ->orderBy('id')->paginate(6);
    } else {
      $categories = Category::orderBy('id')->paginate(6);
    }

    $data = [['Category', 'Dishes']];

    foreach ($categories as $category) {
      $dishes = $category->dishes()->count();
      array_push($data, [$category->name, $dishes]);
    }

    if ($categories->count() === 0) {
      return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.');
    } else {
      return view('services.food.categories.index', compact('search', 'categories', 'data'));
    }

  }

  public function store(Request $request) {
    $validated = $request->validate([
      'name' => 'required|string|unique:categories,name',
      'icon' => 'required|string|unique:categories,icon',
    ]);

    $category = Category::create($validated);

    return redirect()->back()->with('success', 'La categoría ha sido registrada correctamente.');
  }

  public function update(Request $request, $id) {
    $category = Category::find($id);

    $validated = $request->validate([
      'new_name' => 'required|string|unique:categories,name,'.$category->id,
      'new_icon' => 'required|string|unique:categories,icon,'.$category->id,
    ]);

    $category->name = $validated['new_name'];
    $category->icon = $validated['new_icon'];
    
    if ($category->isDirty()) {
      $category->save();
      return redirect()->back()->with('success', 'La información de la categoría seleccionada ha sido actualizada correctamente.');
    } else {
      return redirect()->back()->with('info', 'No se han realizado cambios en la información de la categoría seleccionada.');
    }
  }

  public function destroy($id) {
    $category = Category::find($id);

    $category->delete();

    return redirect()->back()->with('success', 'El registro de la categoría seleccionada ha sido eliminado correctamente.');
  }
}
