<div>
    <div class="overflow-x-auto">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th>Departament</th>
                <th>Kwartrał I</th>
                <th>Kwartrał II</th>
                <th>Kwartrał III</th>
                <th>Kwartrał IV</th>
            </tr>
            </thead>
            <tbody>
            <!-- body -->
            @foreach ($allocations as $index => $value)

                    <tr>
                        <td>
                            {{ $value['name'] }}
                        </td>
                        <td>
                            {{ $value[1] }}
                        </td>
                        <td>
                            {{ $value[2] }}
                        </td>
                        <td>
                            {{ $value[3] }}
                        </td>
                        <td>
                            {{ $value[4] }}
                        </td>
                        <td>
                            <x-mary-button label="Open" @click="$wire.editPoints({{ $value['departamentId'] }})" />
                        </td>
                    </tr>

            @endforeach
            </tbody>
        </table>
        <x-mary-modal wire:model="editModal" title="Punkty" subtitle="na dany rok dla oddziału" separator>
            <x-mary-form wire:submit.prevent="update">
                <input wire:model.prevent="q1" type="text" placeholder="kwartał 1" class="input input-bordered input-info w-full max-w-xs mb-2" />
                <div class="text-red-700">@error('q1') {{ $message }} @enderror</div>
                <input wire:model.prevent="q2" type="text" placeholder="kwartał 2" class="input input-bordered input-info w-full max-w-xs mb-2" />
                <div class="text-red-700">@error('q2') {{ $message }} @enderror</div>
                <input wire:model.prevent="q3" type="text" placeholder="kwartał 3" class="input input-bordered input-info w-full max-w-xs mb-2" />
                <div class="text-red-700">@error('q3') {{ $message }} @enderror</div>
                <input wire:model.prevent="q4" type="text" placeholder="kwartał 4" class="input input-bordered input-info w-full max-w-xs mb-2" />
                <div class="text-red-700">@error('q4') {{ $message }} @enderror</div>

                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.editModal = false" />
                    <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save"/>
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>


    </div>
</div>
