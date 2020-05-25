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
                <div><strong>Department:</strong>
                    {{ isset($user->department['name']) ? $user->department['name'] : 'N/A' }}
                </div>
                <div><strong>Role:</strong> {{ implode(", ", $userRoles) }}</div>
                <div class="pt-3">
                    <p>This application allows you to manage security spots and shifts for your assets.</p>
                </div>
                <hr>
            </div>

            @can('use-application')
            <div class="row">
                <div class="col-8 mb-4 d-flex">

{{--                    @if($user->hasAnyRoles(['admin', 'supervisor']))--}}
{{--                    <div class="card mr-2">--}}
{{--                        <div class="card-header">--}}
{{--                            Shift Manager--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Add a new Shift</h5>--}}
{{--                            <p class="card-text">Press button bellow to add a new security shift</p>--}}
{{--                            <a href="/shift/create" class="btn btn-primary">Add</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}

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

                </div>

                <div class="col-8 mb-4 d-flex">

                    <div class="card mr-2">
                        <div class="card-header">
                            Location Manager
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Add a new Location</h5>
                            <p class="card-text">Press button bellow to add a new security location</p>
                            <a href="#" class="btn btn-primary">Add</a>
                        </div>
                    </div>

                    <div class="card mr-2">
                        <div class="card-header">
                            Manage Existing Shifts
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Shifts</h5>
                            <p class="card-text">Press button bellow to load current shifts</p>
                            <a href="/shift/index" class="btn btn-primary">Manage</a>
                        </div>
                    </div>

                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endsection
