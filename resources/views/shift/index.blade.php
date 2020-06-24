@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong>Σημεία Φύλαξης / Βάρδιες</strong>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Αναγνωριστικό</th>
                                <th scope="col">Κτήριο</th>
                                <th scope="col">Αρ. Φυλάκων</th>
                                <th scope="col">Έναρξη</th>
                                <th scope="col">Λήξη</th>
                                <th scope="col">Ενέργεις</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->name }}</th>
                                    <td>{{ $shift->location->name }}</td>
                                    <td style="text-align: center">{{ $shift->number_of_guards }}</td>
                                    <td>{{ $shift->shift_from }}</td>
                                    <td>{{ $shift->shift_until }}</td>
                                    <td>
                                    @can('manage-shifts')

                                        @can('assign-shifts')
                                        <div class="row">
                                            <a href="{{ route('active-shift.create', $shift) }}">
                                                <button type="button" class="btn btn-primary btn-sm mb-1 ml-2 mr-2">Ανάθεση σε Φύλακα</button>
                                            </a>
                                        </div>
                                        @endcan

                                        <div class="row">

                                            @can('edit-shifts')
                                            <a href="{{ route('shift.edit', $shift->id) }}">
                                                <button type="button" class="btn btn-info btn-sm mb-1 mr-1 ml-2">Επεξεργασία</button>
                                            </a>
                                            @endcan

                                            @can('admin')
                                            <form action="{{ route('shift.destroy', $shift) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit"
                                                        onclick="return confirm('Επιβεβαίωση Διαγραφής')"
                                                        class="btn btn-danger btn-sm mb-1 mr-1 ml-2">
                                                    Διαγραφή</button>
                                            </form>
                                            @endcan

                                        </div>
                                    @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-2">
                    {{ $shifts->links() }}
                </div>
                <div class="d-flex">
                    @can('create-shifts')
                    <div class="row">
                        <a href="/shift/create" class="btn btn-primary m-4">Δημιουργία Νέας Βάρδιας σε Σημείο Φύλαξης</a>
                    </div>
                    @endcan
                    <div class="row">
                        <a href="{{ route('active-shift.index') }}" class="btn btn-warning m-4">Προβολή Ανατεθειμένων Βαρδιών</a>
                    </div>
                    <div class="row">
                        <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Επιστροφή στο Προφίλ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
