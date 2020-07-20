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


                            {{--AJAX START--}}
                            <div class="form-group row">
                                <label for="month" class="col-md-4 col-form-label text-md-right">Ημερομηνία Βάρδιας (Μήνας)</label>
                                <div class="col-md-6">
                                    <select name="month" id="month" class="form-control input-lg dynamic" data-dependent="active-shift-date">
                                        <option selected value="{{ date('m', strtotime($activeShift->date)) }}">{{ date('d-m-Y', strtotime($activeShift->date)) }}</option>
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
                                        <option selected value="{{ date('Y-m-d', strtotime($activeShift->date)) }}|{{$activeShift->is_holiday}}">Επιλέξτε Πρώτα Μήνα</option>
                                    </select>
                                </div>
                            </div>
                            {{--AJAX-END--}}
                            <!-- Get shift's id on hidden element -->
                            <input type="hidden" id="shift-id" name="shift-id" value="{{ $activeShift->shift_id }}">

{{--                            <div class="form-group row">--}}
{{--                                <label for="active-shift-date" class="col-md-4 col-form-label text-md-right">Ημερομηνία Βάρδιας</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select required name="active-shift-date" id="active-shift-date" class="form-control input-lg dynamic">--}}
{{--                                        <option value="{{ $activeShift->date }}|{{ $activeShift->is_holiday }}" selected>{{ date('l', strtotime($activeShift->date)) }} {{ date('d-M-Y', strtotime($activeShift->date)) }}</option>--}}
{{--                                        @foreach($availableDates as $date)--}}
{{--                                            <option value="{{ $date->date }}|{{ $date->is_holiday }}">--}}
{{--                                                {{ $date->day }} {{ date('d-M-Y', strtotime($date->date)) }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="form-group row">
                                <label for="active-shift-comments" class="col-md-4 col-form-label text-md-right">Σχόλια</label>
                                <textarea name="active-shift-comments"
                                          rows="5"
                                          id="active-shift-comments"
                                          class="col-md-6 form-control input-lg dynamic">{{ $activeShift->comments }}</textarea>
                            </div>

                            <div class="form-group row">
                                <label for="absent" class="col-md-4 col-form-label text-md-right">Μερική ή ολική απουσία φύλακα</label>
                                <div class="col-md-6 d-flex">
                                    <div class="col-md-3">
                                        <input id="checkbox"
                                               type="checkbox"
                                               class="form-control"
                                               style="max-height: 20px; margin-top: 10px"
                                               name="checkbox"
                                               value="{{ old('checkbox') }}"
                                               autocomplete="checkbox"
                                               autofocus>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="hours"
                                               type="text"
                                               class="form-control"
                                               name="hours"
                                               placeholder="Ώρες Απουσίας"
                                               value="{{ old('hours') }}"
                                               autocomplete="hours"
                                               autofocus>
                                    </div>
                                </div>
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
                    <a href="{{ route('active-shift.index') }}" class="btn btn-secondary m-4">Πίσω</a>
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

        $(function () {
            $('input[name="hours"]').hide();

            //show it when the checkbox is clicked
            $('input[name="checkbox"]').on('click', function () {
                if ($(this).prop('checked')) {
                    $('input[name="hours"]').fadeIn();
                } else {
                    $('input[name="hours"]').hide();
                }
            });
        });
    </script>
@endsection
