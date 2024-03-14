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
                <x-mary-input type="date" label="Data" class="form-control" wire:model.live="saleData"/>
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
                    <x-mary-checkbox label="{{ $connection->name }}" value="{{$connection->id}}" wire:model.defer="connection" id="{{$connection->id}}"/>
{{--                </div>--}}
            @endforeach
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                Produkty depozytowe
                @foreach ($deposits as $deposit)
                    <div>
                        <x-mary-checkbox class="mb-1.5" label="{{ $deposit->name }}" wire:model.defer="deposit" value="{{ $deposit->id }}" left/>
                        @if ($deposit->is_value == 1)
                            ,wartość <input wire:model.defer="depositValue" id="depositValue{{$deposit->name}}" type="text" class="form">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                Pakiety
                    <x-mary-checkbox label="Sprzedano pakiet" type="checkbox" value="true" id="package_sold"
                           wire:model.defer="packageSold"
                    />
                @foreach($packages as $package)
                    <div class="form-check">
                        <label class="form-check-label" for="{{ $package->name }}">
                            {{ $package->name }}
                                @foreach($package->packageDeposits as $item)
                                    <x-mary-list-item :item="$item->deposit"/>
                                @endforeach
                        </label>
                        <input wire:model.defer="package" class="form-check-input" type="radio"
                               value="{{ $package->id }}" id="packages" {{ $packageSold == true ? '' : 'disabled' }}>
                    </div>
                @endforeach
            </div>
{{--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">--}}
{{--                Produkty kredytowe--}}
{{--                <div class="form-check">--}}
{{--                    <label class="form-check-label" for="loan_granted">--}}
{{--                        Udzielono kredytu--}}
{{--                    </label>--}}
{{--                    <input class="form-check-input" type="checkbox" value="true" id="loan_granted"--}}
{{--                           wire:model.live="loanGranted"--}}
{{--                    >--}}
{{--                    <select wire:model.defer="loan_id" class="form-check-select"--}}
{{--                        {{ $loanGranted == true ? '' : 'disabled' }}>--}}
{{--                        <option selected></option>--}}
{{--                        @foreach ($loans as $loan)--}}
{{--                            <option value="{{ $loan->id }}">{{ $loan->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="mb-2 row">--}}
{{--                    <label class="col-sm-5 form-check-label" for="loan_value">--}}
{{--                        Kwota finansowania--}}
{{--                    </label>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <input wire:model.defer="loan_value" name="loan_value" type="text" class="form" id="loan_value"--}}
{{--                            {{ $loanGranted == true ? '' : 'disabled' }}>--}}
{{--                        @error('loan_value')--}}
{{--                        <span class="error">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="mb-2 row">--}}
{{--                    <label class="col-sm-5 form-check-label" for="current_funding">--}}
{{--                        Obecne finansowanie--}}
{{--                    </label>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <input wire:model.defer="current_funding" type="text" class="form"--}}
{{--                            {{ $loanGranted == true ? '' : 'disabled' }}>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="mb-2 row">--}}
{{--                    <label class="col-sm-5 form-check-label" for="rrso">--}}
{{--                        RRSO/oprocentowanie--}}
{{--                    </label>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <input wire:model.defer="rrso" type="text" class="form"--}}
{{--                            {{ $loanGranted == true ? '' : 'disabled' }}>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">--}}
{{--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">--}}
{{--                Ubezpieczenie--}}
{{--                <div class="form-check">--}}
{{--                    <label class="form-check-label" for="insuranceGranted">--}}
{{--                        Udzielono ubezpieczenia--}}
{{--                    </label>--}}
{{--                    <input class="form-check-input" type="checkbox" value="true" id="insuranceGranted"--}}
{{--                           wire:model.live="insuranceGranted"--}}
{{--                    >--}}
{{--                </div>--}}
{{--                <div class="mb-2 row">--}}
{{--                    <label class="col-sm-5 form-check-label" for="insurance">--}}
{{--                        Rodzaj ubezpieczenia--}}
{{--                    </label>--}}
{{--                    <select wire:model.live="insurance_id" class="col form-check-select" id="insurance"--}}
{{--                        {{ $insuranceGranted == true ? '' : 'disabled' }}>--}}
{{--                        <option selected></option>--}}
{{--                        @foreach ($insurances as $insurance)--}}
{{--                            <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="mb-2 row">--}}
{{--                    <label class="col-sm-5 form-check-label" for="rrso">--}}
{{--                        Składka uroczniona--}}
{{--                    </label>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <input wire:model.live="contribution" type="text" class="form"--}}
{{--                            {{ $insuranceGranted == true ? '' : 'disabled' }}>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger m-3" data-bs-dismiss="modal">Anuluj</button>
            <button type="submit" class="btn btn-success">Zapisz</button>
        </div>
    </x-mary-form>
</div>

