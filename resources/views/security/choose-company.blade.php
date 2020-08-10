@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Επιλογή Εταιρίας Φύλαξης για εξαγωγή στοιχείων</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('security.choose-export') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="d-flex">
                                    <label for="company" class="col-md-4 col-form-label text-md-right">Επιλέξτε Εταιρία</label>
                                    <div class="col-md-6">
                                        <select name="company" id="company" class="form-control input-lg" required>
                                            <option disabled selected value="">Επιλέξτε Εταρία</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company')
                                        <strong>Παρακαλώ επιλέξτε Εταιρία</strong>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 10px; max-height: 35px;">Εμφάνιση</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>

@endsection
