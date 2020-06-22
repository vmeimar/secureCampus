@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $activeShift->name }}</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('active-shift.update', $activeShift->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            @for( $i=1; $i<=$activeShift->guards()->get()->count(); $i++ )
                                <div class="form-group row">
                                    <label for="guard{{$i}}" class="col-md-4 col-form-label text-md-right">Φύλακας {{$i}}</label>
                                    <div class="col-md-6">
                                        <select required name="guard{{$i}}" id="guard{{$i}}" class="form-control input-lg dynamic">
                                            <option selected value="{{ $activeShift->guards()->get()->toArray()[$i-1]['id'] }}">
                                                {{ $activeShift->guards()->get()->toArray()[$i-1]['surname'] }} {{ $activeShift->guards()->get()->toArray()[$i-1]['name'] }}
                                            </option>
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
                                <label for="active-shift-date" class="col-md-4 col-form-label text-md-right">Ημερομηνία Βάρδιας</label>
                                <div class="col-md-6">
                                    <select required name="active-shift-date" id="active-shift-date" class="form-control input-lg dynamic">
                                        <option value="{{ $activeShift->date }}|{{ $activeShift->is_holiday }}" selected>{{ date('l', strtotime($activeShift->date)) }} {{ date('d-M-Y', strtotime($activeShift->date)) }}</option>
                                        @foreach($availableDates as $date)
                                            <option value="{{ $date->date }}|{{ $date->is_holiday }}">
                                                {{ $date->day }} {{ date('d-M-Y', strtotime($date->date)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="active-shift-comments" class="col-md-4 col-form-label text-md-right">Σχόλια</label>
                                <textarea name="active-shift-comments"
                                          rows="5"
                                          id="active-shift-comments"
                                          class="col-md-6 form-control input-lg dynamic">{{ $activeShift->comments }}</textarea>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('shift.index') }}" class="btn btn-secondary m-4">Πίσω</a>
                </div>
            </div>
        </div>
    </div>
@endsection
