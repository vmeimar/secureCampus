@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('messages.langContract') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="dean_act" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDeanAct') }}</label>
                            <div class="col-md-6">
                                <input id="dean_act"
                                       type="text"
                                       class="form-control"
                                       name="dean_act"
                                       value="{{ $contract['dean_act'] }}"
                                       readonly
                                       autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ada" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAda') }}</label>
                            <div class="col-md-6">
                                <input id="ada"
                                       type="text"
                                       class="form-control"
                                       name="ada"
                                       value="{{ $contract['ada'] }}"
                                       readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="adam" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAdam') }}</label>
                            <div class="col-md-6">
                                <input id="adam"
                                       type="text"
                                       class="form-control"
                                       name="adam"
                                       value="{{ $contract['adam'] }}"
                                       readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contract_start_date" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDate') }}</label>
                            <div class="col-md-6">
                                <input id="contract_start_date"
                                       type="date"
                                       class="form-control"
                                       name="contract_start_date"
                                       value="{{ $contract['contract_start_date'] }}"
                                       readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-4">
                                <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-primary">{{ __('messages.langEdit') }}</a>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('contract.destroy', $contract->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            onclick="return confirm('{{ __('messages.langConfirmDelete') }}')"
                                            class="btn btn-danger">
                                        {{ __('messages.langDelete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('app.index') }}" class="btn btn-secondary m-4">{{ __('messages.langBack') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
