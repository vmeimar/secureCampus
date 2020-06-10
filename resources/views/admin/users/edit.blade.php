@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Επεξεργασία Χρήστη: {{ $user->name }}</strong>
                    </div>

                    <div class="card-body">
                       <form action="{{ route('admin.users.update', $user) }}" method="POST">

                           <div class="form-group row">
                               <label for="name" class="col-md-3 col-form-label text-md-right">Όνομα</label>

                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>

                                   @error('name')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>Εισάγετε όνομα</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                               <div class="col-md-6">
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                   @error('email')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>Εισάγετε email</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="locations" class="col-md-3 col-form-label text-md-right">Ανάθεση Σημείων Φύλαξης</label>
                               <div class="col-md-6">
                                   <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                       <thead>
                                       <tr class="d-flex">
                                           <th class="col-3">Επιλογή</th>
                                           <th class="col-9">Σημείο Φύλαξης (Δυνατότητα πολλαπλής ανάθεσης)</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($locations as $location)
                                       <tr class="d-flex">
                                           <td class="col-3">
                                               <div class="form-check custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" name="locations[]"
                                                          id="{{ $location->id }}" value="{{ $location->id }}"
                                                          @if($user->locations()->pluck('location_id')->contains($location->id)) checked @endif>
                                                   <label class="custom-control-label" for="{{ $location->id }}"></label>
                                               </div>
                                           </td>
                                           <td class="col-9">{{ $location->name }}</td>
                                       </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>

                           @csrf
                           {{ method_field('PUT') }}
                           <div class="form-group row">
                               <label for="roles" class="col-md-3 col-form-label text-md-right">Ρόλοι Χρήστη</label>
                               <div class="col-md-6">
                                   <table class="table table-bordered table-striped">
                                       <thead>
                                       <tr class="d-flex">
                                           <th class="col-3">Επιλογή</th>
                                           <th class="col-9">Ρόλος (Δυνατότητα πολλαπλής ανάθεσης)</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($roles as $role)
                                       <tr class="d-flex">
                                           <td class="col-3">
                                               <div class="form-check custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" name="roles[]" id="{{ $role->id }}" value="{{ $role->id }}"
                                                          @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                   <label class="custom-control-label" for="{{ $role->id }}"></label>
                                               </div>
                                           </td>
                                           <td class="col-9">{{ $role->name }}</td>
                                       </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>

                           {{--                           <div class="form-group row">--}}
                           {{--                               <label for="department" class="col-md-2 col-form-label text-md-right">Τμήμα</label>--}}
                           {{--                               <div class="col-md-6">--}}
                           {{--                                   <select name="department" id="department" class="form-control input-lg dynamic">--}}
                           {{--                                       <option--}}
                           {{--                                           value="{{ isset($user->department['id']) ? $user->department['id'] : '' }}"--}}
                           {{--                                           selected>--}}
                           {{--                                           {{ isset($user->department['name']) ? $user->department['name'] : '' }}--}}
                           {{--                                       </option>--}}
                           {{--                                       @foreach($faculties as $faculty)--}}
                           {{--                                           <optgroup label="{{ $faculty->name }}">--}}
                           {{--                                               @foreach($faculty->departments as $department)--}}
                           {{--                                                   <option value="{{ $department->id }}">--}}
                           {{--                                                       {{ $department->name }}--}}
                           {{--                                                   </option>--}}
                           {{--                                               @endforeach--}}
                           {{--                                           </optgroup>--}}
                           {{--                                       @endforeach--}}
                           {{--                                   </select>--}}
                           {{--                                   @error('department')--}}
                           {{--                                   <strong>Εισάγετε τμήμα</strong>--}}
                           {{--                                   @enderror--}}
                           {{--                               </div>--}}
                           {{--                           </div>--}}



{{--                           @csrf--}}
{{--                           {{ method_field('PUT') }}--}}
{{--                           <div class="form-group row">--}}
{{--                               <label for="roles" class="col-md-3 col-form-label text-md-right">Ρόλος</label>--}}
{{--                               <div class="col-md-6">--}}
{{--                                   @foreach($roles as $role)--}}
{{--                                       <div class="form-check">--}}
{{--                                           <input type="checkbox" name="roles[]" value="{{ $role->id }}"--}}
{{--                                           @if($user->roles->pluck('id')->contains($role->id)) checked @endif>--}}

{{--                                           <label>{{ $role->name }}</label>--}}
{{--                                       </div>--}}
{{--                                   @endforeach--}}
{{--                               </div>--}}
{{--                           </div>--}}
                           <button class="btn btn-primary">Αποθήκευση</button>
                       </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>
@endsection
