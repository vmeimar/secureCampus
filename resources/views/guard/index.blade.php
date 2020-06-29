@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ ucfirst($company->name) }} | Φύλακες</strong></div>

                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Όνομα</th>
                                <th scope="col">Επώνυμο</th>
                                @can('manage-security')
                                    <th scope="col">Ενέργειες</th>
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
                                                <div class="row mr-1">
                                                    <a href="{{route('guard.show', $guard->id)}}" class="btn btn-info btn-sm">Λεπτομέριες</a>
                                                </div>

                                                <div class="row mr-3 ml-1">
                                                    <a href="{{route('guard.edit', $guard->id)}}" class="btn btn-primary btn-sm">Επεξεργασία</a>
                                                </div>

                                                @can('admin')
                                                <div class="row">
                                                    <form action="{{ route('guard.destroy', $guard) }}" method="POST" class="ml-1">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit"
                                                                onclick="return confirm('Επιβεβαίωση διαγραφής')"
                                                                class="btn btn-danger btn-sm">
                                                            Διαγραφή</button>
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
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        {{ $guards->links() }}
                    </div>
                </div>
                @can('manage-security')
                    <div class="d-flex">
                        <div class="row">
                            <a href="/guard/{{ $company->id }}/create" class="btn btn-primary m-4">Δημιουργία Φύλακα</a>
                        </div>
                        <div class="row">
                            <a href="/security/index" class="btn btn-secondary m-4">Πίσω</a>
                        </div>
                        <form action="{{ route('guard.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="file" name="import_file" class="mt-4 ml-4"/>
                                <br />
                                <input type="submit" value="Μαζική Εισαγωγή Excel" class="btn btn-success mt-4 ml-2"/>
                            </div>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
