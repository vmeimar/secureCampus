@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Εξαγωγή</strong>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center mb-4">
                            <div class="row col-md-8">
                                <h6 class="justify-content-center">
                                    <strong>
                                        Έχετε τη δυνατότητα να εξάγετε αρχείο τύπου Pdf για τις βάρδιες όλων των φυλάκων της εταιρίας
                                        {{ $company->name }} ανά μήνα με τις ώρες εργασίας και τις ισοδύναμες μονάδες βάρδιας.
                                    </strong>
                                </h6>
                            </div>
                        </div>

                        <form method="post" action="{{ route('guard.export-all-guards-pdf', $company->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-6 col-form-label text-md-right">Επιλέξτε μήνα και έτος για εξαγωγή PDF με τις βάρδιες</label>
                                <div class="col-md-2">
                                    <select name="month" id="month" class="form-control input-lg" required>
                                        <option disabled selected value="">Επιλέξτε Μήνα</option>
                                        <option value="all">Όλοι οι μήνες</option>
                                        @foreach($monthsYears['months'] as $month)
                                            <option value="{{ $month['value'] }}">{{ $month['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                    <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <select name="year" id="year" class="form-control input-lg" required>
                                        <option disabled selected value="">Επιλέξτε Έτος</option>
                                        @foreach($monthsYears['years'] as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    @error('year')
                                    <strong>Παρακαλώ επιλέξτε έτος</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger" style="margin-left: 10px; max-height: 35px;">Εξαγωγή</button>
                            </div>
                        </form>

                        @can('epitropi')
                        <form method="post" action="{{ route('guard.export-committee', $company->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-6 col-form-label text-md-right">Επιλέξτε μήνα και έτος για εξαγωγή βεβαίωσης Επιτροπής</label>
                                <div class="col-md-2">
                                    <select name="month" id="month" class="form-control input-lg" required>
                                        <option disabled selected value="">Επιλέξτε Μήνα</option>
                                        @foreach($monthsYears['months'] as $month)
                                            <option value="{{ $month['value'] }}">{{ $month['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                    <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <select name="year" id="year" class="form-control input-lg" required>
                                        <option disabled selected value="">Επιλέξτε Έτος</option>
                                        @foreach($monthsYears['years'] as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    @error('year')
                                    <strong>Παρακαλώ επιλέξτε έτος</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 10px; max-height: 35px;">Εξαγωγή</button>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
                <div class="row">
                    <a href="/guard/{{ $company->id }}/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
