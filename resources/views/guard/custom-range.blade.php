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
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
{{--                                <th scope="col">Ημερομηνία</th>--}}
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col" style="text-align: center">Διάρκεια</th>
                                <th scope="col">Ισοδύναμες Ώρες</th>
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
{{--                                    <td>{{ date('d/m/yy', strtotime($activeShift['date'])) }}</td>--}}
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['from'])) }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['until'])) }}</td>
                                    <td style="text-align: center">{{ $activeShift['duration'] }}</td>
                                    <td style="text-align: center">{{ $activeShift['factor'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>ΣΥΝΟΛΟ</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
{{--                                <td></td>--}}
                                <td style="text-align: center"><strong>{{ $totalDuration }}</strong></td>
                                <td style="text-align: center"><strong>{{ $totalCredits }}</strong></td>
                            </tr>
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
