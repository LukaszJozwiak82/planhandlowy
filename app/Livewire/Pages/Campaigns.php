<?php

namespace App\Livewire\Pages;

use App\Models\Campaign;
use Livewire\Component;

class Campaigns extends Component
{

    public function createEvent()
    {
        $this->dispatch('campaign-create');
    }
    public function render()
    {
        $campaigns= Campaign::byRole(auth()->user())->get();
        return view('livewire.pages.campaigns', compact('campaigns'));
    }
}
