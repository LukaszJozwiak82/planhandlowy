<div>
    <x-mary-form wire:submit="save" class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-mary-select label="Doradca"
                               icon-right="o-user"
                               :options="$users"
                               placeholder="Wybierz doradcę"
                               wire:model.live="adviser"
                />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-mary-select label="Doradca polecający"
                               icon-right="o-user"
                               :options="$users"
                               placeholder="Wybierz doradcę"
                               wire:model.defer="recommended"
                />
                @error('name')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <livewire:client.searchbox />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-mary-input type="date" label="Data" class="form-control" wire:model.live="saleData" />
                @error('saleData')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
                Data: {{ \Carbon\Carbon::parse($saleData)->format('Y-m-d') }}

            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6 gap-2">
            <p for="modulo">Zgoda na komunikację przez:</p>
            @foreach($connections as $connection)
                {{--                <div class="form-check form-check-inline">--}}
                <x-mary-checkbox label="{{ $connection->name }}" value="{{$connection->id}}" wire:model.defer="connection" id="{{$connection->id}}" />
                {{--                </div>--}}
            @endforeach
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl">Produkty depozytowe</p>
                @foreach ($deposits as $deposit)
                    <div>
                        <x-mary-checkbox class="mb-1.5 mt-1" label="{{ $deposit->name }}" wire:model.defer="deposit" value="{{ $deposit->id }}" left />
                        @if ($deposit->is_value == 1)
                            ,wartość <input wire:model.defer="depositValue" id="depositValue{{$deposit->name}}" type="text" class="form">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl">Pakiety</p>
                <x-mary-checkbox label="Sprzedano pakiet" type="checkbox" value="true" id="package_sold"
                                 wire:model.defer="packageSold"
                />

                @foreach($packages as $package)
                    <div class="flex flex-wrap -mx-3 mb-6 mt-2">
                        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                            <input wire:model.defer="package" class="form-check-input" type="radio"
                                   value="{{ $package->id }}" id="packages" {{ $packageSold == true ? '' : 'disabled' }}>
                        </div>
                        <div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
                            <label class="form-check-label" for="{{ $package->name }}">
                                {{ $package->name }}
                                @foreach($package->packageDeposits as $item)
                                    <x-mary-list-item :item="$item->deposit" />
                                @endforeach
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl">Produkty kredytowe</p>
                <x-mary-checkbox label="Udzielono kredytu" value="true" wire:model.live="loanGranted" />
                @if($loanGranted)
                    <x-mary-select label="Kredyt" :options="$loans" wire:model.defer="loan_id" />
                    <x-mary-input label="Kwota finansowania" wire:model.defer="loan_value" />
                    @error('loan_value')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <x-mary-input label="Obecne finansowanie" wire:model.defer="current_funding" />
                    <x-mary-input label="RRSO/oprocentowanie" wire:model.defer="rrso" />
                @endif
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl">Ubezpieczenie</p>
                <div class="form-check">
                    <label class="form-check-label" for="insuranceGranted">
                        Udzielono ubezpieczenia
                    </label>
                    <input class="form-check-input" type="checkbox" value="true" id="insuranceGranted"
                           wire:model.live="insuranceGranted"
                    >
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-5 form-check-label" for="insurance">
                        Rodzaj ubezpieczenia
                    </label>
                    <select wire:model.live="insurance_id" class="col form-check-select" id="insurance"
                        {{ $insuranceGranted == true ? '' : 'disabled' }}>
                        <option selected></option>
                        @foreach ($insurances as $insurance)
                            <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-5 form-check-label" for="rrso">
                        Składka uroczniona
                    </label>
                    <div class="col-sm-4">
                        <input wire:model.live="contribution" type="text" class="form"
                            {{ $insuranceGranted == true ? '' : 'disabled' }}>
                    </div>
                </div>
            </div>

        </div>
        <x-mary-button type="button" class="btn btn-danger" label="Anuluj" />
        <x-mary-button type="submit" class="btn-success" label="Zapisz" />
    </x-mary-form>
</div>

