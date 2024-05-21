<?php
declare(strict_types=1);

namespace App\Livewire\Components\Event;

use App\Models\Event;
use Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateModal extends Component
{
    public bool $createEventModal = false;
    #[Validate('required')]
    public $hour;
    #[Validate('required')]
    public $eventDate;
    public $description;
    #[Validate('required')]
    public $name;

    #[On('event-create')]
    public function openModal($dateSelected): void
    {
        $this->eventDate = $dateSelected;
        $this->createEventModal = true;
    }

    public function createEvent(): void
    {
        $this->validate();
        Event::create([
            'name' => $this->name,
            'start' => $this->eventDate,
            'time_start' => $this->hour,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);
        session()->flash('status', "Zdarzenie dodane");
        $this->createEventModal = false;
    }

    public function render(): View
    {
        return view('livewire.components.event.create-modal');
    }
}
