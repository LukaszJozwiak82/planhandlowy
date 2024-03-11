<div>
    <form wire:submit="save" class="w-full">
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
                               wire:model.live="recommended"
                />
                @error('name')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <livewire:client.searchbox />
        <div class="row form-group mb-2">
            <label for="date" class="col-sm-4 col-form-label">Data</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="date" class="form-control" wire:model.live="saleData">

                </div>
                @error('saleData')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
                {{-- Data: {{ \Carbon\Carbon::parse($saleData)->format('Y-m-d') }} --}}
            </div>
        </div>
        <div class="border rounded mb-2 p-2">
            <label class="col-sm-3 col-form-label" for="modulo">Zgoda na komunikację przez:</label>
            @foreach($connections as $connection)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{$connection->id}}" wire:model.live="connection" id="{{$connection->id}}">
                    <label class="form-check-label">
                        {{ $connection->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                Produkty depozytowe
                @foreach ($deposits as $deposit)
                    <div class="form-check">
                        <label class="form-check-label" for="{{ $deposit->name }}">
                            {{ $deposit->name }}
                        </label>
                        <input wire:model.live="deposit" class="form-check-input" type="checkbox"
                               value="{{ $deposit->id }}" id="{{ $deposit->name }}"
                        >
                        @if ($deposit->is_value == 1)
                            ,wartość <input wire:model.live="depositValue" id="depositValue{{$deposit->name}}" type="text" class="form">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col">
                Pakiety
                <div class="form-check">
                    <label class="form-check-label" for="loan_granted">
                        Sprzedano pakiet
                    </label>
                    <input class="form-check-input" type="checkbox" value="true" id="package_sold"
                           wire:model.live="packageSold"
                    >
                </div>
                @foreach($packages as $package)
                    <div class="form-check">
                        <label class="form-check-label" for="{{ $package->name }}">
                            {{ $package->name }}
                            <ul>
                                @foreach($package->packageDeposits as $item)
                                    <li class="m-1">{{$item->deposit->name}}</li>
                                @endforeach
                            </ul>
                        </label>
                        <input wire:model.live="package" class="form-check-input" type="radio"
                               value="{{ $package->id }}" id="packages" {{ $packageSold == true ? '' : 'disabled' }}>
                    </div>
                @endforeach
            </div>
            <div class="col">
                Produkty kredytowe
                <div class="form-check">
                    <label class="form-check-label" for="loan_granted">
                        Udzielono kredytu
                    </label>
                    <input class="form-check-input" type="checkbox" value="true" id="loan_granted"
                           wire:model.live="loanGranted"
                    >
                    <select wire:model.live="loan_id" class="form-check-select"
                        {{ $loanGranted == true ? '' : 'disabled' }}>
                        <option selected></option>
                        @foreach ($loans as $loan)
                            <option value="{{ $loan->id }}">{{ $loan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-5 form-check-label" for="loan_value">
                        Kwota finansowania
                    </label>
                    <div class="col-sm-4">
                        <input wire:model.live="loan_value" name="loan_value" type="text" class="form" id="loan_value"
                            {{ $loanGranted == true ? '' : 'disabled' }}>
                        @error('loan_value')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-5 form-check-label" for="current_funding">
                        Obecne finansowanie
                    </label>
                    <div class="col-sm-4">
                        <input wire:model.live="current_funding" type="text" class="form"
                            {{ $loanGranted == true ? '' : 'disabled' }}>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-5 form-check-label" for="rrso">
                        RRSO/oprocentowanie
                    </label>
                    <div class="col-sm-4">
                        <input wire:model.live="rrso" type="text" class="form"
                            {{ $loanGranted == true ? '' : 'disabled' }}>
                    </div>
                </div>
            </div>
            <div class="col">
                Ubezpieczenie
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
        <div class="modal-footer">
            <button type="button" class="btn btn-danger m-3" data-bs-dismiss="modal">Anuluj</button>
            <button type="submit" class="btn btn-success">Zapisz</button>
        </div>
    </form>
</div>

