<div>
    <x-mary-modal wire:model="showEventModal" class="backdrop-blur">
        <div class="card w-full bg-primary text-primary-content mb-1">
            <div class="card-body">
                <div class="p-2">
                    <li class="font-bold text-sm">godzina: {{ $event?->time_start }}</li>
                    <li class="text-sm">Temat: {{ $event?->name }}</li>
                    <li class="text-sm">Opis: {{ $event?->description }}</li>
                    <li class="font-bold text-sm">Doradca: {{ \App\Models\User::find($event?->user_id)->name ?? '' }}</li>
                </div>
            </div>
        </div>
        <x-mary-button label="Cancel" @click="$wire.showEventModal = false" />
    </x-mary-modal>
</div>
