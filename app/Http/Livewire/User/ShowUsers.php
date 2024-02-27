<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component {
  use WithPagination;

  private $users;
  private $modals;
  public $search;

  protected $paginationTheme = 'materialize';
  protected $listeners = ['refreshTable' => 'render'];

  public function mount() {
    $this->search = request('search');
  }

  public function render() {
    if ($this->users && $this->users->count() === 0) {
      $this->resetPage();
    }

    $query = User::query();

    if ($this->search) {
      if (Auth::user()->role === 'admin') {
        $query->where('first_name', 'like', "%$this->search%")
          ->orWhere('last_name', 'like', "%$this->search%")
          ->orderBy('first_name');
      } elseif ($this->search) {
        $query->where(function ($query) {
          $query->where('first_name', 'like', "%$this->search%")
            ->orWhere('last_name', 'like', "%$this->search%");
        })
          ->where('role', 'consumer')
          ->orderBy('first_name');
      }

      if ($query->count() === 0) {
        $this->emit('info', 'No se han encontrado registros que coincidan con la búsqueda indicada.');
        session()->flash('area', 'Sin resultados que mostrar.');
      } else {
        $this->emit('dismiss');
      }
    } elseif (empty($this->search)) {
      if (Auth::user()->role === 'admin') {
        $query->orderBy('first_name');
      } elseif (empty($this->search)) {
        $query->where('role', 'consumer')
          ->orderBy('first_name');
      }

      if ($query->count() === 0) {
        $this->emit('info', 'Intenta registrar algunos usuarios para poder consultar su información.');
        session()->flash('area', 'Aún no hay usuarios registrados.');
      } else {
        $this->emit('dismiss');
      }
    }

    $this->users = $query->paginate(6);
    $this->modals = User::all();

    if ($this->users->currentPage() > $this->users->lastPage()) {
      $this->resetPage();
      $this->render();
    }

    return view('livewire.user.show-users', ['users' => $this->users, 'modals' => $this->modals]);
  }

  public function handleSearch() {
    $this->resetPage();
  }

  public function clearSearch() {
    $this->reset();
    $this->resetErrorBag();
  }
}
