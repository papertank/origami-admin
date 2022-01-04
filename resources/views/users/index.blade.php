@extends('admin::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="page-header">
                <h2 class="page-title">Users</h2>
                <div class="page-actions">
                    <a href="{{ aurl('users/create') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <div class="card">
                @if (! $users->isEmpty() || Input::except('page'))
                <div class="card-body">
                    {!! Form::open(['method' => 'GET', 'class' => 'card-filters']) !!}
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="q" class="sr-only">Search Users</label>
                                    {!! Form::text('q', old('q'), ['class' => 'form-control', 'placeholder' => 'Search users...']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @endif
                @if ($users->isEmpty())
                <div class="card-body">
                    <div class="no-content">
                        @if ( Input::except('page') )
                            <p>No users match that search</p>
                        @else
                            <p>No users</p>
                        @endif
                    </div>
                </div>
                @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $users as $user )
                                <tr data-href="{{ $user->adminUrl() }}">
                                    <th scope="row">{{ $user->ref }}</th>
                                    <td>
                                        <a href="{{ $user->adminUrl() }}" class="link">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer card-pagination">
                    {!! $users->links() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
@stop
