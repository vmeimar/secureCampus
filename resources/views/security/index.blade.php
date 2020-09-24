@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Εταιρίες Φύλαξης</strong></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Όνομα</th>
{{--                                <th scope="col">Email</th>--}}
{{--                                <th scope="col">Τηλέφωνο</th>--}}
                                @can('manage-security')
                                    <th scope="col">Ενέργειες</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <th scope="row">{{ $company->id }}</th>
                                    <td>{{ $company->name }}</td>
{{--                                    <td>{{ $company->email }}</td>--}}
{{--                                    <td>{{ $company->phone }}</td>--}}
                                    <td>

                                        @can('manage-security')
                                            <div class="row d-flex">
                                                <a href="/guard/{{ $company->id }}/index">
                                                    <button type="button" class="btn btn-primary btn-sm mb-1">Επεξεργασία Φυλάκων</button>
                                                </a>
                                                <a href="/security/{{ $company->id }}/edit" class="ml-1">
                                                    <button type="button" class="btn btn-info btn-sm mb-1">Επεξεργασία Εταιρείας</button>
                                                </a>
                                                @can('admin')
                                                <form action="{{ route('company.destroy', $company) }}" method="POST" class="ml-1">
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
                            <a href="/security/create" class="btn btn-primary m-4">Δημιουργία Νέας Εταιρείας</a>
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
