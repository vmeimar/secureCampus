@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><strong>{{ __('messages.langEdit') }} {{ __('messages.langOfGroup') }}</strong></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('group.update', $group->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.langGroupName') }}</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ $group['name'] }}"
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
                    <a href="{{ route('group.index') }}" class="btn btn-secondary m-4">{{ __('messages.langBack') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
