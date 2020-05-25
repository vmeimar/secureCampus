@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User {{ $user->name }}</div>

                    <div class="card-body">
                       <form action="{{ route('admin.users.update', $user) }}" method="POST">

                           <div class="form-group row">
                               <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>

                                   @error('name')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                               <div class="col-md-6">
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                   @error('email')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="department" class="col-md-2 col-form-label text-md-right">Department</label>
                               <div class="col-md-6">
                                   <select name="department" id="department" class="form-control input-lg dynamic">
                                       <option selected>
                                           {{ isset($user->department['name']) ? $user->department['name'] : '' }}
                                       </option>
                                       @foreach($faculties as $faculty)
                                           <optgroup label="{{ $faculty->name }}">
                                               @foreach($faculty->departments as $department)
                                                   <option value="{{ $department->id }}">
                                                       {{ $department->name }}
                                                   </option>
                                               @endforeach
                                           </optgroup>
                                       @endforeach
                                   </select>
                                   @error('department')
                                   <strong>{{ $message }}</strong>
                                   @enderror
                               </div>
                           </div>

                           @csrf
                           {{ method_field('PUT') }}
                           <div class="form-group row">
                               <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                               <div class="col-md-6">
                                   @foreach($roles as $role)
                                       <div class="form-check">
                                           <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                           @if($user->roles->pluck('id')->contains($role->id)) checked @endif>

                                           <label>{{ $role->name }}</label>
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                           <button class="btn btn-primary">Update</button>
                       </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
