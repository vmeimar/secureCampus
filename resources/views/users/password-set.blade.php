@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <strong>Δημιουργία Κωδικού Πρόσβασης</strong>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Δημιουργία Σφάλματος</strong> <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/set/password') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Όνομα</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Επώνυμο</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ $user->surname }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Διεύθυνση Email</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Κωδικός Πρόσβασης</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Επαλήθευση Κωδικού</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Αποθήκευση
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
