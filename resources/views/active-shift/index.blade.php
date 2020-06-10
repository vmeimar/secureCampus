@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Ενεργές Βάρδιες</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Βάρδια</th>
                                <th scope="col">Φύλακες</th>
                                <th scope="col">Ημερομηνία</th>
                                <th scope="col">Από</th>
                                <th scope="col">Μέχρι</th>
                                <th scope="col">Επιβεβαιωμένη</th>
                                @can('confirm-shifts')
                                    <th scope="col">Ενέργειες</th>
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
                                    <td><strong>{{ $activeShift['confirmed_steward'] ? 'Ναι' : 'Όχι'}}</strong></td>
                                    <td>
                                        @can('confirm-shifts')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-supervisor" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        {{ $activeShift->confirmed_supervisor == 0 ? 'Υποβολή' : 'Κατάργηση υποβολής'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                        @can('confirm-shifts-steward')
                                            <div class="row mb-1">
                                                <form action="/active-shift/{{ $activeShift->id }}/confirm-steward" method="POST" class="float-left">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        {{ $activeShift->confirmed_steward == 0 ? 'Επιβαβαίωση' : 'Αλλαγή κατάστασης'}}
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                        <div class="row">
                                            <a href="{{ route('active-shift.edit', $activeShift->id) }}" class="btn btn-warning btn-sm mb-1">Επεξεργασία</a>
                                        </div>

                                        @can('admin')
                                            <div class="row">
                                                <form action="{{ route('active-shift.destroy', $activeShift) }}" method="POST" class="float-left">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Διαγραφή</button>
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
                        <a href="/shift/index" class="btn btn-secondary m-4">Πίσω</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
