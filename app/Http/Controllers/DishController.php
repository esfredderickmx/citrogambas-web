<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DishController extends Controller {
  public function show(Request $request) {
    $search = $request->input('search');

    if (!empty($search)) {
      $dishes = Dish::where('name', 'like', "%$search%")
        ->orderBy('name')->paginate(6);
    } else {
      $dishes = Dish::orderBy('name')->paginate(6);
    }

    $categories = Category::all();

    if ($dishes->count() === 0) {
      return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.');
    } else {
      return view('services.food.index', compact('search', 'dishes', 'categories'));
    }
  }

  public function store(Request $request) {
    $validated = $request->validate([
      'name' => 'required|string|unique:dishes,name',
      'image' => 'required|image',
      'description' => 'required|string',
      'price' => 'required|numeric',
      'audience' => 'required|in:general,childlike,mature,elder',
      'season' => 'required|in:any,winter,spring,summer,autumn,hot,cold',
      'categories' => 'required|array',
    ]);

    $image = $request->file('image');
    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('assets/images/dishes'), $imageName);

    $dish = Dish::create([
      'name' => $validated['name'],
      'image' => $imageName,
      'description' => $validated['description'],
      'price' => $validated['price'],
      'audience' => $validated['audience'],
      'season' => $validated['season'],
    ]);

    $dish->categories()->attach($validated['categories']);

    return redirect()->back()->with('success', 'El platillo ha sido registrado correctamente.');
  }

  public function update(Request $request, $id) {
    $dish = Dish::find($id);

    $validated = $request->validate([
      'new_name' => 'required|string|unique:dishes,name,' . $dish->id,
      'new_description' => 'required|string',
      'new_image' => 'image|nullable',
      'new_price' => 'required|numeric',
      'new_audience' => 'required|in:general,childlike,mature,elder',
      'new_season' => 'required|in:any,winter,spring,summer,autumn,hot,cold',
      'new_categories' => 'required|array',
    ]);

    // Comparar los valores de los datos validados con los que se obtienen actualmente de la base de datos
    $dishChanged = false;

    $dishChanged = $validated['new_name'] !== $dish->name ? $dish->name = $validated['new_name'] : $dishChanged;

    $dishChanged = $validated['new_description'] !== $dish->description ? $dish->description = $validated['new_description'] : $dishChanged;

    if ($request->hasFile('new_image')) {
      // Eliminar la imagen anterior
      $oldImagePath = public_path('assets/images/dishes/' . $dish->image);
      if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
      }

      // Guardar la nueva imagen
      $image = $request->file('new_image');
      $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('assets/images/dishes'), $imageName);

      $dish->image = $imageName;
      $dishChanged = true;
    }

    $dishChanged = number_format($validated['new_price'], 2) !== number_format($dish->price, 2) ? $dish->price = $validated['new_price'] : $dishChanged;

    $dishChanged = $validated['new_audience'] !== $dish->audience ? $dish->audience = $validated['new_audience'] : $dishChanged;

    $dishChanged = $validated['new_season'] !== $dish->season ? $dish->season = $validated['new_season'] : $dishChanged;

    $new = $validated['new_categories'];
    $current = $dish->categories()->pluck('category_id')->toArray();

    sort($new);
    sort($current);

    $dishChanged = array_diff($new, $current) || array_diff($current, $new) ? $dish->categories()->sync($new) : $dishChanged;

    // Si no hubo cambio alguno en los datos validados y los que hay actualmente en la base de datos, mostrar un mensaje
    if (!$dishChanged) {
      return redirect()->back()->with('info', 'No se han realizado cambios en la información del platillo seleccionado.');
    }

    // Guardar los cambios en la base de datos y mostrar un mensaje de éxito
    $dish->save();
    return redirect()->back()->with('success', 'La información del platillo seleccionado ha sido actualizada correctamente.');
  }

  public function destroy($id) {
    $dish = Dish::find($id);

    $dish->delete();

    return redirect()->back()->with('success', 'El registro del platillo seleccionado ha sido eliminado correctamente.');
  }
}
