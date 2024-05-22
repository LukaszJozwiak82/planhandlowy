<div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <x-mary-form wire:submit="save" class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-mary-select label="Doradca"
                               icon-right="o-user"
                               :options="$users"
                               placeholder="Wybierz doradcę"
                               wire:model.live="adviser"
                               class="select-info"
                />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-mary-select label="Doradca polecający"
                               icon-right="o-user"
                               :options="$users"
                               placeholder="Wybierz doradcę"
                               wire:model.defer="recommended"
                               class="select-info"
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
                <x-mary-input type="date"
                              label="Data"
                              class="input-info"
                              wire:model.live="saleData"
                />
                @error('saleData')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
                Data: {{ \Carbon\Carbon::parse($saleData)->format('Y-m-d') }}

            </div>
        </div>
        <livewire:sale.connections :$connections />
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl mb-4">Produkty depozytowe</p>
                @foreach ($deposits as $deposit)
                    <div>
                        <x-mary-checkbox class="mb-1.5 mt-1  input-info"
                                         label="{{ $deposit->name }}"
                                         wire:model.defer="deposit"
                                         value="{{ $deposit->id }}"
                                         left
                        />
                        @if ($deposit->is_value == 1)
                            ,wartość <input wire:model.defer="depositValue"
                                            id="depositValue{{ $deposit->name }}"
                                            type="text"
                                            class="input input-bordered input-info"
                            >
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl mb-4">Pakiety</p>
                <x-mary-checkbox label="Sprzedano pakiet"
                                 type="checkbox"
                                 value="true"
                                 id="package_sold"
                                 wire:model.live="packageSold"
                                 class="input-info"
                />
                @if($packageSold)
                    @foreach ($packages as $package)
                        <div class="flex flex-wrap -mx-3 mb-6 mt-2">
                            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                                <input wire:model.defer="package" class="form-check-input" type="radio"
                                       value="{{ $package->id }}" id="packages"
                                    {{ $packageSold == true ? '' : 'disabled' }}>
                            </div>
                            <div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
                                <label class="form-check-label" for="{{ $package->name }}">
                                    {{ $package->name }}
                                    @foreach ($package->packageDeposits as $item)
                                        <x-mary-list-item :item="$item->deposit"
                                                          class="text-sm"
                                        />
                                    @endforeach
                                </label>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl mb-4">Produkty kredytowe</p>
                <x-mary-checkbox class="mb-4 input-info"
                                 label="Udzielono kredytu"
                                 value="true"
                                 wire:model.live="loanGranted"
                />
                @if ($loanGranted)
                    <x-mary-select label="Kredyt"
                                   :options="$loans"
                                   wire:model.defer="loan_id"
                    />
                    <x-mary-input label="Kwota finansowania"
                                  wire:model.defer="loan_value"
                    />
                    @error('loan_value')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <x-mary-input label="Obecne finansowanie"
                                  wire:model.defer="current_funding"
                    />
                    <x-mary-input label="RRSO/oprocentowanie"
                                  wire:model.defer="rrso"
                    />
                @endif
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <p class="italic font-bold underline text-xl mb-4">Ubezpieczenie</p>
                <x-mary-checkbox class="mb-4 input-info"
                                 label="Ubezpieczenie"
                                 value="true"
                                 wire:model.live="insuranceGranted"
                />
                @if ($insuranceGranted)
                    <x-mary-select label="Rodzaj ubezpieczenia"
                                   :options="$insurances"
                                   wire:model.defer="insurance_id"
                    />
                    <x-mary-input label="Składka uroczniona"
                                  wire:model.defer="contribution"
                    />
                @endif
            </div>

        </div>
        <div class="flex w-full gap-2">
            <x-mary-button type="button"
                           class="btn btn-danger"
                           label="Anuluj"
            />
            <x-mary-button type="submit"
                           class="btn-success"
                           label="Zapisz"
            />
        </div>
    </x-mary-form>
</div>
