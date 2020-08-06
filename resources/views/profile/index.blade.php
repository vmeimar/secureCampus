@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://upload.wikimedia.org/wikipedia/el/2/2b/Logo_uoa_blue.png" class="w-100">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h2>Καλωσήρθατε στην πλατφόρμα Secure Campus του ΕΚΠΑ</h2>
            </div>
            <div class="pt-2">
                <div>Είστε συνδεδεμένος/η ως <strong>{{ $user->name }} {{ $user->surname }}</strong></div>
                @can('admin')
                <div><strong>Ρόλος:</strong> {{ implode(", ", $userRoles) }}</div>
                @endcan
                <div class="pt-3">
                    <p>Μέσα από την εφαρμογή, μπορείτε να διαχειριστείτε τη φύλαξη του Ιδρύματος.</p>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-8 mb-4 d-flex">
                    @can('manage-security')
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Φύλακες / Εταιρίες</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Διαχειριστείτε τους Φύλακες και τις Εταιρίες Φύλαξης</h5>
                            <p class="card-text">Πατήστε το παρακάτω πλήκτρο για να συνεχίσετε</p>
                            <a href="/security/index" class="btn btn-primary">Διαχείριση</a>
                        </div>
                    </div>
                    @endcan
                    @can('view-shifts')
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Βάρδιες / Σημεία Φύλαξης</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Έλεγχος και Παραλαβή Υπηρεσιών στις Βάρδιες των σημείων φύλαξης από τους Επόπτες</h5>
                            <p class="card-text">Πατήστε το παρακάτω πλήκτρο για να συνεχίσετε</p>
                            <a href="{{ route('shift.index') }}" class="btn btn-primary">Είσοδος</a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            @can('doy')
            <div class="row">
                <div class="col-8 mb-4 d-flex">
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Διαχείριση Παραμέτρων</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Διαχειριστείτε τις παραμέτρους της Εφαρμογής</h5>
                            <p class="card-text">Πατήστε το παρακάτω πλήκτρο για να συνεχίσετε</p>
                            <a href="{{ route('app.index') }}" class="btn btn-primary">Είσοδος</a>
                        </div>
                    </div>
            @endcan
                    <div class="card mr-2" style="width: 1000px">
                        <div class="card-header">
                            <strong>Επιτροπή Παραλαβής Υπηρεσιών Φύλαξης</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">exports</h5>
                            <p class="card-text">exports</p>
                            <a href="/security/choose-company" class="btn btn-primary">Είσοδος</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
