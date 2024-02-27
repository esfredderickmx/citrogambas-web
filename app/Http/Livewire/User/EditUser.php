<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditUser extends Component {
  public User $user;
  public $initial_user;

  protected $rules = [
    'user.first_name' => 'required|string',
    'user.last_name' => 'required|string',
    'user.phone' => [
      'required',
      'numeric',
      'regex:/^[0-9]{10}$/'
    ],
    'user.role' => 'required|in:consumer,employee,admin'
  ];

  public function mount() {
    $this->initial_user = $this->user->toArray(); // Guarda el estado inicial del usuario
  }

  public function render() {
    return view('livewire.user.edit-user');
  }

  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  public function submitForm() {
    if (Auth::user()->id === $this->user->id) {
      /* return $this->addError('warning', 'No es posible actualizar el registro del usuario autenticado.'); */
      return session()->flash('warning', 'No es posible actualizar el registro del usuario autenticado.');
    }

    // Comprueba si hay cambios en el modelo $user
    $current_user = $this->user->toArray();
    $differences = array_diff_assoc($this->initial_user, $current_user);

    if (empty($differences)) {
      /* return $this->addError('warning', 'Aún no se realizan cambios en la información del usuario.'); */
      return session()->flash('info', 'Aún no se realizan cambios en la información del usuario.');
    }

    $validated = $this->validate();

    $this->user->update($validated);
    $this->initial_user = $this->user->toArray();

    $this->emit('updated', 'user', $this->user->id, 'La información del usuario ' . strtok($this->user->first_name, ' ') . ' ' . strtok($this->user->last_name, ' ') . ' se ha actualizado correctamente.');
  }

  public function resetForm() {
    $this->user->fill($this->initial_user);
    $this->resetErrorBag();
  }
}
