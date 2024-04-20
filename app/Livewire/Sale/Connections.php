<?php

namespace App\Livewire\Sale;

use Livewire\Attributes\On;
use Livewire\Component;

class Connections extends Component
{
    public $connections;

    public $data = [];

    //    public function toChild()
    //    {
    //        $this->changeConnection();
    //    }
    #[On('to-child')]
    public function changeConnection()
    {
        $this->dispatch('post-created', $this->data);
    }

    public function render()
    {
        return view('livewire.sale.connections');
    }
}
