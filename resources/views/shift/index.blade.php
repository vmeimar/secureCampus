@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong>Shifts</strong>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Alias</th>
                                <th scope="col">Number of Guards</th>
                                <th scope="col">From</th>
                                <th scope="col">Until</th>
                                @can('edit-shifts')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->name }}</th>
                                    <td>{{ $shift->number_of_guards }}</td>
                                    <td>{{ $shift->shift_from }}</td>
                                    <td>{{ $shift->shift_until }}</td>
                                    <td>
                                    @can('manage-shifts')
                                        
                                        <div class="row">
                                            <a href="{{ route('active-shift.create', $shift) }}">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Assign Guards</button>
                                            </a>
                                        </div>

                                        <div class="row">

                                            @can('edit-shifts')
                                            <a href="{{ route('shift.edit', $shift->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm mb-1 mr-1">Edit</button>
                                            </a>
                                            @endcan

                                            @can('admin')
                                            <form action="{{ route('shift.destroy', $shift) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to Delete?')"
                                                        class="btn btn-danger btn-sm">
                                                    Delete</button>
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
                <div class="d-flex">
                    @can('create-shifts')
                    <div class="row">
                        <a href="/shift/create" class="btn btn-primary m-4">Create New Shift</a>
                    </div>
                    @endcan
                    <div class="row">
                        <a href="{{ route('active-shift.index') }}" class="btn btn-warning m-4">Show active shifts</a>
                    </div>
                    <div class="row">
                        <a href="/profile/{{ Auth::user()->id }}" class="btn btn-secondary m-4">Back to Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
