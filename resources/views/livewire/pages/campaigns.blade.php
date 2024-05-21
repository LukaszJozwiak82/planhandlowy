<div>
    <x-mary-button label="Dodaj kampanie" wire:click="createEvent()" spinner class="btn-primary" />
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>Nazwa</th>
                <th>Oddział</th>
                <th>Utworzono</th>
            </tr>
            </thead>
            <tbody>
            @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->name }}</td>
                    <td>{{ $campaign->departament->name }}</td>
                    <td>{{ $campaign->created_at }}</td>
                    <td>
                        <a download href="{{ asset($campaign->path) }}" class="link link-info">{{ __('Pobierz') }}</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <livewire:components.campaigns.create-modal />
</div>
