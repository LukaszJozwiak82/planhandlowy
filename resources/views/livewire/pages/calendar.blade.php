<div>
    <div class="navbar bg-neutral text-neutral-content">
        <button class="navbar-start btn btn-ghost text-xl" wire:click="previousMonth({{ $month }},{{ $year }})">
            <
            {{ \App\Helpers\DateHelper::getMonthName(date('m', strtotime('-1 month', strtotime(date('Y-m', strtotime($year . '-' . $month)))))) }}</button>
        <div class="navbar-center hidden lg:flex">{{ \App\Helpers\DateHelper::getMonthName($month) }} {{ $year }}</div>
        <button class="navbar-end btn btn-ghost text-xl" wire:click="nextMonth({{ $month }},{{ $year }})">
            {{ \App\Helpers\DateHelper::getMonthName(date('m', strtotime('+1 month', strtotime(date('Y-m', strtotime($year . '-' . $month)))))) }}
            >
        </button>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="flex flex-wrap gap-1">
        @foreach (range(1, $days) as $number)
            @php
                $yearMonthDay = date('Y-m-d', strtotime($number . '-' . $month . '-' . $year));
            @endphp
            <div class="card w-52 bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">{{ $number }}
                        - {{ \App\Helpers\DateHelper::getDayName(date('w', strtotime($number . '-' . $month . '-' . $year))) }}</h2>
                    <div class="badge badge-info gap-2">Liczba Wydarzeń: {{ $eventsCount[$number] }} </div>
                    <ul>
                        @foreach ($events as $event)
                            @if ($event->start == $yearMonthDay)
                                <div class="card w-40 bg-primary text-primary-content mb-1">
                                    <div class="card-body">
                                        <div class="p-2">
                                            <li class="font-bold text-sm">godzina: {{ $event->time_start }}</li>
                                            <li class="text-sm">Temat: {{ $event->name }}</li>
                                            <li class="font-bold text-sm">Doradca: {{ \App\Models\User::find($event->user_id)->name }}</li>
                                        </div>
                                        <button wire:click="showEvent({{$event->id}})" spinner class="btn btn-primary btn-ghost">Pokaż</button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </ul>
                    <div class="card-actions justify-end">
                        <button wire:click="createEvent('{{$yearMonthDay}}')" spinner class="btn btn-primary btn-ghost">Dodaj zdarzenie</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <livewire:components.event.create-modal />
    <livewire:components.event.show-modal />
</div>
