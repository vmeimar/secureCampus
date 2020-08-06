@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @can('supervisor')
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Επιλογή Βαρδιών</strong>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="row col-md-8">
                                    <h6>
                                        <strong>
                                            Έχετε τη δυνατότητα να εμφανίσετε ως Επόπτης και να εκτυπώσετε τις αποθηκευμένες
                                            βάρδιες οι οποίες εκτελέστηκαν ανά σημείο φύλαξης και ανά μήνα και έτος, ή να δείτε
                                            το σύνολο όλων παρακάτω.
                                        </strong>
                                    </h6>
                                </div>
                            </div>
                            <form method="post" action="{{ route('active-shift.show-by-location') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="location" class="col-md-4 col-form-label text-md-right"><strong>Επιλέξτε σημείο φύλαξης</strong></label>
                                    <div class="col-md-4">
                                        <select required name="location" id="location" class="form-control input-lg dynamic">
                                            <option disabled selected value="">Σημεία Φύλαξης</option>
                                            @foreach($user->locations()->get() as $location)
                                                <option value="{{ $location->id }}">
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                        <strong>Παρακαλώ εισάγετε τοποθεσία</strong>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="form-group row">
                                        <label for="month" class="col-md-4 col-form-label text-md-right"><strong>Επιλέξτε μήνα και έτος για εξαγωγή</strong></label>
                                        <div class="col-md-2">
                                            <select required name="month" id="month" class="form-control input-lg dynamic">
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
                                            <select required name="year" id="year" class="form-control input-lg dynamic">
                                                <option disabled selected value="">Επιλέξτε Έτος</option>
                                                @foreach($monthsYears['years'] as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                            @error('year')
                                            <strong>Παρακαλώ επιλέξτε έτος</strong>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary ml-5" style="max-height: 35px">Εμφάνιση</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                @endcan

                @can('epitropi')
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Σύνολο Εκτελεσμένων Βαρδιών</strong>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="row col-md-8">
                                    <h6>
                                        <strong>
                                            Εξαγωγή αρχείου PDF με το σύνολο των βαρδιών για κάθε σημείο φύλαξης ανά μήνα και έτος ως Επιτροπή.
                                        </strong>
                                    </h6>
                                </div>
                            </div>
                            <form method="post" action="{{ route('active-shift.export-committee-pdf') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="month" class="col-md-4 col-form-label text-md-right"><strong>Επιλέξτε μήνα και έτος για εξαγωγή</strong></label>
                                    <div class="col-md-2">
                                        <select required name="month" id="month" class="form-control input-lg dynamic">
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
                                        <select required name="year" id="year" class="form-control input-lg dynamic">
                                            <option disabled selected value="">Επιλέξτε Έτος</option>
                                            @foreach($monthsYears['years'] as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                        @error('year')
                                        <strong>Παρακαλώ επιλέξτε έτος</strong>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-danger ml-5" style="max-height: 35px">Εξαγωγή</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan

                <div class="card">
                    <div class="card-header">
                        <strong>Βάρδιες οι οποίες εκτελέστηκαν</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col">Υποβολή</th>
                                <th scope="col" class="text-center">Ισοδύναμες Ώρες</th>
                                @canany(['confirm-shifts', 'confirm-shifts-steward'])
                                    <th scope="col">Ενέργειες</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activeShifts as $activeShift)
                                <tr>
                                    <th scope="row">{{ $activeShift['id'] }}</th>
                                    <td>{{ $activeShift['name'] }}</td>
                                    <td>
                                        @foreach($activeShift->guards()->get()->toArray() as $guard)
                                            {{ $guard['surname'] }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['from'])) }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($activeShift['until'])) }}</td>
                                    <td style="text-align: center"><strong>{{ $activeShift['confirmed_supervisor'] ? 'Ναι' : 'Όχι'}}</strong></td>
                                    <td style="text-align: center">{{ $activeShift['factor'] }}</td>
                                    <td>
                                        @can('confirm-shifts')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-supervisor" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" style="width: 100px" class="btn btn-primary btn-sm ml-2 mr-2">
                                                        {{ $activeShift->confirmed_supervisor == 0 ? 'Υποβολή' : 'Υπεβλήθη'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
{{--                                        @can('confirm-shifts-steward')--}}
{{--                                            <div class="row mb-1">--}}
{{--                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-steward" method="POST" class="float-left">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('patch')--}}
{{--                                                    <button type="submit" style="width: 100px" class="btn btn-info btn-sm ml-2 mr-2">--}}
{{--                                                        {{ $activeShift->confirmed_steward == 0 ? 'Επιβαβαίωση' : 'Κατάργηγη επιβεβαίωσης'}}--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        @endcan--}}
                                        @can('edit-shifts')
                                        <div class="row mb-1">
                                            <a href="{{ route('active-shift.edit', $activeShift->id) }}" style="width: 100px" class="btn btn-warning btn-sm ml-2 mr-2">Επεξεργασία</a>
                                        </div>
                                        @endcan
                                        @can('assign-shifts')
                                            @if($activeShift->confirmed_supervisor == 0)
                                            <div class="row">
                                                <form action="{{ route('active-shift.destroy', $activeShift) }}" method="POST" class="float-left">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Επιβεβαίωση διαγραφής')" style="width: 100px" class="btn btn-danger btn-sm ml-2 mr-2">Διαγραφή</button>
                                                </form>
                                            </div>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        {{ $activeShifts->links() }}
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <a href="/shift/index" class="btn btn-secondary m-4">Πίσω</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
