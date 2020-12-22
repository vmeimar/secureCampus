@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Επεξεργασία Σύμβασης</strong></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('contract.update', $contract->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="dean_act" class="col-md-4 col-form-label text-md-right">Πράξη Πρύτανη</label>
                                <div class="col-md-6">
                                    <input id="dean_act"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="dean_act"
                                           value="{{ $contract['dean_act'] }}"
                                           autocomplete="dean_act"
                                           required
                                           autofocus>
                                    @error('name')
                                    <strong>Υποχρεωτικό Πεδίο</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ada" class="col-md-4 col-form-label text-md-right">ΑΔΑ</label>
                                <div class="col-md-6">
                                    <input id="ada"
                                           type="text"
                                           class="form-control @error('ada') is-invalid @enderror"
                                           name="ada"
                                           value="{{ $contract['ada'] }}"
                                           autocomplete="ada"
                                           required
                                           autofocus>
                                    @error('ada')
                                    <strong>Υποχρεωτικό Πεδίο</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adam" class="col-md-4 col-form-label text-md-right">ΑΔΑΜ</label>
                                <div class="col-md-6">
                                    <input id="adam"
                                           type="text"
                                           class="form-control @error('adam') is-invalid @enderror"
                                           name="adam"
                                           value="{{ $contract['adam'] }}"
                                           autocomplete="adam"
                                           required
                                           autofocus>
                                    @error('adam')
                                    <strong>Υποχρεωτικό Πεδίο</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contract_start_date" class="col-md-4 col-form-label text-md-right">Ημερομηνία</label>
                                <div class="col-md-6">
                                    <input id="contract_start_date"
                                           type="date"
                                           class="form-control @error('contract_start_date') is-invalid @enderror"
                                           name="contract_start_date"
                                           value="{{ $contract['contract_start_date'] }}"
                                           autocomplete="contract_start_date"
                                           required
                                           autofocus>
                                    @error('month')
                                    <strong>Υποχρεωτικό Πεδίο</strong>
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
                    <a href="/contract/index" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection