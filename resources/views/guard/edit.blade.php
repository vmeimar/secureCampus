@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Επεξεργασία {{ $guard->name }} {{ $guard->surname }}</strong></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('guard.update', $guard->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Όνομα</label>
                                <div class="col-md-6">

                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ $guard->name }}"
                                           autocomplete="name" autofocus>

                                    @error('name')
                                    <strong>Συμπληρώστε όνομα</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Επώνυμο</label>
                                <div class="col-md-6">

                                    <input id="surname"
                                           type="text"
                                           class="form-control @error('surname') is-invalid @enderror"
                                           name="surname"
                                           value="{{ $guard->surname }}"
                                           autocomplete="surname" autofocus>
                                    @error('surname')
                                    <strong>Συμπληρώστε επώνυμο</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">Εταιρεία</label>
                                <div class="col-md-6">
                                    <input id="company"
                                           type="text"
                                           class="form-control @error('company') is-invalid @enderror"
                                           name="company"
                                           value="{{ $guard->company()->value('name') }}"
                                           readonly
                                           autocomplete="company" autofocus>
                                    @error('company')
                                    <strong>Διαλέξτε εταιρεία</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/guard/{{ $guard->company->id }}/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
