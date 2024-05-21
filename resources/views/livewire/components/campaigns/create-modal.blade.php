<div>
    <x-mary-modal wire:model="createCampaignModal" title="Nowa kampania" subtitle="" separator>
        <x-mary-form wire:submit.prevent="store">
            <input wire:model="name" type="text" placeholder="Nazwa kampanii" class="input input-bordered input-accent w-full max-w-xs" />
            <div class="text-red-700">@error('name') {{ $message }} @enderror</div>
            <x-mary-select label="Oddział" icon="o-user" :options="$departments" wire:model="department" placeholder="Wybierz oddział"/>
            <x-mary-file wire:model.prevent="file" label="Plik"/>
            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.createCampaignModal = false" />
                <x-mary-button label="Confirm" class="btn-primary" type="submit" spinner="save"/>
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
