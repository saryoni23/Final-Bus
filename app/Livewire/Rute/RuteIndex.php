<?php

namespace App\Livewire\Rute;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class RuteIndex extends Component
{
    #[Title('Rute')]
    public function render():View
    {
        return view('livewire.rute.rute-index');
    }
}
