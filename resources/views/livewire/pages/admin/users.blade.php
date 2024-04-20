<div>
    <x-mary-table :headers="$headers" :rows="$users">
        @scope('cell_role', $user)
        {{ $user->getRoleNames()[0] }}
        @endscope
    </x-mary-table>
    {{ $users->links() }}
</div>
