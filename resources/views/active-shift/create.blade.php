@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $shift->name }}</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/as" enctype="multipart/form-data">
                            @csrf
                            @for( $i=1; $i<=$shift->number_of_guards; $i++ )
                                <div class="form-group row">
                                    <label for="guard{{$i}}" class="col-md-4 col-form-label text-md-right">Guard {{$i}}</label>
                                    <div class="col-md-6">
                                        <select required name="guard{{$i}}" id="guard{{$i}}" class="form-control input-lg dynamic">
                                            <option selected disabled>Select Guard</option>
                                            @foreach($guards as $guard)
                                                <option value="{{ $guard->id }}">
                                                    {{ $guard->surname }} {{ $guard->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endfor
                            <div class="form-group row">
                                <label for="active-shift-date" class="col-md-4 col-form-label text-md-right">Shift's Date</label>
                                <div class="col-md-6">
                                    <input id="active-shift-date"
                                           type="date"
                                           class="form-control"
                                           name="active-shift-date"
                                           value="{{ old('active-shift-date') }}"
                                           autocomplete="active-shift-date"
                                           autofocus>
                                    @error('active-shift-date')
                                    <strong>Shift's Date is required</strong>
                                    @enderror
                                </div>
                            </div>
                            <!-- Get shift's id on hidden element -->
                            <input type="hidden" id="shift-id" name="shift-id" value="{{ $shift->id }}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('shift.index') }}" class="btn btn-secondary m-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection