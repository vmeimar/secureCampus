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
                                           required
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ada" class="col-md-4 col-form-label text-md-right">{{ __('messages.langAda') }} ({{ __('messages.langOptional') }})</label>
                                <div class="col-md-6">
                                    <input id="ada"
                                           type="text"
                                           class="form-control"
                                           name="ada"
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dean_act" class="col-md-4 col-form-label text-md-right">{{ __('messages.langDeanAct') }} ({{ __('messages.langOptional') }})</label>
                                <div class="col-md-6">
                                    <input id="dean_act"
                                           type="text"
                                           class="form-control"
                                           name="dean_act"
                                           autofocus>
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
