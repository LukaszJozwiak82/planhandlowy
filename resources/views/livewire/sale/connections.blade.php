<div>
    <div class="flex flex-wrap -mx-3 mb-6 gap-2">
        <p>Zgoda na komunikację przez:</p>
        @foreach ($connections as $connection)
            <x-mary-checkbox label="{{ $connection->name }}"
                             value="{{ $connection->id }}"
                             wire:model.live="data"
                             id="{{ $connection->id }}"
                             wire:change="changeConnection()"
            />
        @endforeach
    </div>
</div>
