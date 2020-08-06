@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Υπερεργασία Υπαλλήλων Φύλαξης (Παράρτημα Β)</strong>
                    </div>
                    <div class="card-body">
                        @foreach($data as $guard => $shifts)
                            <ul>
                                <li>
                                    <strong>{{ $guard }}</strong>
                                </li>
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Βάρδια</th>
                                        <th>Έναρξη</th>
                                        <th>Λήξη</th>
                                        <th>Διάρκεια</th>
                                    </tr>
                                    @foreach($shifts as $shift)
                                        <tr>
                                            <td>{{ $shift->id }}</td>
                                            <td>{{ $shift->name }}</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($shift->from)) }}</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($shift->until)) }}</td>
                                            <td>{{ $shift->duration }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </ul>
                        @endforeach
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <a href="/security/choose-company" class="btn btn-secondary m-4">Πίσω</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
