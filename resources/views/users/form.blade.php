@extends('admin.layouts.default')

@section('content')
    <?php $user = isset($user) ? $user : false; ?>

    <div class="page-header clearfix">
        <h1 class="page-title">{{ $user ? 'Edit User' : 'Create User' }}</h1>
        <div class="page-actions">
            @if ($user && ! Auth::guard('admin')->user()->is($user))
                <a href="{{ admin_url('impersonate/take/'.$user->slug) }}" class="btn btn-default">
                    <i class="fa fa-user-secret"></i> Impersonate
                </a>
                {!! Form::open(['method' => 'DELETE']) !!}
                    {!! Form::hidden('user', $user->ref) !!}
                    <button type="submit" class="btn btn-link btn-danger" data-confirm-delete="{{ $user->name }}">Delete</button>
                {!! Form::close() !!}
            @endif
        </div>
    </div>

    <div class="panel panel-default panel-form">
        {!! Form::open() !!}
        <div class="panel-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>
                {!! Form::text('name', old('name', $user ? $user->name : ''), ['class' => 'form-control', 'placeholder' => 'Full Name']) !!}
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-mail</label>
                {!! Form::email('email', old('email', $user ? $user->email : ''), ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">{{ $user ? 'Update' : 'Save' }}</button>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
