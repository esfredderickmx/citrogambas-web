<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
  public function show(Request $request) {
    /* $search = $request->input('search');

    if (Auth::user()->role === 'admin') {
      if (!empty($search)) {
        $users = User::where('first_name', 'like', "%$search%")
          ->orWhere('last_name', 'like', "%$search%")
          ->orderBy('first_name')->paginate(6);
      } else {
        $users = User::orderBy('first_name')->paginate(6);
      }
    } else {
      if (!empty($search)) {
        $users = User::where(function ($query) use ($search) {
          $query->where('first_name', 'like', "%$search%")
            ->orWhere('last_name', 'like', "%$search%");
        })
          ->where('role', 'consumer')
          ->orderBy('first_name')
          ->paginate(6);
      } else {
        $users = User::where('role', 'consumer')
          ->orderBy('first_name')
          ->paginate(6);
      }
    }

    if ($users->count() === 0) {
      return redirect()->back()->with('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.');
    } else {
      return view('users.index', compact('users', 'search'));
    } */
    
    return view('users.index');
  }
}
