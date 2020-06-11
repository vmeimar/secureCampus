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
                <div>Είστε συνδεδεμένος/η ως <strong>{{ $user->name }}</strong></div>
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
                    <div class="card mr-2">
                        <div class="card-header">
                            Φύλακες / Εταιρίες
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Διαχειριστείτε τους Φύλακες και τις Εταιρίες Φύλαξης</h5>
                            <p class="card-text">Πατήστε το παρακάτω πλήκτρο για να συνεχίσετε</p>
                            <a href="/security/index" class="btn btn-primary">Διαχείριση</a>
                        </div>
                    </div>
                    @endcan

                    @can('view-shifts')
                    <div class="card mr-2">
                        <div class="card-header">
                            Βάρδιες / Σημεία Φύλαξης
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Διαχειριστείτε τις Βάρδιες και τα Σημεία Φύλαξης</h5>
                            <p class="card-text">Πατήστε το παρακάτω πλήκτρο για να συνεχίσετε</p>
                            <a href="{{ route('shift.index') }}" class="btn btn-primary">Διαχείριση</a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
