<?php
declare(strict_types=1);

namespace App\Livewire\Components\Event;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowModal extends Component
{
    public bool $showEventModal = false;
    public ?int $eventId = null;
    #[On('event-show')]
    public function openModal($id): void
    {
        $this->eventId = intval($id);
        $this->showEventModal = true;
    }
    public function render(): View
    {
        $event = Event::find($this->eventId);
        return view('livewire.components.event.show-modal', ['event' => $event]);
    }
}
