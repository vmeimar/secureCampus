@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong>Παράμετροι Εφαρμογής</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-5">
                            <div class="row col-md-10">
                                <h6 style="text-align: justify">
                                    <strong>
                                        Χρησιμοποιείστε τις παρακάτω λειτουργίες για να ορίσετε ποιες μέρες είναι αργίες,
                                        να προσδιορίσετε τους συντελεστές προσαύξησης για κάθε βάρδια
                                        και να ορίσετε τους χρήστες που μπορούν να έχουν πρόσβαση στην εφαρμογή.
                                    </strong>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-md-6">
                                <p><strong>Εμφάνιση και επεξεργασία των συντελεστών προσαύξησης ανάλογα με τις βάρδιες</strong></p>
                            </div>
                            <div class="form-group col-md-4">
                                <a href="{{ route('factor.index') }}" class="btn btn-primary">Προβολή</a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-md-6">
                                <p><strong>Εμφάνιση και επεξεργασία των στοιχείων της Σύμβασης</strong></p>
                            </div>
                            <div class="form-group col-md-4">
                                <a href="{{ route('contract.index') }}" class="btn btn-primary">Προβολή</a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <p><strong>Χρησιμοποιήστε την παρακάτω λειτουργία για εισαγωγή αρχείου Excel με τις αργίες καθ' όλη τη διάρκεια της σύμβασης.</strong></p>
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
                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <p><strong>Χρησιμοποιήστε την παρακάτω λειτουργία για εισαγωγή αρχείου Excel με τα
                                        E-mail των χρηστών οι οποίοι δικαιούνται να έχουν πρόσβαση στην εφαρμογή.</strong></p>
                            </div>
                            <div class="row">
                                <form action="{{ route('user-emails.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="file" name="import_file" class="mt-4 ml-4"/>
                                        <input type="submit" value="Εισαγωγή E-mail" class="btn btn-success mt-4 ml-2"/>
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
