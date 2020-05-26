@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Active Shifts</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Alias</th>
                                <th scope="col">Guards</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                @can('manage-shifts')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->id }}</th>
                                    <td>{{ $shift->name }}</td>
                                    <td>{{ implode(', ', $shift->guards()->get()->pluck('surname')->toArray()) }}</td>
                                    <td>{{ $shift->shift_from }}</td>
                                    <td>{{ $shift->shift_until }}</td>
                                    <td>
                                        @can('manage-shifts')
                                            <div class="row">
                                                <a href="#">
                                                    <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('manage-shifts')
                                            <div class="row">
                                                <form action="#" method="POST" class="float-left">
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
                    <a href="/shift/index" class="btn btn-secondary m-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
