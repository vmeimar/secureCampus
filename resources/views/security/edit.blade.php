@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ ucfirst($company->name) }} Guards</strong></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
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
                                    <td>
                                        @can('manage-security')
                                            <div class="d-flex">
                                                <div class="row mr-3">
                                                    <a href="{{route('guard.show', $guard->id)}}" class="btn btn-primary btn-sm">Details</a>
                                                </div>

                                                @can('admin')
                                                <div class="row">
                                                    <form action="{{ route('guard.destroy', $guard) }}" method="POST" class="ml-1">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit"
                                                                onclick="return confirm('Are you sure you want to Delete?')"
                                                                class="btn btn-danger btn-sm">
                                                            Delete</button>
                                                    </form>
                                                </div>
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
                @can('manage-security')
                    <div class="d-flex">
                        <div class="row">
                            <a href="/guard/{{ $company->id }}/create" class="btn btn-primary m-4">Add Guards</a>
                        </div>
                        <div class="row">
                            <a href="/security" class="btn btn-secondary m-4">Back</a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
