@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Επεξεργασία</strong></div>
                    <div class="card-body">
                        <form method="post" action="/shift/{{ $shift->id }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Σημείο Φύλαξης</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option selected>{{ $shift->location->name }}</option>
                                        @foreach($user->locations()->get() as $location)
                                            <option value="{{ $location->id }}">
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <strong>Επιλέξτε Σημείο Φύλαξης</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="number-of-guards" class="col-md-4 col-form-label text-md-right">Αριθμός Φυλάκων</label>
                                <div class="col-md-6">
                                    <select name="number-of-guards" id="number-of-guards" class="form-control input-lg dynamic">
                                        <option value="{{ $shift->number_of_guards }}" selected>
                                            {{ $shift->number_of_guards }}
                                        </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    @error('number-of-guards')
                                        <strong>Επιλέξτε Αριθμό Φυλάκων</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">Ώρες Φύλαξης (Έναρξη - Λήξη)</label>
                                <div class="col-md-6 d-flex">
                                    <div class="col-md-6">
                                        <input id="shift-from"
                                               type="time"
                                               class="form-control"
                                               name="shift-from"
                                               value="{{ $shift->shift_from }}"
                                               autocomplete="shift-from"
                                               autofocus>
                                        @error('shift-from')
                                        <strong>Επιλέξτε Έναρξη</strong>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input id="shift-until"
                                               type="time"
                                               class="form-control"
                                               name="shift-until"
                                               value="{{ $shift->shift_until }}"
                                               autocomplete="shift-until"
                                               autofocus>
                                        @error('shift-until')
                                        <strong>Επιλέξτε Λήξη</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shift-name" class="col-md-4 col-form-label text-md-right">Όνομα Βάρδιας</label>

                                <div class="col-md-6">
                                    <input id="shift-name"
                                           value="{{ old('shift-name') ?? $shift->name }}"
                                        type="text"
                                        class="form-control @error('shift-name') is-invalid @enderror"
                                        name="shift-name" value="{{ old('shift-name') }}"
                                        required autocomplete="shift-name"
                                        autofocus>

                                    @error('shift-name')
                                        <strong>Εισάγετε Όνομα Βάρδιας (π.χ. Σημείο Φύλαξης Χ, πρωινή βάρδια)</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shift-type" class="col-md-4 col-form-label text-md-right">Τύπος Βάρδιας</label>
                                <div class="col-md-6">
                                    <select name="shift-type" id="shift-type" class="form-control input-lg dynamic">
                                        <option selected value="{{ $shift->shift_type }}">{{ $type }}</option>
                                        <option value="weekdays">Καθημερινές</option>
                                        <option value="saturday">Σάββατο</option>
                                        <option value="holiday">Κυριακή/Αργίες</option>
                                    </select>
                                    @error('shift-type')
                                    <strong>Επιλέξτε Τύπο</strong>
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
                    <a href="/shift/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
