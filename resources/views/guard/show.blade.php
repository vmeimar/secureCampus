@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ $guard->name }} {{ $guard->surname }}</strong></div>

                    <div class="card-body">
                        <div>Company: {{ $guard->company->name }}</div>
                        <div></div>
                    </div>
                </div>
                @can('manage-security')
                        <div class="row">
                            <a href="{{ URL::previous() }}" class="btn btn-secondary m-4">Back</a>
                        </div>

                @endcan
            </div>
        </div>
    </div>
@endsection
