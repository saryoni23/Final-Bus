<?php

namespace App\Livewire\Rute;

use App\Livewire\Forms\RuteForm;
use App\Livewire\Rute\RuteTabel;
use App\Models\Track;
use Livewire\Attributes\On;
use Livewire\Component;

class RuteEdit extends Component
{
    public RuteForm $form;

    public $modalRuteEdit = false;

    #[On('dispatch-rute-table-edit')]
    public function set_rute(Track $id){
        $this->form->setRute($id);

        $this->modalRuteEdit=true;
    }
    public function edit()
    {
        $this->validate();

        $update = $this->form->update();

        is_null($update)
        ? $this->dispatch('notify', title:'success', message:'Data Berhasil Update')
        :$this->dispatch('notify', title:'failed', message:'Data Gagal Update');

        $this->dispatch('dispatch-rute-create-edit')->to(RuteTabel::class);
    }
    public function render()
    {
        return view('livewire.rute.rute-edit');
    }
}
