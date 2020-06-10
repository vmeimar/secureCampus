@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong>Χρήστες</strong>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Όνομα</th>
                                <th scope="col">Email</th>
{{--                                <th scope="col">Τμήμα</th>--}}
                                <th scope="col">Ρόλος</th>
                                @can('admin')
                                    <th scope="col">Ενέργειες</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
{{--                                    <td>{{ isset( $user->department['name'] ) ? $user->department['name'] : 'Χωρίς τμήμα' }}</td>--}}
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('admin')
                                        <div class="row">
                                            <a href="{{ route('admin.users.edit', $user->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Επεξεργασία</button>
                                            </a>
                                        </div>
                                        @endcan

                                        @can('admin')
                                        <div class="row">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit"
                                                    onclick="return confirm('Επιβεβαίωση διαγραφής')"
                                                    class="btn btn-danger btn-sm">
                                                Διαγραφή</button>
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
                    <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Επιστροφή στο Προφίλ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
