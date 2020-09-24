@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Βάρδιες - Συντελεστές προσαύξησης</strong></div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center">#</th>
                                <th scope="col" style="text-align: center">Όνομα</th>
                                <th scope="col" style="text-align: center">Τιμή</th>
                                    <th scope="col" style="text-align: center">Ενέργειες</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($factors as $factor)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ $factor->id }}</th>
                                    <td style="text-align: center">{{ $factor->name_greek }}</td>
                                    <td style="text-align: center">{{ $factor->rate }}</td>
                                    <td style="text-align: center">
                                        <a href="{{route('factor.edit', $factor->id)}}" class="btn btn-primary btn-sm">Επεξεργασία</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                    <div class="d-flex">
                        <div class="row">
                            <a href="/app/index" class="btn btn-secondary m-4">Πίσω</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
