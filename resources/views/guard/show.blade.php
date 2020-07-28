@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $guard->name }} {{ $guard->surname }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <div class="row col-md-8">
                                <h6>
                                    <strong>
                                        Έχετε τη δυνατότητα να εμφανίσετε τις βάρδιες του/της φύλακα {{ $guard->name }} {{ $guard->surname }}
                                        για συγκεκριμένο χρονικό διάστημα ή να εξάγετε αρχείο τύπου excel ανά μήνα ή συνολικά για όλες τις βάρδιες.
                                    </strong>
                                </h6>
                            </div>
                        </div>
                        <form method="post" action="{{ route('guard.custom-range', $guard->id) }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group row">
                                    <label for="date-from" class="col-md-4 col-form-label text-md-right">Επιλέξτε ημερομηνία εμφάνισης (από - μέχρι)</label>
                                    <div class="col-md-2">
                                        <input id="date-from"
                                               type="date"
                                               class="form-control"
                                               name="date-from"
                                               value="{{ old('date-from') }}"
                                               autocomplete="date-from"
                                               autofocus>
                                        @error('date-from')
                                        <strong>Παρακαλώ εισάγετε ημερομηνία</strong>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <input id="date-to"
                                               type="date"
                                               class="form-control"
                                               name="date-to"
                                               value="{{ old('date-to') }}"
                                               autocomplete="date-to"
                                               autofocus>
                                        @error('date-to')
                                        <strong>Παρακαλώ εισάγετε ημερομηνία</strong>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="max-height: 35px">Εμφάνιση</button>
                                </div>
                        </form>
                        <form method="post" action="{{ route('guard.export', $guard->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-4 col-form-label text-md-right">Επιλέξτε μήνα και έτος για εξαγωγή</label>
                                <div class="col-md-2">
                                    <select name="month" id="month" class="form-control input-lg">
                                        <option disabled selected value="">Επιλέξτε Μήνα</option>
                                        <option value="all">Όλοι οι μήνες</option>
                                        @foreach($uniqueMonths as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                    <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <select name="year" id="year" class="form-control input-lg">
                                        <option disabled selected value="">Επιλέξτε Έτος</option>
                                        <option value="all">Όλα τα έτη</option>
                                        @foreach($uniqueYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    @error('year')
                                    <strong>Παρακαλώ επιλέξτε έτος</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success" style="max-height: 35px">Εξαγωγή Excel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/guard/{{ $guard->company->id }}/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
