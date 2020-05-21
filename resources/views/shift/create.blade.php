@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Shift</div>

                    <div class="card-body">
                        <form method="post" action="/sh" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">

                                <label for="guard" class="col-md-4 col-form-label text-md-right">Guard's Name</label>
                                <div class="col-md-6">
                                    <select name="guard" id="guard" class="form-control input-lg dynamic">
                                        <option selected disabled>Select Guard</option>
                                        @foreach($guards as $guard)
                                            <option value="{{ $guard->id }}">
                                                {{ $guard->surname }} {{ $guard->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('guard')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option selected disabled>Select Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                <label for="shift_date" class="col-md-4 col-form-label text-md-right">Shift's Date</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="date" name="shift_date" id="shift_date" class="form-control input-lg dynamic">--}}
{{--                                    @error('shift_date')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="shift_from" class="col-md-4 col-form-label text-md-right">Shift From</label>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <select name="shift_from_hour" id="shift_from_hour" class="form-control input-lg dynamic">--}}
{{--                                        <option value="" selected disabled>Hours</option>--}}
{{--                                        @foreach($hours as $hour)--}}
{{--                                            <option value="{{ $hour }}">{{ $hour }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('shift_from_hour')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <select name="shift_from_minute" id="shift_from_minute" class="form-control input-lg dynamic">--}}
{{--                                        <option selected disabled>Minutes</option>--}}
{{--                                        @foreach($minutes as $minute)--}}
{{--                                            <option value="{{ $minute }}">{{ $minute }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('shift_from_minute')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="shift_date" class="col-md-4 col-form-label text-md-right">Shift Until</label>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <select name="shift_until_hour" id="shift_until_hour" class="form-control input-lg dynamic">--}}
{{--                                        <option selected disabled>Hours</option>--}}
{{--                                        @foreach($hours as $hour)--}}
{{--                                            <option value="{{ $hour }}">{{ $hour }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('shift_until_hour')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <select name="shift_until_minute" id="shift_until_minute" class="form-control input-lg dynamic">--}}
{{--                                        <option selected disabled>Minutes</option>--}}
{{--                                        @foreach($minutes as $minute)--}}
{{--                                            <option value="{{ $minute }}">{{ $minute }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('shift_until_minute')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

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
            </div>
        </div>
    </div>
@endsection
