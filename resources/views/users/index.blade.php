@extends('admin.layouts.default')

@section('content')
    <div class="page-header clearfix">
        <h1 class="page-title">Users</h1>
    </div>
    @if ( $users->isEmpty() )
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="no-content">
                    @if ( Input::except('page') )
                        <p>There were no users found with those search filters</p>
                    @else
                        <p>There are no users yet</p>
                    @endif
                </div>
            </div>
        </div>
    @else
    <div class="panel panel-table panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-4 col-sm-push-8">
                    {!! Form::open(['method' => 'GET']) !!}
                        <div class="input-group">
                            {!! Form::text('q', Input::get('q'), ['class' => 'form-control', 'placeholder' => 'Search for...']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th width="100"></th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr data-href="{{ $user->adminUrl() }}">
                        <td>{{ $user->slug }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Str::title($user->type) }}</td>
                        <td>{{ $user->created_at->toDateTimeString() }}</td>
                        <td class="links">
                            <a href="{{ $user->adminUrl() }}" class="btn btn-icon"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer panel-footer-pagination">
            {!! $users->links() !!}
        </div>
    </div>
    @endif
@endsection
