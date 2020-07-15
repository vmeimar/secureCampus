@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Εξαγωγή Στοιχείων</strong>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center mb-4">
                            <div class="row col-md-8">
                                <h6>
                                    <strong>
                                        Έχετε τη δυνατότητα να εξάγετε αρχείο τύπου Pdf για τις βάρδιες όλων των φυλάκων
                                        ανά μήνα με τις ώρες εργασίας και τις ισοδύναμες μονάδες βάρδιας.
                                    </strong>
                                </h6>
                            </div>
                        </div>

                        <form method="post" action="{{ route('guard.export-all-guards-pdf', $company->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-4 col-form-label text-md-right">Επιλέξτε μήνα για εξαγωγή</label>
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
                                    <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger" style="max-height: 35px">Εξαγωγή PDF</button>
                            </div>
                        </form>

                        <form method="post" action="{{ route('guard.export-committee') }}" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="max-height: 35px; margin-left: 430px">Εξαγωγή Βεβαίωσης Επιτροπής</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/guard/{{ $company->id }}/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
