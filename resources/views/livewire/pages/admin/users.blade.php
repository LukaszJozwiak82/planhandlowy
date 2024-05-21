<div>
    <section>
    <x-mary-button icon="o-plus" label="Dodaj użytkownika" wire:click="create" spinner class="bg-amber-600 btn-sm mb-4" />
        @if($isOpen)
        <div>
            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                    <!-- Modal content goes here -->
                    <svg wire:click.prevent="$set('isOpen', false)"
                         class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                    </svg>
                    <h2 class="text-2xl font-bold mb-4">Nowy użytkownik:</h2>
                    <form wire:submit.prevent="{{ $userId ? 'update' : 'store' }}">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Imie i nazwisko:</label>
                            <input wire:model.prevent="name"
                                   type="text"
                                   id="title"
                                   class="w-full border border-gray-300 px-4 py-2 rounded"
                            >
                            <div class="text-error">@error('name') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                            <input wire:model.prevent="email"
                                   type="email"
                                   id="email"
                                   class="w-full border border-gray-300 px-4 py-2 rounded"
                            >
                            <div class="text-error">@error('email') {{ $message }} @enderror</div>
                        </div>
                        <div class="block text-gray-700 font-bold mb-2">
                            <x-mary-select label="Wybierz role"
                                           icon="o-user"
                                           :options="$roles"
                                           option-value="name"
                                           wire:model="role"
                                           class="mt-2 mb-4"
                                           placeholder="Wybierz role"
                            />
                        </div>
                        <div class="block text-gray-700 font-bold mb-2">
                            <x-mary-select label="Wybierz oddział"
                                           icon="o-user"
                                           :options="$departments"
                                           wire:model.prevent="departament"
                                           class="mt-2 mb-4"
                                           placeholder="Wybierz oddział"
                            />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                            <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                    wire:click="closeModal"
                            >Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    </section>
    <x-mary-table :headers="$headers" :rows="$users">
        @scope('cell_role', $user)
        {{ $user->getRoleNames()[0] }}
        @endscope
        @scope('actions', $user)
        <x-mary-button icon="o-trash" wire:click="" spinner class="btn-sm" />
        @endscope
    </x-mary-table>
    {{ $users->links() }}
</div>
