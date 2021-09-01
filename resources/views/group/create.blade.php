@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><strong>{{ __('messages.langCreate') }} {{ __('messages.langOfGroup') }}</strong></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('group.store') }}" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.langGroupName') }}</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ada" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAda') }} ({{ __('messages.langOptional') }})</label>
                                <div class="col-md-6">
                                    <input id="ada"
                                           type="text"
                                           class="form-control"
                                           name="ada">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dean-act" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDeanAct') }} ({{ __('messages.langOptional') }})</label>
                                <div class="col-md-6">
                                    <input id="dean-act"
                                           type="text"
                                           class="form-control"
                                           name="dean-act">
                                </div>
                            </div><div class="form-group row">
                                <label for="contract-type" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDocumentType') }}</label>
                                <div class="col-md-6">
                                    <select id="contract-type"
                                           type="text"
                                           class="form-control"
                                           name="contract-type">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="1">type 1</option>
                                        <option value="2">type 2</option>
                                        <option value="3">type 3</option>
                                    </select>
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
                    <a href="{{ route('group.index') }}" class="btn btn-secondary m-4">{{ __('messages.langBack') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
