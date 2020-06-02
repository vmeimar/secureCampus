@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $guard->name }} {{ $guard->surname }}</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/guard/{{$guard->id}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="month" class="col-md-4 col-form-label text-md-right">Month</label>
                                <div class="col-md-4">
                                    <select name="month" id="month" class="form-control input-lg dynamic">
                                        <option disabled selected value="">Select Month</option>
                                        <option value="all">All</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    @error('month')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                <label for="number-of-guards" class="col-md-4 col-form-label text-md-right">Number of Guards</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select name="number-of-guards" id="number-of-guards" class="form-control input-lg dynamic">--}}
{{--                                        <option value="{{ $shift->number_of_guards }}" selected>--}}
{{--                                            {{ $shift->number_of_guards }}--}}
{{--                                        </option>--}}
{{--                                        <option value="1">1</option>--}}
{{--                                        <option value="2">2</option>--}}
{{--                                        <option value="3">3</option>--}}
{{--                                        <option value="4">4</option>--}}
{{--                                    </select>--}}
{{--                                    @error('number-of-guards')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="time" class="col-md-4 col-form-label text-md-right">Time</label>--}}
{{--                                <div class="col-md-6 d-flex">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="shift-from"--}}
{{--                                               type="time"--}}
{{--                                               class="form-control"--}}
{{--                                               name="shift-from"--}}
{{--                                               value="{{ $shift->shift_from }}"--}}
{{--                                               autocomplete="shift-from"--}}
{{--                                               autofocus>--}}
{{--                                        @error('shift-from')--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="shift-until"--}}
{{--                                               type="time"--}}
{{--                                               class="form-control"--}}
{{--                                               name="shift-until"--}}
{{--                                               value="{{ $shift->shift_until }}"--}}
{{--                                               autocomplete="shift-until"--}}
{{--                                               autofocus>--}}
{{--                                        @error('shift-until')--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="shift-name" class="col-md-4 col-form-label text-md-right">Shift's Alias</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="shift-name"--}}
{{--                                           value="{{ old('shift-name') ?? $shift->name }}"--}}
{{--                                           type="text"--}}
{{--                                           class="form-control @error('shift-name') is-invalid @enderror"--}}
{{--                                           name="shift-name" value="{{ old('shift-name') }}"--}}
{{--                                           required autocomplete="shift-name"--}}
{{--                                           autofocus>--}}

{{--                                    @error('shift-name')--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">Export to Excel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <a href="/security/{{ $guard->company->id }}/edit" class="btn btn-secondary m-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
