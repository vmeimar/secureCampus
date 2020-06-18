@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Επεξεργασία </strong></div>

                    <div class="card-body">
                        <form method="post" action="{{ route('factor.update', $factor->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Τύπος</label>
                                <div class="col-md-4">

                                    <input id="name"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ $factor->name_greek }}"
                                           readonly
                                           autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rate" class="col-md-4 col-form-label text-md-right">Τιμή</label>
                                <div class="col-md-4">
                                    <input id="rate"
                                           type="text"
                                           class="form-control"
                                           name="rate"
                                           value="{{ $factor->rate }}"
                                           autocomplete="rate" autofocus>

                                    @error('rate')
                                    <strong>Συμπληρώστε την τιμή</strong>
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
                    <a href="/factor/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>

            </div>
        </div>
    </div>
@endsection
