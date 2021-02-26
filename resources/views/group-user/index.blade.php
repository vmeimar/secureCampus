@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('messages.langGroup') }} {{ $group->name }}</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
{{--                                <th scope="col">#</th>--}}
                                <th scope="col">{{ __('messages.langLastName') }}</th>
                                <th scope="col">{{ __('messages.langName') }}</th>
{{--                                <th scope="col">{{ __('messages.langDeanAct') }}</th>--}}
{{--                                <th scope="col">{{ __('messages.langCreationDate') }}</th>--}}
                                @can('manage-security')
                                    <th scope="col">{{ __('messages.langActions') }}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($group->users as $user)
                                <tr>
{{--                                    <th scope="row">{{ $group->id }}</th>--}}
                                    <td>{{ $user->surname }}</td>
                                    <td>{{ $group->name }}</td>
{{--                                    <td>{{ $group->dean_act ? $group->dean_act : '-' }}</td>--}}
{{--                                    <td>{{ date('d/m/Y H:i:s', strtotime($group->created_at)) }}</td>--}}
                                    <td>
                                        @can('manage-security')
                                            <div class="row d-flex">
                                                <a href="{{ route('group.edit', $group->id) }}">
                                                    <button type="button" class="btn btn-primary btn-sm mb-1">{{ __('messages.langEdit') }}</button>
                                                </a>
                                                <a href="{{ route('group.edit', $group->id) }}">
                                                    <button type="button" class="btn btn-info btn-sm mb-1 ml-1">{{ __('messages.langShowUsers') }}</button>
                                                </a>
                                                @can('admin')
                                                    <form action="{{ route('group.destroy', $group->id) }}" method="POST" class="ml-1">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                                onclick="return confirm('Επιβεβαίωση Διαγραφής')"
                                                                class="btn btn-danger btn-sm">
                                                            {{ __('messages.langDelete') }}</button>
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
                            <a href="{{ route('group.create') }}" class="btn btn-primary m-4">{{ __('messages.langCreate') }} {{ __('messages.langUser') }}</a>
                        </div>
                        @endcan
                        <div class="row">
                            <a href="{{ route('group.index') }}" class="btn btn-secondary m-4">{{ __('messages.langBack') }}</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
