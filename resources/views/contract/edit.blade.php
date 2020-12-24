@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><strong>{{ __('messages.langEdit') }} {{ __('messages.langOfContract') }}</strong></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('contract.update', $contract->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="dean_act" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDeanAct') }}</label>
                                <div class="col-md-6">
                                    <input id="dean_act"
                                           type="text"
                                           class="form-control"
                                           name="dean_act"
                                           value="{{ $contract['dean_act'] }}"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ada" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAda') }}</label>
                                <div class="col-md-6">
                                    <input id="ada"
                                           type="text"
                                           class="form-control"
                                           name="ada"
                                           value="{{ $contract['ada'] }}"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adam" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAdam') }}</label>
                                <div class="col-md-6">
                                    <input id="adam"
                                           type="text"
                                           class="form-control"
                                           name="adam"
                                           value="{{ $contract['adam'] }}"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contract_start_date" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDate') }}</label>
                                <div class="col-md-6">
                                    <input id="contract_start_date"
                                           type="date"
                                           class="form-control"
                                           name="contract_start_date"
                                           value="{{ $contract['contract_start_date'] }}"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.langSave') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('app.index') }}" class="btn btn-secondary m-4">{{ __('messages.langBack') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
