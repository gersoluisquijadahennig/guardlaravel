<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;


class UserList extends Component
{
    public $heads;

    public function mount()
    {
        
        $this->heads = [
            'id',
            'usuario',
            ['label' => 'Email', 'width' => 40],
            ['label' => 'Activo','width' => 5],
          
        ];
    }
    public function render()
    {
        return view('livewire.user-list');
    }
}
