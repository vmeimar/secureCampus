@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong>Λειτουργίες</strong>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center mb-5">
                            <div class="row col-md-5">
                                <h6>
                                    <strong>
                                        Έχετε τη δυνατότητα να κάνετε διάφορα.
                                    </strong>
                                </h6>
                            </div>
                        </div>

                        <form method="post" action="{{ route('app.populate-days') }}" enctype="multipart/form-data">
                            <div class="d-flex">
                                    @csrf
                                    <div class="col-md-6">
                                        <p><strong>Γέμισμα πίνακα ημερών του έτους</strong></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Εκτέλεση</button>
                                    </div>
                            </div>
                        </form>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <p><strong>Εμφάνιση και Επεξεργασία Συντελεστών Βαρδιών</strong></p>
                            </div>
                            <div class="form-group col-md-4">
                                <a href="{{ route('factor.index') }}" class="btn btn-primary">Προβολή</a>
                            </div>
                        </div>


                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <p><strong>Χρησιμοποιήστε την παρακάτω λειτουργία για εισαγωγή αρχείου Excel με τις αργίες του έτους.</strong></p>
                            </div>
                            <div class="row">
                                <form action="{{ route('holidays.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="file" name="import_file" class="mt-4 ml-4"/>
                                        <input type="submit" value="Εισαγωγή Αργιών Έτους" class="btn btn-success mt-4 ml-2"/>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Επιστροφή στο Προφίλ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
