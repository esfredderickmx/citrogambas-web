<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class CreateUser extends Component {
  public $first_name;
  public $last_name;
  public $username;
  public $email;
  public $phone;
  public $role;

  protected $rules = [
    'first_name' => 'required|string',
    'last_name' => 'required|string',
    'username' => 'required|string|unique:users,username',
    'email' => 'required|email|unique:users,email',
    'phone' => [
      'required',
      'numeric',
      'regex:/^[0-9]{10}$/'
    ],
    'role' => 'required|in:consumer,employee,admin'
  ];

  public function render() {
    return view('livewire.user.create-user');
  }

  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  public function submitForm() {
    $validated = $this->validate();

    $validated['password'] = '12345678';

    $user = User::create($validated);

    $this->emit('created', 'user', 'El usuario ' . strtok($user->first_name, ' ') . ' ' . strtok($user->last_name, ' ') . ' se ha registrado correctamente.');

    $this->resetForm();
  }

  public function resetForm() {
    $this->reset();
    $this->resetErrorBag();
  }
}
