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
                        <form method="post" action="{{ route('guard.export', $guard->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-4 col-form-label text-md-right">Μήνας</label>
                                <div class="col-md-4">
                                    <select name="month" id="month" class="form-control input-lg dynamic">
                                        <option disabled selected value="">Επιλέξτε Μήνα</option>
                                        <option value="all">Όλοι οι μήνες</option>
                                        <option value="01">Ιανουάριος</option>
                                        <option value="02">Φεβρουάριος</option>
                                        <option value="03">Μάρτιος</option>
                                        <option value="04">Απρίλιος</option>
                                        <option value="05">Μάιος</option>
                                        <option value="06">Ιούνιος</option>
                                        <option value="07">Ιούλιος</option>
                                        <option value="08">Αύγουστος</option>
                                        <option value="09">Σεπτέμβριος</option>
                                        <option value="10">Οκτώβριος</option>
                                        <option value="11">Νοέμβριος</option>
                                        <option value="12">Δεκέμβριος</option>
                                    </select>
                                    @error('month')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">Εξαγωγή Excel</button>
                                </div>
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
