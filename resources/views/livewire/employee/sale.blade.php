<div>
    {{$user->name}}
    <x-mary-tabs selected="users-tab">
        <x-mary-tab name="users-tab" label="Users" icon="o-users">
            <div>Users</div>
        </x-mary-tab>
        <x-mary-tab name="tricks-tab" label="Tricks" icon="o-sparkles">
            <div>Tricks</div>
        </x-mary-tab>
        <x-mary-tab name="musics-tab" label="Musics" icon="o-musical-note">
            <div>Musics</div>
        </x-mary-tab>
    </x-mary-tabs>
    <x-mary-table :headers="$headers" :rows="$sales" striped @row-click="alert($event.detail.name)" >
        @scope('cell_recommended', $sale)
            @if($sale->recommended)
                <x-icon name="c-hand-thumb-up" />
            @else
                <x-mary-icon name="c-x-mark" />
            @endif
        @endscope
    </x-mary-table>
</div>
