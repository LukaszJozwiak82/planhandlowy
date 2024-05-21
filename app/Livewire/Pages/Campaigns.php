<?php
declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Campaign;
use Illuminate\View\View;
use Livewire\Component;

class Campaigns extends Component
{
    public function createEvent(): void
    {
        $this->dispatch('campaign-create');
    }
    public function render(): View
    {
        $campaigns= Campaign::byRole(auth()->user())->get();
        return view('livewire.pages.campaigns', compact('campaigns'));
    }
}
