@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <nav>
                            <a class="btn btn-link" href="{{ route('admin') }}">
                                {{ __('Admin Page') }}
                            </a>
                            <a class="btn btn-link" href="{{ route('unapproved') }}">
                                {{ __('Unapproved page') }}
                            </a>
                            <a class="btn btn-link" href="{{ route('approved') }}">
                                {{ __('Approved page') }}
                            </a>
                        </nav>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">email </th>
                                    <th scope="col">Authorize</th></tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        @if ($user->approved_at !== null)
                                            <td> <a href="{{ route('unapprove_user', $user->id) }}" class="btn btn-danger">Unauthorize</a> </td>
                                        @else
                                            <td> <a href="{{ route('approve_user', $user->id) }}"class="btn btn-success">Authorize</button> </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
