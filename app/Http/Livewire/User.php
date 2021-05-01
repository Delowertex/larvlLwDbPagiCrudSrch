<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as Users;
use Livewire\WithPagination;

class User extends Component
{
    public $users;

    use WithPagination;
    public function render()
    {   
        $this->users = Users::all();
        $userss = Users::paginate(5);
        return view('livewire.user', ['userss'=> $userss]);
    }
}
