@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://upload.wikimedia.org/wikipedia/el/2/2b/Logo_uoa_blue.png" class="w-100">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h2>Συμβάσεις</h2>
            </div>
            <div class="pt-2">
                <div><strong>{{ $user->name }} {{ $user->surname }}</strong></div>
                @can('admin')
                <div><strong>{{ implode(", ", $userRoles) }}</strong></div>
                @endcan
                <hr>
            </div>
            <div class="row">
                <div class="col-8 mb-4 d-flex">
                    @can('manage-security')
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Χρήστες Συστήματος</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Δημιουργία και Επεξεργασία Ομάδων Χρηστών</h5>
                            <p class="card-text">Πατήστε παρακάτω για να συνεχίσετε</p>
                            <a href="{{ route('group.index') }}" class="btn btn-primary">Είσοδος</a>
                        </div>
                    </div>
                    @endcan
{{--                    @can('view-shifts')--}}
{{--                    <div class="card mr-2" style="width: 1000px">--}}
{{--                        <div class="card-header">--}}
{{--                            <strong>Βάρδιες / Σημεία Φύλαξης</strong>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Σημεία Φύλαξης και Βάρδιες - Έλεγχος και Παραλαβή Υπηρεσιών ανά Βάρδια από τους Επόπτες</h5>--}}
{{--                            <p class="card-text">Πατήστε παρακάτω για να συνεχίσετε</p>--}}
{{--                            <a href="{{ route('shift.index') }}" class="btn btn-primary">Είσοδος</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endcan--}}
                </div>
            </div>
            <div class="row">
                <div class="col-8 mb-4 d-flex">
                    @can('doy')
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Δημιουργία & Διαχείριση Συμβάσεων</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Διαχειριστείτε τις Συμβάσεις της Εφαρμογής</h5>
                            <p class="card-text">Πατήστε παρακάτω για να συνεχίσετε</p>
                            <a href="{{ route('app.index') }}" class="btn btn-primary">Είσοδος</a>
                        </div>
                    </div>
                    @endcan
{{--                    @can('epitropi')--}}
{{--                    <div class="card mr-2" style="width: 1000px">--}}
{{--                        <div class="card-header">--}}
{{--                            <strong>Επιτροπή Παραλαβής Υπηρεσιών Φύλαξης</strong>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Εξαγωγή Μηνιαίας Βεβαίωσης Επιτροπής Παραλαβής</h5>--}}
{{--                            <p class="card-text">Πατήστε παρακάτω για να συνεχίσετε</p>--}}
{{--                            <a href="/security/choose-company" class="btn btn-primary">Είσοδος</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endcan--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
