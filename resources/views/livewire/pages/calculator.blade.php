<div>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>Doradca</th>
                <th>Punkty</th>
                <th>Zdobyte punkty</th>
                <th>Stopień realizacji celu [%]</th>
                <th>Premia referencyjna [zł]</th>
                <th>Premia indywidualna [zł]</th>
                <th>Premia zaspołowa [zł]</th>
                <th>Składowe premii</th>
                <th>Mnożnik</th>
                <th>Premia indywidualna</th>
                <th>Premia zespołowa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->getPoints($year,$quarter)}}</td>
                    <td>{{ $employee->getScore($year,$quarter) }}</td>
                    <td>{{ $employee->getRealization($year,$quarter)}}</td>
                    @if($employee->getBonusParams($year,$quarter)->isEmpty())
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        @foreach($employee->getBonusParams($year, $quarter) as $item)
                            <td>{{ $item->reference }}</td>
                            <td>{{ $item->individually }}</td>
                            <td>{{ $item->team }}</td>
                            <td>{{ $item->individual_components_percent }}
                                /{{ $item->team_components_percent }}</td>
                            @if($employee->getScore($year,$quarter) > 0)
                                @if($employee->getRealization($year,$quarter) < 80)
                                    <td>0</td>
                                    <td>0</td>
                                    <td>?</td>
                                @elseif($employee->getRealization($year,$quarter) > 80 && $employee->getRealization($year,$quarter) <= 100)
                                    <td>1</td>
                                    <td>{{ $item->individually }}</td>
                                    <td>?</td>
                                @elseif($employee->getRealization($year,$quarter) > 100 && $employee->getRealization($year,$quarter) <= 150)
                                    <td>1.5</td>
                                    <td>{{ $item->individually * 1.5 }}</td>
                                    <td>?</td>
                                @endif
                            @else
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            @endif
                        @endforeach
                    @endif
                    <td>
{{--                        <a href="{{ route('reference.bonus.edit',['user' => $employee, 'quarter' => $quarter, 'year' => $year]) }}"><i class="fas fa-pencil" aria-hidden="true"></i></a>--}}
                        <x-mary-button icon="o-pencil" label="Edytuj" wire:click="edit({{$employee->id}})" spinner class="bg-green-500 btn-sm mb-4" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <livewire:components.bonus.edit/>
</div>
