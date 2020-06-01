@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Create New Shift</strong></div>

                    <div class="card-body">
                        <form method="post" action="/sh" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option selected disabled>Select Location</option>
                                            @foreach($departments as $department)
                                                <optgroup label="{{ $department->name }}">
                                                    @foreach($department->locations as $location)
                                                        <option value="{{ $location->id }}">
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                    </select>
                                    @error('location')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="number-of-guards" class="col-md-4 col-form-label text-md-right">Number of Guards</label>
                                <div class="col-md-6">
                                    <select name="number-of-guards" id="number-of-guards" class="form-control input-lg dynamic">
                                        <option selected disabled>Number of Guards</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    @error('number-of-guards')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">Time</label>
                                <div class="col-md-6 d-flex">
                                    <div class="col-md-6">
                                        <input id="shift-from"
                                               type="time"
                                               class="form-control"
                                               name="shift-from"
                                               value="{{ old('shift-from') }}"
                                               autocomplete="shift-from"
                                               autofocus>
                                        @error('shift-from')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input id="shift-until"
                                               type="time"
                                               class="form-control"
                                               name="shift-until"
                                               value="{{ old('shift-until') }}"
                                               autocomplete="shift-until"
                                               autofocus>
                                        @error('shift-until')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shift-name" class="col-md-4 col-form-label text-md-right">Shift's Alias</label>

                                <div class="col-md-6">
                                    <input id="shift-name" type="text" class="form-control @error('shift-name') is-invalid @enderror" name="shift-name" value="{{ old('shift-name') }}" required autocomplete="shift-name" autofocus>

                                    @error('shift-name')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/shift/index" class="btn btn-secondary m-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
