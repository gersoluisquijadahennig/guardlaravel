<?php

namespace App\Modules\Documentacion\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class Counter extends Component
{
    public $count = 0;

    #[On('incrementCount')] 
    public function increment()
    {

            $this->count++;

    }
 
    public function render()
    {
        return view('documentacion::livewire.counter');
    }
}