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
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Confirmed</th>
                                @can('manage-shifts')
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($viewShiftsData as $shift)
                                <tr>
                                    <th scope="row">{{ $shift['id'] }}</th>
                                    <td>{{ $shift['shift_name'] }}</td>
                                    <td>{{ $shift['shift_guards'] }}</td>
                                    <td>{{ date('d M y', strtotime($shift['shift_date'])) }}</td>
                                    <td>{{ $shift['shift_from'] }}</td>
                                    <td>{{ $shift['shift_until'] }}</td>
                                    <td><strong>{{ $shift['shift_confirmed'] }}</strong></td>
                                    <td>
                                        @can('manage-shifts')
                                            <div class="row mb-1">
                                                <form action="{{ route('guarding.update', $shift['id']) }}" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                                                </form>
                                            </div>
                                        @endcan

                                        @can('manage-shifts')
                                            <div class="row">
                                                <form action="{{ route('guarding.destroy', $shift['id']) }}" method="POST" class="float-left">
                                                    @csrf
                                                    @method('delete')
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
                <div class="d-flex">
                    <div class="row">
                        <a href="/shift/index" class="btn btn-secondary m-4">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
