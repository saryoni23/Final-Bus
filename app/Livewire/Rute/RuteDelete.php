<?php

namespace App\Livewire\Rute;

use App\Livewire\Rute\RuteTabel;
use App\Models\Rute;
use App\Models\Track;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class  RuteDelete extends Component
{   
    #[Locked]
    public $id;

    #[Locked]
    public $from_route;


    public $modalRuteDelete = false;

    #[On('dispatch-rute-table-delete')]
    public function set_rute($id,$asal){
        $this->id       = $id;

        $this->from_route    = $asal;


        $this->modalRuteDelete= true;
    }

    public function del(){

        $del = Track::destroy($this->id);

        ($del)
        ? $this->dispatch('notify', title:'success', message:'Data Berhasil Dihapus')
        :$this->dispatch('notify', title:'failed', message:'Data Gagal Dihapus');

        $this->modalRuteDelete=false;

        $this->dispatch('dispatch-rute-delete-del')->to(RuteTabel::class);
    }

    public function render()
    {
        return view('livewire.rute.rute-delete');
    }
}
