<div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="w-full flex flex-row -mx-3 mb-6">
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
            <x-mary-select label="Pracownik"
                           icon="o-user"
                           :options="$users"
                           wire:model="selectedUser"
                           class="mt-2 mb-4"
                           placeholder="Wybierz pracownika"
            />
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
            <x-mary-select label="Wybierz rok" icon="o-user" :options="$years" wire:model="selectedYear" class="mt-2 mb-4" />
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
            <x-mary-select label="Wybierz kwartał" icon="o-user" :options="$quarters" wire:model="selectedQuarter" class="mt-2 mb-4" />
        </div>
        <div class=" md:w-1/4 mt-9">
            <x-mary-button label="Szukaj" class="btn-success" wire:click="search" />
        </div>
    </div>
    @if(isset($sales))
        <x-mary-tabs wire:model.change="selectedTab" selected="users-tab" @click="delete()">
            <x-mary-tab name="users-tab" label="Users" icon="o-users">
                <x-mary-table :headers="$headers" :rows="$sales" striped @row-click="alert($event.detail.name)">
                    @scope('actual_date', $sale)
                    {{\Carbon\Carbon::parse($sale->actual_date)->format('Y-m-d')}}
                    @endscope
                    @scope('cell_recommended', $sale)
                    @if($sale->recommended)
                        <x-mary-icon name="c-hand-thumb-up" />
                    @else
                        <x-mary-icon name="c-x-mark" />
                    @endif
                    @endscope
                    @scope('actions', $sale)
                    <x-mary-button icon="o-eye" wire:click="show({{$sale->id}})" spinner class="btn-sm" />
                    <x-mary-button icon="o-trash" wire:click="delete({{$sale->id}})" spinner class="btn-sm" wire:confirm="{{__('sale.confirm_msg')}}" />
                    @endscope
                </x-mary-table>
            </x-mary-tab>
            {{ $sales->links() }}
        </x-mary-tabs>
    @else
        <h1 class="text-red-700 text-error text-2xl">Wybierz pracownika z listy</h1>
    @endif
    <livewire:components.sale.show />
</div>
