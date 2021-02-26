@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Δημιουργημένες Συμβάσεις</strong></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Πράξη Πρύτανη</th>
                                <th scope="col">ΑΔΑ</th>
                                <th scope="col">ΑΔΑΜ</th>
                                <th scope="col">Ημερομηνία</th>
                                @can('manage-security')
                                    <th scope="col">Ενέργειες</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts as $contract)
                                <tr>
                                    <th scope="row">{{ $contract->id }}</th>
                                    <td>{{ $contract->dean_act }}</td>
                                    <td>{{ $contract->ada }}</td>
                                    <td>{{ $contract->adam }}</td>
                                    <td>{{ date('d-m-Y', strtotime($contract->contract_start_date)) }}</td>
                                    <td>

                                        @can('manage-security')
                                            <div class="row d-flex">
                                                <a href="{{ route('contract.edit', $contract->id) }}">
                                                    <button type="button" class="btn btn-primary btn-sm mb-1">Επεξεργασία</button>
                                                </a>
{{--                                                <a href="#" class="ml-1">--}}
{{--                                                    <button type="button" class="btn btn-info btn-sm mb-1">Επεξεργασία Εταιρείας</button>--}}
{{--                                                </a>--}}
                                                @can('admin')
                                                    <form action="{{ route('contract.destroy', $contract->id) }}" method="POST" class="ml-1">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit"
                                                                onclick="return confirm('Επιβεβαίωση Διαγραφής')"
                                                                class="btn btn-danger btn-sm">
                                                            Διαγραφή</button>
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
                @can('doy')
                    <div class="d-flex">
                        <div class="row">
                            <a href="{{ route('contract.create') }}" class="btn btn-primary m-4">Δημιουργία Νέας Σύμβασης</a>
                        </div>
                        @endcan
                        <div class="row">
                            <a href="/profile/{{ $user_id }}" class="btn btn-secondary m-4">Επιστροφή στο Προφίλ</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
