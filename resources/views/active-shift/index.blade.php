@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Εμφάνιση Φιλτραρισμένων Βαρδιών</strong>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center mb-4">
                            <div class="row col-md-8">
                                <h6>
                                    <strong>
                                        Έχετε τη δυνατότητα να εμφανίσετε τις βάρδιες του ανά σημείο φύλαξης, ή να δείτε
                                        το σύνολο όλων παρακάτω.
                                    </strong>
                                </h6>
                            </div>
                        </div>

                        <form method="post" action="{{ route('active-shift.show-by-location') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Επιλέξτε σημείο φύλαξης</label>
                                <div class="col-md-6">
                                    <select name="location" id="location" class="form-control input-lg dynamic">
                                        <option disabled selected value="">Κτήριο</option>
                                        @foreach($user->locations()->get() as $location)
                                            <option value="{{ $location->id }}">
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <strong>Παρακαλώ εισάγετε τοποθεσία</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="max-height: 35px">Εμφάνιση</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <strong>Όλες οι Ενεργές Βάρδιες</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
                                <th scope="col">Ημερομηνία</th>
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col">Επιβεβαιωμένη</th>
                                <th scope="col">Ισοδύναμες Ώρες</th>
                                @can('confirm-shifts')
                                    <th scope="col">Ενέργειες</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activeShifts as $activeShift)
                                <tr>
                                    <th scope="row">{{ $activeShift['id'] }}</th>
                                    <td>{{ $activeShift['name'] }}</td>
                                    <td>
                                        @foreach($activeShift->guards()->get()->toArray() as $guard)
                                            {{ $guard['surname'] }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ date('d/m/yy', strtotime($activeShift['date'])) }}</td>
                                    <td>{{ $activeShift['from'] }}</td>
                                    <td>{{ $activeShift['until'] }}</td>
                                    <td style="text-align: center"><strong>{{ $activeShift['confirmed_steward'] ? 'Ναι' : 'Όχι'}}</strong></td>
                                    <td style="text-align: center">{{ $activeShift['factor'] }}</td>
                                    <td>
                                        @can('confirm-shifts')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-supervisor" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-primary btn-sm ml-2 mr-2">
                                                        {{ $activeShift->confirmed_supervisor == 0 ? 'Υποβολή' : 'Κατάργηση υποβολής'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                        @can('confirm-shifts-steward')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-steward" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-info btn-sm ml-2 mr-2">
                                                        {{ $activeShift->confirmed_steward == 0 ? 'Επιβαβαίωση' : 'Αλλαγή κατάστασης'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                            @can('edit-shifts')
                                            <div class="row mb-1">
                                                <a href="{{ route('active-shift.edit', $activeShift->id) }}" class="btn btn-warning btn-sm ml-2 mr-2">Επεξεργασία</a>
                                            </div>
                                            @endcan

                                        @can('admin')
                                            <div class="row">
                                                <form action="{{ route('active-shift.destroy', $activeShift) }}" method="POST" class="float-left">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm ml-2 mr-2">Διαγραφή</button>
                                                </form>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        {{ $activeShifts->links() }}
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <a href="/shift/index" class="btn btn-secondary m-4">Πίσω</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--AJAX START--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="location" class="col-md-4 col-form-label text-md-right">Σημείο φύλαξης</label>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <select required name="location" id="location" class="form-control input-lg dynamic" data-dependent="active-shifts">--}}
{{--                            <option selected disabled>Επιλέξτε Τοποθεσία</option>--}}
{{--                            @foreach($user->locations()->get() as $location)--}}
{{--                                <option value="{{ $location->id }}">--}}
{{--                                    {{ $location->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br />--}}
{{--                <div class="form-group">--}}
{{--                    <select name="active-shifts" id="active-shifts" class="form-control input-lg dynamic">--}}
{{--                        <option value="">test</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <a href="#" class="btn btn-primary">Submit</a>--}}
{{--                {{ csrf_field() }}--}}
{{--    <script type="application/javascript">--}}
{{--        $(document).ready(function(){--}}

{{--            $('.dynamic').change(function(){--}}
{{--                if($(this).val() != '')--}}
{{--                {--}}
{{--                    var select = $(this).attr("id");--}}
{{--                    var value = $(this).val();--}}
{{--                    var dependent = $(this).data('dependent');--}}
{{--                    var _token = $('input[name="_token"]').val();--}}

{{--                    $.ajax({--}}
{{--                        url:"{{ route('active-shift.fetch') }}",--}}
{{--                        method:"POST",--}}
{{--                        data:{select:select, value:value, _token:_token, dependent:dependent},--}}
{{--                        success:function(result)--}}
{{--                        {--}}
{{--                            $('#'+dependent).html(result);--}}
{{--                        }--}}
{{--                    })--}}
{{--                }--}}
{{--            });--}}

{{--            $('#location').change(function(){--}}
{{--                $('#active-shifts').val('');--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    AJAX END--}}

@endsection
