<div>
    <h4>Plan na kwartał</h4>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                @foreach ($departments as $departament)
                    <th>
                        {{ $departament->name }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>PUNKTY DLA ODDZIAŁU</td>
                @foreach($departments as $key => $departament)
                    <td>{{ $pointsForDepartament[$key + 1] }}</td>
                @endforeach

            </tr>
            <tr>
                <td>WYKONANIE [%]</td>
                @foreach($departments as $key => $departament)
                    <td>{{$quartelyPercentSales[$key + 1]}} %</td>
                @endforeach
            </tr>
            <tr>
                <td>WYKONANIE</td>
                @foreach($departments as $key => $departament)
                    <td>{{ $quartelySales[$key + 1] }}</td>
                @endforeach

            </tr>
            </tbody>
        </table>
    </div>
    <h4>Wykonanie planu doradcy</h4>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th>Imię i nazwisko</th>
                <th>Punkty</th>
                @foreach ($loans as $product)
                    <th>
                        {{ $product->name }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($allDataUsers as $user)
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['score'] }}</td>
                    @foreach($loans as $loan)
                        <td>{{ $user[$loan->id] }}</td>
                    @endforeach
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
