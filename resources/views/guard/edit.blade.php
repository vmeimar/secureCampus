@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Edit {{ $guard->name }} {{ $guard->surname }}</strong></div>

                    <div class="card-body">
                        <form method="post" action="/g/{{ $guard->id }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Guard's Name</label>
                                <div class="col-md-6">

                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ $guard->name }}"
                                           autocomplete="name" autofocus>

                                    @error('name')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Guard's Surname</label>
                                <div class="col-md-6">

                                    <input id="surname"
                                           type="text"
                                           class="form-control @error('surname') is-invalid @enderror"
                                           name="surname"
                                           value="{{ $guard->surname }}"
                                           autocomplete="surname" autofocus>

                                    @error('surname')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">Company</label>
                                <div class="col-md-6">

                                    <input id="company"
                                           type="text"
                                           class="form-control @error('company') is-invalid @enderror"
                                           name="company"
                                           value="{{ $guard->company()->value('name') }}"
                                           readonly
                                           autocomplete="company" autofocus>

                                    @error('company')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/security/index" class="btn btn-secondary m-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection