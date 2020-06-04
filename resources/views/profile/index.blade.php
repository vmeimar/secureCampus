@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://upload.wikimedia.org/wikipedia/el/2/2b/Logo_uoa_blue.png" class="w-100">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h2>Welcome to UoA's Secure Campus Platform</h2>
            </div>

            <div class="pt-2">
                <div>You are logged in as <strong>{{ $user->name }}</strong></div>
                @can('admin')
                <div><strong>Department:</strong>
                    {{ isset($user->department['name']) ? $user->department['name'] : 'Not Defined' }}
                </div>
                <div><strong>Role:</strong> {{ implode(", ", $userRoles) }}</div>
                @endcan
                <div class="pt-3">
                    <p>This application allows you to manage security spots and shifts for your assets.</p>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-8 mb-4 d-flex">

                    @can('manage-security')
                    <div class="card mr-2">
                        <div class="card-header">
                            Guards Manager
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Security Guards and Companies</h5>
                            <p class="card-text">Press button bellow to manage</p>
                            <a href="/security" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                    @endcan

                    @can('view-shifts')
                    <div class="card mr-2">
                        <div class="card-header">
                            Manage Existing Shifts
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Shifts</h5>
                            <p class="card-text">Press button bellow to load current shifts</p>
                            <a href="{{ route('shift.index') }}" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
