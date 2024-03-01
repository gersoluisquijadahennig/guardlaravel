<?php

namespace App\Livewire;

use Livewire\Component;

class CreateUser extends Component
{
    public $showForm = false;

    public function showCreateUserForm()
    {
        $this->showForm = true;
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
