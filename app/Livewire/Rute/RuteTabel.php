<?php

namespace App\Livewire\Rute;

use App\Livewire\Forms\RuteForm;
use App\Models\Track;
use App\Traits\WithSorting;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class RuteTabel extends Component
{
    use WithPagination;
    use WithSorting;
    public RuteForm $form;
    public    
    $paginate   =5,
    $sortBy     ='tracks.id',
    $sortDirection = 'desc';
    #[On('dispatch-rute-create-save')]
    #[On('dispatch-rute-create-edit')]
    #[On('dispatch-rute-delete-del')]
    public function render()
    {
        return view('livewire.rute.rute-tabel',[
            'data' => Track::where('id', 'like','%'.$this->form->id.'%')
            ->where('from_route', 'like','%'.$this->form->from_route.'%')
            ->where('to_route', 'like','%'.$this->form->to_route.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate),

        ]);
    }
}
