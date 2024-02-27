<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller {
  public function show() {
    return view('profile.profile');
  }

  public function update(Request $request) {
    $user = User::find(Auth::user()->id);

    $validated = $request->validate([
      'first_name' => 'required|string',
      'last_name' => 'required|string',
      'phone' => 'required|numeric|regex:/^[0-9]{10}$/',
      'username' => 'required|string|unique:users,username,' . $user->id, //Rule::unique('users')->ignore($user->id),
      'email' => 'required|string|unique:users,email,' . $user->id,
    ]);

    $user->first_name = $validated['first_name'];
    $user->last_name = $validated['last_name'];
    $user->phone = $validated['phone'];
    $user->username = $validated['username'];
    $user->email = $validated['email'];

    // Comprobar si hay cambios antes de guardar
    if ($user->isDirty()) {
      $user->save();
      return redirect()->back()->with('success', 'Su información de perfil ha sido actualizada correctamente.');
    } else {
      return redirect()->back()->with('info', 'No se han realizado cambios en su información.');
    }
  }

  public function password(Request $request) {
    $user = User::find(Auth::user()->id);

    $validated = $request->validate([
      'current_password' => [
        'required',
        function ($attribute, $value, $fail) use ($user) {
          if (!password_verify($value, $user->password)) {
            return $fail('La contraseña actual es incorrecta.');
          }
        },
      ],
      'password' => 'required|min:8|confirmed',
      'password_confirmation' => 'required',
    ]);

    if (!password_verify($validated['password'], $user->password)) {
      $user->password = $validated['password'];
      $user->save();
      return redirect()->back()->with('success', 'Su contraseña ha sido actualizada correctamente.');
    } else {
      return redirect()->back()->with('info', 'Su nueva contraseña debe ser distinta a su contraseña actual.');
    }
  }

  public function destroy(Request $request) {
    $user = User::find(Auth::user()->id);

    $request = $request->validate([
      'password_destroy' => [
        'required',
        function ($attribute, $value, $fail) use ($user) {
          if (!password_verify($value, $user->password)) {
            return $fail('No se ha podido eliminar la cuenta ya que la contraseña ingresada es incorrecta.');
          }
        },
      ],
    ]);

    Session::flush();
    Auth::logout();

    $user->delete();

    return redirect()->route('login')->with('success', 'Su cuenta ha sido eliminada correctamente.');
  }
}
