@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ ucfirst($company->name) }} Guards</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Dept ID</th>
                                @can('manage-security')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guards as $guard)
                                <tr>
                                    <th scope="row">{{ $guard->id }}</th>
                                    <td>{{ $guard->name }}</td>
                                    <td>{{ $guard->surname }}</td>
                                    <td>{{ $guard->department_id }}</td>
                                    <td>
                                        @can('manage-security')
                                            <div class="row">
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger">Delete</button>
                                                </a>
                                            </div>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @can('manage-security')
                <a href="#" class="btn btn-primary m-4">Add Guards</a>
                @endcan
            </div>
        </div>
    </div>
@endsection
