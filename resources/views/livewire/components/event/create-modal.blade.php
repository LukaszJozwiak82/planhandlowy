<div>
    @php
        $config1 = ['altFormat' => 'Y-m-d'];
    @endphp
    <x-mary-modal wire:model="createEventModal" title="Nowe zdarzenie" separator>
        <x-mary-form wire:submit.prevent="createEvent">
            <x-mary-datepicker label="Date" wire:model="eventDate" icon="o-calendar" hint="Hi!" />
            <select wire:model.prevent="hour" class="select select-accent w-full max-w-xs">
                <option selected>Wybierz godzinę</option>
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
            </select>
            <div class="text-red-700">@error('hour') {{ $message }} @enderror</div>
            <input wire:model="name" type="text" placeholder="Temat" class="input input-bordered input-accent w-full max-w-xs" />
            <div class="text-red-700">@error('name') {{ $message }} @enderror</div>
            <x-mary-textarea
                label="Opis"
                wire:model="description"
                rows="5"
                inline />

            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.createEventModal = false" />
                <x-mary-button label="Zapisz" class="btn-primary" type="submit" spinner="save"/>
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
