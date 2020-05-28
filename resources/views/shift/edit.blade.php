@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Edit Shift</strong></div>

                    <div class="card-body">
                        <form method="post" action="/shift/{{ $shift->id }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option selected>{{ $shift->location->name }}</option>
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
                                        <option value="{{ $shift->number_of_guards }}" selected>
                                            {{ $shift->number_of_guards }}
                                        </option>
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

{{--                            <div class="form-group row">--}}
{{--                                <label for="days" class="col-md-4 col-form-label text-md-right">Days</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select name="days" id="days" class="form-control input-lg dynamic">--}}
{{--                                        <option value="{{ $shift->days }}" selected>--}}
{{--                                            {{ $shift->days }}--}}
{{--                                        </option>--}}
{{--                                        <option value="weekdays">Weekdays</option>--}}
{{--                                        <option value="saturday">Saturday</option>--}}
{{--                                        <option value="sunday">Sunday</option>--}}
{{--                                    </select>--}}
{{--                                    @error('days')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">Time</label>
                                <div class="col-md-6 d-flex">
                                    <div class="col-md-6">
                                        <select class="form-control input-lg dynamic">
                                            <option selected>{{ $shift->shift_from }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control input-lg dynamic">
                                            <option selected>{{ $shift->shift_until }}</option>
                                        </select>
                                    </div>
                                    @error('time')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shift-name" class="col-md-4 col-form-label text-md-right">Shift's Alias</label>

                                <div class="col-md-6">
                                    <input id="shift-name"
                                           value="{{ old('shift-name') ?? $shift->name }}"
                                        type="text"
                                        class="form-control @error('shift-name') is-invalid @enderror"
                                        name="shift-name" value="{{ old('shift-name') }}"
                                        required autocomplete="shift-name"
                                        autofocus>

                                    @error('shift-name')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
