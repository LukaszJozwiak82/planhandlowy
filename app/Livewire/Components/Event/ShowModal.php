<?php

namespace App\Livewire\Components\Event;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowModal extends Component
{
    public bool $showEventModal = false;
    public $eventId;
    #[On('event-show')]
    public function openModal($id)
    {
        $this->eventId = $id;
        $this->showEventModal = true;
    }
    public function render()
    {
        $event = Event::find($this->eventId);
        return view('livewire.components.event.show-modal', ['event' => $event]);
    }
}
