@extends('theme.default')

@section('content')

    <div id="wrapper">

        <div id="content-wrapper">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Data Table Example</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <form method="GET" action="{{route('sort')}}">
                                <div class="form-group">
                                    <label for="sel1">Select list:</label>
                                    <select name="sort" class="form-control" id="address" onchange="this.form.submit()">
                                        {{--данные выводим из конфига--}}
                                        @foreach($geoData as $data)
                                            <option value="{{  $data->address  }}">{{ $data->address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Area</th>
                                <th>Distance</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($sortGeoData as $key => $data)
                                    <tr>
                                        <td>{{ $area }} -> {{ $key }}</td>
                                        <td>{{ $data->text }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection