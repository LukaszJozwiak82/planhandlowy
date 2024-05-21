<div>
    <x-mary-modal wire:model="showModal"
                  title="{{\Carbon\Carbon::parse($sale?->actual_date)->format('Y-m-d')}}"
                  subtitle="doradca: {{ $sale?->user->name }}"
                  separator
                  class="min-w-full"
                  min-width="w-1/2"
    >
            <div class="flex">
                <x-mary-stat title="Klient" value="modulo: {{ $sale?->client->modulo }}" icon="o-user" tooltip="Hello" />
                <x-mary-stat
                    title="Suma punktów"
                    description=""
                    value="{{ $sale?->points }}"
                    icon="o-arrow-trending-up"
                    tooltip-bottom="There"
                />
            </div>
            <hr class="my-5">
            <x-mary-tabs wire:model="selectedTab">
                @if($sale?->connectionSales->isNotEmpty())
                    <x-mary-tab name="contacts-tab" label="Zgoda na kontakt" icon="o-users">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>punkty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->connectionSales as $key => $item)
                                    <tr>
                                        <td>{{$item->connection->name}}</td>
                                        <td>{{$item->connection->points}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-mary-tab>
                @endif
                @if($sale?->depositValues->isNotEmpty())
                    <x-mary-tab name="deposits-tab" label="Depozyty" icon="o-sparkles">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>punkty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->depositValues as $key => $item)
                                    <tr>
                                        <td>{{$item->deposit->name}}</td>
                                        <td>{{$item->deposit->points}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-mary-tab>
                @endif
                @if($sale?->packageSales->isNotEmpty())
                    <x-mary-tab name="packages-tab" label="Pakiety" icon="o-musical-note">
                        @foreach($sale?->packageSales as $package)
                            <h5><b>{{$package->package->name}}</b></h5>
                            <ul>
                                @foreach($package?->package->packageDeposits as $item)
                                    <li>{{$item->deposit->name}}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </x-mary-tab>
                @endif
                @if($sale?->loanSales->isNotEmpty())
                    <x-mary-tab name="loans-tab" label="Kredyty" icon="o-sparkles">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>Wartość</th>
                                    <th>rrso</th>
                                    <th>punkty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->loanSales as $key => $item)
                                    <tr>
                                        <td>{{$item->loan->name}}</td>
                                        <td>{{$item->value}}</td>
                                        <td>{{$item->rrso}}</td>
                                        <td>{{$item->points}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-mary-tab>
                @endif
                @if($sale?->insuranceSales->isNotEmpty())
                    <x-mary-tab name="insurances-tab" label="Ubezpieczenia" icon="o-sparkles">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>Kwota ubezpieczenia</th>
                                    <th>Punkty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->insuranceSales as $item)
                                    <tr>
                                        <td>{{ $item->insurance->name }}</td>
                                        <td>{{ $item->contribution }}</td>
                                        <td>{{ $item->points }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-mary-tab>
                @endif
            </x-mary-tabs>
            <x-slot:actions>
                <x-mary-button label="Zamknij" @click="$wire.showModal = false" />
            </x-slot:actions>
    </x-mary-modal>
</div>
