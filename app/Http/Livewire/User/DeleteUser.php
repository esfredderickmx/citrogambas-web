<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteUser extends Component {
  public User $user;

  public function render() {
    return view('livewire.user.delete-user');
  }

  public function submitForm() {
    if (Auth::user()->id === $this->user->id) {
      $this->addError('warning', 'No es posible eliminar el registro del usuario autenticado.');
      return;
    }

    $this->user->delete();

    $this->emit('deleted', 'user', $this->user->id, 'El registro del usuario ' . strtok($this->user->first_name, ' ') . ' ' . strtok($this->user->last_name, ' ') . ' se ha eliminado correctamente.');
  }

  public function resetForm() {
    $this->resetErrorBag();
  }
}
