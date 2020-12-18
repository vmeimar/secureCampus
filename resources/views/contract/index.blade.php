@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Σύμβαση</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="dean_act" class="col-md-4 col-form-label text-md-right">Πράξη Πρύτανη</label>
                            <div class="col-md-6">
                                <input id="dean_act"
                                       type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="dean_act"
                                       value="{{ $contract['dean_act'] }}"
                                       readonly
                                       autocomplete="dean_act" autofocus>
                                @error('name')
                                <strong>Συμπληρώστε όνομα</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ada" class="col-md-4 col-form-label text-md-right">ΑΔΑ</label>
                            <div class="col-md-6">
                                <input id="ada"
                                       type="text"
                                       class="form-control @error('ada') is-invalid @enderror"
                                       name="ada"
                                       value="{{ $contract['ada'] }}"
                                       readonly
                                       autocomplete="ada" autofocus>
                                @error('ada')
                                <strong>Συμπληρώστε επώνυμο</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="adam" class="col-md-4 col-form-label text-md-right">ΑΔΑΜ</label>
                            <div class="col-md-6">
                                <input id="adam"
                                       type="text"
                                       class="form-control @error('adam') is-invalid @enderror"
                                       name="adam"
                                       value="{{ $contract['adam'] }}"
                                       readonly
                                       autocomplete="adam" autofocus>
                                @error('adam')
                                <strong>Διαλέξτε εταιρεία</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contract_start_date" class="col-md-4 col-form-label text-md-right">Ημερομηνία</label>
                            <div class="col-md-6">
                                <input id="contract_start_date"
                                       type="date"
                                       class="form-control @error('contract_start_date') is-invalid @enderror"
                                       name="contract_start_date"
                                       value="{{ $contract['contract_start_date'] }}"
                                       autocomplete="contract_start_date"
                                       readonly
                                       autofocus>
                                @error('month')
                                <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-primary">Επεξεργασία</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('app.index') }}" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
