<div>
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
                    <h2 class="text-2xl font-bold mb-4">Bonus edycja:</h2>
                    <form wire:submit="update" class="g-3">
                        <div class="mb-4">
                            <label for="reference" class="block text-gray-700 font-bold mb-2">Premia referencyjna</label>
                                <input type="text"
                                       id="reference"
                                       wire:model="reference"
                                       class="w-full border border-gray-300 px-4 py-2 rounded"
                                >
                            <div class="text-error">@error('reference') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-4">
                            <label for="individually" class="block text-gray-700 font-bold mb-2">Premia indywidualna</label>
                                <input type="text"
                                       id="individually"
                                       wire:model="individually"
                                       class="w-full border border-gray-300 px-4 py-2 rounded"
                                >
                            <div class="text-error">@error('individually') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="block text-gray-700 font-bold mb-2">Premia zespołowa</label>
                                <input type="text"
                                       wire:model="team"
                                       class="w-full border border-gray-300 px-4 py-2 rounded"
                                >
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="block text-gray-700 font-bold mb-2">Składowa premia indywidualna [%]</label>
                                <input type="text"
                                       wire:model="individualComponentPercent"
                                       class="w-full border border-gray-300 px-4 py-2 rounded"
                                >
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="block text-gray-700 font-bold mb-2">Składowa premia zespołowa [%]</label>
                                <input type="text"
                                       wire:model="teamComponentPercent"
                                       class="w-full border border-gray-300 px-4 py-2 rounded"
                                >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                            <button type="submit" class="btn btn-success">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
