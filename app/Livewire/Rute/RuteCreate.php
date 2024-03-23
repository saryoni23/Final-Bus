<?php

namespace App\Livewire\Rute;


use App\Livewire\Forms\RuteForm;
use Livewire\Component;

class RuteCreate extends Component
{
    public RuteForm $form;

    public $modalRuteCreate = false;

    public function save(){

        $this->validate();

        $simpan = $this->form->store();

        is_null($simpan)
        ? $this->dispatch('notify', title:'success', message:'Data Berhasil Disimpan')
        :$this->dispatch('notify', title:'failed', message:'Data Gagal Disimpan');

        $this->dispatch('dispatch-rute-create-save')->to(RuteTabel::class);
    }

    public function render()
    {
        return view('livewire.rute.rute-create');
    }
}
