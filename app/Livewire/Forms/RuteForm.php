<?php

namespace App\Livewire\Forms;


use App\Models\Track;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RuteForm extends Form
{
    public ?Track $track;

    public $id;

    #[Rule('required|min:3', as: 'Kota_asal harus diisi /')]
    public $from_route;
    
    #[Rule('required|min:3', as: 'Kota_tujuan harus diisi /')]
    public $to_route;


    // Properti untuk menyimpan status aktif
    public $is_active = 1;  

    public function setRute(Track $track){
        $this->track     = $track;
    
        $this->from_route        = $track->from_route;
        $this->to_route      = $track->to_route;
    }
    
    public function store()
    {
        // $this->validate();
        Track::create($this->except('track'));
        $this->reset();
    }
    
    public function update(){
        $this->validate();
        $this->track->update($this->except('track'));
    }
    

}
