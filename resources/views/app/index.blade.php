@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Λειτουργίες</strong>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center mb-4">
                            <div class="row col-md-8">
                                <h6>
                                    <strong>
                                        Έχετε τη δυνατότητα να κάνετε διάφορα.
                                    </strong>
                                </h6>
                            </div>
                        </div>

                        <form method="post" action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <p>populate days table</p>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-primary">Populate</button>
                            </div>
                        </form>



                        <form method="post" action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <p>manage factors</p>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="row">
                    <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Επιστροφή στο Προφίλ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
