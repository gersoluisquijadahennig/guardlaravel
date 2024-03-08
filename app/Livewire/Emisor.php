<?php

namespace App\Livewire;

use Livewire\Component;

class Emisor extends Component
{

    public $count = 0;
    protected $listeners = ['incrementCount' => 'increment'];

    public function render()
    {
        return view('livewire.emisor');
    }

    public function increment()
    {
        $this->count++;
    }
}
