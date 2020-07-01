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
                                    <label for="guard{{$i}}" class="col-md-4 col-form-label text-md-right">Φύλακας {{$i}}</label>
                                    <div class="col-md-6">
                                        <select required name="guard{{$i}}" id="guard{{$i}}" class="form-control input-lg">
                                            <option selected value="">Επιλέξτε Φύλακα</option>
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
                                <label for="month" class="col-md-4 col-form-label text-md-right">Ημερομηνία Βάρδιας (Μήνας)</label>
                                <div class="col-md-6">
                                    <select name="month" id="month" class="form-control input-lg dynamic" data-dependent="active-shift-date">
                                        <option disabled selected value="">Επιλέξτε Μήνα</option>
                                        <option value="01">Ιανουάριος</option>
                                        <option value="02">Φεβρουάριος</option>
                                        <option value="03">Μάρτιος</option>
                                        <option value="04">Απρίλιος</option>
                                        <option value="05">Μάιος</option>
                                        <option value="06">Ιούνιος</option>
                                        <option value="07">Ιούλιος</option>
                                        <option value="08">Αύγουστος</option>
                                        <option value="09">Σεπτέμβριος</option>
                                        <option value="10">Οκτώβριος</option>
                                        <option value="11">Νοέμβριος</option>
                                        <option value="12">Δεκέμβριος</option>
                                    </select>
                                    @error('month')
                                    <strong>Παρακαλώ επιλέξτε μήνα</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="active-shift-date" class="col-md-4 col-form-label text-md-right">Ημερομηνία Βάρδιας (Ημέρα)</label>
                                <div class="col-md-6">
                                    <select required name="active-shift-date" id="active-shift-date" class="form-control input-lg dynamic">
                                        <option selected value="">Επιλέξτε Πρώτα Μήνα</option>
{{--                                        @foreach($availableDates as $date)--}}
{{--                                            <option value="{{ $date->date }}|{{ $date->is_holiday }}">--}}
{{--                                                {{ $date->day }} {{ date('d-m-Y', strtotime($date->date)) }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>

                        {{--AJAX START--}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="location" class="col-md-4 col-form-label text-md-right">Σημείο φύλαξης</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select required name="location" id="location" class="form-control input-lg dynamic" data-dependent="active-shifts">--}}
{{--                                        <option selected disabled>Επιλέξτε Τοποθεσία</option>--}}
{{--                                        @foreach($user->locations()->get() as $location)--}}
{{--                                            <option value="{{ $location->id }}">--}}
{{--                                                {{ $location->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <br />--}}
{{--                            <div class="form-group">--}}
{{--                                <select name="active-shifts" id="active-shifts" class="form-control input-lg dynamic">--}}
{{--                                    <option value="">test</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn-primary">Submit</a>--}}
{{--                            {{ csrf_field() }}--}}
{{--                            AJAX END--}}


                            <!-- Get shift's id on hidden element -->
                            <input type="hidden" id="shift-id" name="shift-id" value="{{ $shift->id }}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Ανάθεση</button>
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

    <script type="application/javascript">
        $(document).ready(function(){

            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var shiftId = $('#shift-id').val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('active-shift.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, shiftId:shiftId, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+dependent).html(result);
                        }
                    })
                }
            });

            $('#month').change(function(){
                $('#active-shift-date').val('');
            });
        });
    </script>
@endsection
