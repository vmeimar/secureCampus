@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Υπερεργασία (ανά ζεύγος βαρδιών)</strong>
                    </div>
                    <div class="card-body">
                        @foreach($overTimeShiftsPair as $pair)
                            <table class="table table-striped table-bordered mb-4">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Βάρδια</th>
                                    <th scope="col">Φύλακες</th>
                                    <th scope="col">Από</th>
                                    <th scope="col">Μέχρι</th>
                                    <th scope="col">Διάρκεια Βάρδιας</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pair as $shift)
                                    <tr>
                                        <th scope="row">{{ $shift['id'] }}</th>
                                        <td>{{ $shift['name'] }}</td>
                                        <td>
                                            @foreach($shift->guards()->get()->toArray() as $guard)
                                                {{ $guard['surname'] }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($shift['from'])) }}</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($shift['until'])) }}</td>
                                        <td style="text-align: center">{{ $shift['duration'] }} ώρες</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
