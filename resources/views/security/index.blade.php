@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Companies</strong></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                @can('manage-security')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <th scope="row">{{ $company->id }}</th>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>

                                        @can('manage-security')
                                            <div class="row d-flex">
                                                <a href="security/{{ $company->id }}/edit">
                                                    <button type="button" class="btn btn-primary btn-sm mb-1">Edit Guards</button>
                                                </a>
                                                <form action="{{ route('company.destroy', $company) }}" method="POST" class="ml-1">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to Delete?')"
                                                            class="btn btn-danger btn-sm">
                                                        Delete</button>
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
                @can('manage-security')
                    <div class="d-flex">
                        <div class="row">
                            <a href="/security/create" class="btn btn-primary m-4">Add New Security Company</a>
                        </div>
                        <div class="row">
                            <a href="/profile/{{ $user_id }}" class="btn btn-secondary m-4">Back to Profile</a>
                        </div>
                    </div>

                @endcan
            </div>
        </div>
    </div>
@endsection
