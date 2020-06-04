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
                            @foreach($activeShifts as $activeShift)
                                <tr>
                                    <th scope="row">{{ $activeShift['id'] }}</th>
                                    <td>{{ $activeShift['name'] }}</td>
                                    <td>
                                        @foreach($activeShift->guards()->get()->toArray() as $guard)
                                            {{ $guard['surname'] }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ date('d M y', strtotime($activeShift['date'])) }}</td>
                                    <td>{{ $activeShift['from'] }}</td>
                                    <td>{{ $activeShift['until'] }}</td>
                                    <td><strong>{{ $activeShift['confirmed'] }}</strong></td>
                                    <td>
                                        @can('confirm-shifts')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        {{ $activeShift->confirmed == 0 ? 'Confirm' : 'Unconfirm'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                        @can('manage-shifts')
                                            <div class="row">
                                                <form action="{{ route('active-shift.destroy', $activeShift) }}" method="POST" class="float-left">
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
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        {{ $activeShifts->links() }}
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
