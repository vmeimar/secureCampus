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
                               <label for="name" class="col-md-3 col-form-label text-md-right"><strong>Όνομα</strong></label>
                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>

                                   @error('name')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>Εισάγετε Όνομα</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="surname" class="col-md-3 col-form-label text-md-right"><strong>Επώνυμο</strong></label>
                               <div class="col-md-6">
                                   <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}">

                                   @error('surname')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>Εισάγετε Επώνυμο</strong>
                                    </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="tier" class="col-md-3 col-form-label text-md-right"><strong>Βαθμίδα</strong></label>
                               <div class="col-md-6">
                                   <select name="tier" id="tier" class="form-control input-lg dynamic">
                                       <option selected value="{{ $user->tier }}">{{ $user->tier }}</option>
                                       <option value="Καθηγητής">Καθηγητής</option>
                                       <option value="Καθηγήτρια">Καθηγήτρια</option>
                                       <option value="Αναπλ. Καθηγητής">Αναπλ. Καθηγητής</option>
                                       <option value="Αναπλ. Καθηγήτρια">Αναπλ. Καθηγήτρια</option>
                                       <option value="Λέκτορας">Λέκτορας</option>
                                       <option value="Ε.ΔΙ.Π.">Ε.ΔΙ.Π.</option>
                                       <option value="Ε.Ε.Π.">Ε.Ε.Π.</option>
                                       <option value="Ε.ΤΕ.Π.">Ε.ΤΕ.Π.</option>
                                       <option value="Διοικητικός Υπάλληλος">Διοικητικός Υπάλληλος</option>
                                   </select>
                                   @error('tier')
                                   <strong>Παρακαλώ επιλέξτε βαθμίδα</strong>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="email" class="col-md-3 col-form-label text-md-right"><strong>Email</strong></label>

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
                               <label for="locations" class="col-md-3 col-form-label text-md-right"><strong>Ανάθεση Σημείων Φύλαξης</strong></label>
                               <div class="col-md-6">
                                   <div class="table-wrapper-scroll-y my-custom-scrollbar" style="position: relative; height: 395px; overflow: auto; display: block">
                                       <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                           <tr class="d-flex">
                                               <th class="col-3">Επιλογή</th>
                                               <th class="col-9">Κτήριο (Δυνατότητα πολλαπλής ανάθεσης)</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($locations as $location)
                                           <tr class="d-flex">
                                               <td class="col-3">
                                                   <div class="form-check custom-control custom-checkbox locations-checkbox">
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
                           </div>

                           @csrf
                           {{ method_field('PUT') }}
                           <div class="form-group row">
                               <label for="roles" class="col-md-3 col-form-label text-md-right"><strong>Ανάθεση Ρόλου Χρήστη</strong></label>
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
                                               <div class="form-check custom-control custom-checkbox roles-checkbox">
                                                   <input type="checkbox" class="custom-control-input" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}"
                                                          @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                   <label class="custom-control-label" for="role{{ $role->id }}"></label>
                                               </div>
                                           </td>
                                           <td class="col-9">{{ $role->name }}</td>
                                       </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                           <div class="d-flex">
                               <div class="row">
                                   <button class="btn btn-primary">Αποθήκευση</button>
                               </div>
                               <div class="row ml-4">
                                   <a href="/admin/users" class="btn btn-secondary">Πίσω</a>
                               </div>
                           </div>

                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
