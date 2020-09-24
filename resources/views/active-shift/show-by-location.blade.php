@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 scroll">
                <div class="card">
                    <div class="card-header">
                        <strong>Αποθηκευμένες Βάρδιες</strong>
                    </div>
                    <div class="card-body">
                        <div class="m-4" style="text-align: justify"><p><strong>Η εξαγωγή αρχείων excel ή pdf, γίνεται μόνο για βάρδιες οι οποίες έχουν υποβληθεί από τον Επόπτη.
                        Μπορείτε να υποβάλετε κάθε βάρδια ξεχωριστά αν επιστρέψετε στην προηγούμενη σελίδα ή να πραγματοποιείσετε συνολική υποβολή
                                στις βάρδιες οι οποίες εμφανίζονται εδώ ανά σημείο φύλαξης.</strong></p></div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" style="position: relative; max-height: 700px; overflow: auto; display: block">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col">Έγινε Υποβολή</th>
                                <th scope="col">Ισοδύναμες Ώρες</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activeShifts as $activeShift)
                                <tr>
                                    <th scope="row">{{ $activeShift['id'] }}</th>
                                    <td>{{ $activeShift['name'] }}</td>
                                    <td>
                                        @foreach($activeShift->guards()->get()->toArray() as $guard)
                                            {{ $guard['surname'] }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['from'])) }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['until'])) }}</td>
                                    <td style="text-align: center"><strong>{{ $activeShift['confirmed_supervisor'] ? 'Ναι' : 'Όχι'}}</strong></td>
                                    <td style="text-align: center">{{ $activeShift['factor'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <a href="/active-shift/index" class="btn btn-secondary m-4">Πίσω</a>
                    </div>
                    <form method="post" action="{{ route('active-shift.export-by-location', $locationId)}}" enctype="multipart/form-data">
                        @csrf
                        @foreach($activeShifts as $activeShift)
                            <input type="hidden" name="activeShifts[]" value="{{ $activeShift->id }}">
                        @endforeach
                        <div class="row">
                            <button type="submit" class="btn btn-success m-4" style="max-height: 35px">Βάρδιες (Excel)</button>
                        </div>
                    </form>
                    <form method="post" action="{{ route('active-shift.export-pdf', $locationId) }}" enctype="multipart/form-data">
                        @csrf
                        <input name="year" id="year" type="hidden" value="{{$year}}">
                        <div class="row">
                            <button type="submit" class="btn btn-danger m-4" style="max-height: 35px">Βεβαίωση Επόπτη (PDF)</button>
                            <input name="month" id="month" type="hidden" value="{{$month}}">
                        </div>
                    </form>
                    <form method="post" action="/active-shift/{{$locationId}}/confirm-all-supervisor" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <button type="submit" class="btn btn-primary m-4" style="max-height: 35px">Υποβολή Όλων</button>
                            <input name="month" id="month" type="hidden" value="{{$month}}">
                            <input name="year" id="year" type="hidden" value="{{$year}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
