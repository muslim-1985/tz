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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Address</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($geoData as $data)
                                    <tr>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->lat }}</td>
                                        <td>{{ $data->lng }}</td>
                                        <td>
                                            <form action="{{route('destroy', [$data->id])}}" method="POST" style="display: inline-block">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="submit"  class="btn btn-danger" onclick="if(!confirm('Вы действительно хотите удалить геоданные?')) return false">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('edit', $data->id) }}">
                                                <button class="btn btn-info" style="display: inline-block">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
</div>
@endsection