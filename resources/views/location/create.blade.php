@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Δημιουργία Νέου Σημείου Φύλαξης</strong></div>
                    <div class="card-body">
                        <form method="post" action="/l" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Κτήριο/Θέση</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}"
                                           autocomplete="name" autofocus>

                                    @error('name')
                                    <strong>Εισάγετε όνομα</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Δημιουργία</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/shift/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
