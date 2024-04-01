<div>
    <div class="flex flex-wrap -mx-3 mb-6 gap-2">
        <p>Zgoda na komunikację przez:</p>
        @foreach ($connections as $connection)
            <x-mary-checkbox label="{{ $connection->name }}"
                             value="{{ $connection->id }}"
                             wire:model.prevent="data"
                             id="{{ $connection->id }}"
            />
        @endforeach
    </div>
    aaa: {{ var_export($data) }}
</div>
