@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Shift</div>

                    <div class="card-body">
                        <form method="post" action="/s" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">

                                <label for="guard_name" class="col-md-4 col-form-label text-md-right">Guard's Name</label>
                                <div class="col-md-6">
                                    <select name="guard_name" id="guard_name" class="form-control input-lg dynamic">
                                        <option selected disabled>Select Guard</option>
                                        @foreach($guards as $guard)
                                            <option value="{{ $guard->id }}">
                                                {{ $guard->surname }} {{ $guard->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('guard_name')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option selected disabled>Select Location</option>
                                        @foreach($guards as $guard)
                                            <option value="{{ $guard->id }}">
                                                {{ $guard->surname }} {{ $guard->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location')
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
            </div>
        </div>
    </div>
@endsection
