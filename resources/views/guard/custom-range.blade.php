@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Ενεργές Βάρδιες</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
                                <th scope="col">Ημερομηνία</th>
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col">Συντελεστής</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activeShifts as $activeShift)
                                <tr>
                                    <th scope="row">{{ $activeShift['id'] }}</th>
                                    <td>{{ $activeShift['name'] }}</td>
                                    <td>
                                        @foreach($activeShift->guards()->get()->toArray() as $shiftGuard)
                                            {{ $shiftGuard['surname'] }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ date('d M y', strtotime($activeShift['date'])) }}</td>
                                    <td>{{ $activeShift['from'] }}</td>
                                    <td>{{ $activeShift['until'] }}</td>
                                    <td>{{ $activeShift['factor'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <a href="/guard/{{ $guard->id }}" class="btn btn-secondary m-4">Πίσω</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
