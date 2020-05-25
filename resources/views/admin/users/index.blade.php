@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Department</th>
                                <th scope="col">Roles</th>
                                @can('edit-users')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ isset( $user->department['name'] ) ? $user->department['name'] : 'N/A' }}</td>
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('edit-users')
                                        <div class="row">
                                            <a href="{{ route('admin.users.edit', $user->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                            </a>
                                        </div>
                                        @endcan

                                        @can('delete-users')
                                        <div class="row">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
                    <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Back to Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
