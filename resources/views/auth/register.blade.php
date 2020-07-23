@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Εγγραφή Χρήστη</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Όνομα</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Επώνυμο</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Κωδικός Πρόσβασης</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Επιβεβαίωση Κωδικού</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tier" class="col-md-4 col-form-label text-md-right">Βαθμίδα</label>
                            <div class="col-md-6">
                                <select name="tier" id="tier" class="form-control input-lg dynamic" required>
                                    <option disabled selected value="">Επιλέξτε Βαθμίδα</option>
                                    <option value="Καθηγητής">Καθηγητής</option>
                                    <option value="Καθηγήτρια">Καθηγήτρια</option>
                                    <option value="Αναπλ. Καθηγητής">Αναπλ. Καθηγητής</option>
                                    <option value="Αναπλ. Καθηγήτρια">Αναπλ. Καθηγήτρια</option>
                                    <option value="Λέκτορας">Λέκτορας</option>
                                    <option value="Ε.ΔΙ.Π.">Ε.ΔΙ.Π.</option>
                                    <option value="Ε.Ε.Π.">Ε.Ε.Π.</option>
                                    <option value="Ε.ΤΕ.Π.">Ε.ΤΕ.Π.</option>
                                    <option value="Διοικητικός Υπάλληλος">Διοικητικός Υπάλληλος</option>
                                </select>
                                @error('tier')
                                <strong>Παρακαλώ επιλέξτε βαθμίδα</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Εγγραφή
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
