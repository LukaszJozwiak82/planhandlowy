<div>
    <div>
        <!-- CSS -->
        <style type="text/css">
            .search-box .clear {
                clear: both;
                /* margin-top: 20px; */
            }

            .search-box ul {
                list-style: none;
                padding: 0px;
                width: 250px;
                position: absolute;
                margin: 0;
                background: white;
                z-index: 100;
            }

            .search-box ul li {
                background: lavender;
                padding: 4px;
                margin-bottom: 1px;
            }

            .search-box ul li:nth-child(even) {
                background: cadetblue;
                color: white;
            }

            .search-box ul li:hover {
                cursor: pointer;
            }

            .search-box input[type=text] {
                padding: 5px;
                width: 250px;
                letter-spacing: 1px;
            }
        </style>

        <div class="search-box">
            <div class="row form-group mb-2">
                <label class="col-sm-4 col-form-label" for="modulo">Modulo klienta</label>
                <div class="col-sm-2">
                    <input wire:model.live="search" wire:keyup="searchResult" class="form-control" name="modulo" type="text">
                    @if ($showdiv)
                        <ul>
                            @if (!empty($records))
                                @foreach ($records as $record)
                                    <li wire:click="fetchEmployeeDetail({{ $record->id }})">{{ $record->modulo }}</li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                </div>
                <!-- Search result list -->
            </div>


        </div>

    </div>
</div>
