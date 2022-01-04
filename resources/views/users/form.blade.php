@extends('admin::layouts.default')

<?php $user = isset($user) ? $user : false; ?>

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ aurl('users') }}">Users</a></li>
                @if ( $user )
                <li class="breadcrumb-item"><a href="{{ $user->adminUrl() }}">{{ $user->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                @else
                <li class="breadcrumb-item active" aria-current="page">Add User</li>
                @endif
              </ol>
            </nav>
            <div class="page-header">
                <h2 class="page-title">{{ $user ? $user->name : 'New User' }}</h2>
                <div class="page-actions">
                    @if ( $user && ! adminUser()->is($user) )
                        {!! Form::open(['method' => 'DELETE']) !!}
                        <button class="btn btn-danger btn-outline" type="submit" data-confirm-delete="{{ $user->name }}">Delete</button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            <div class="card">
                {!! Form::open() !!}
                <div class="card-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        {!! Form::text('name', old('name', $user ? $user->name : ''), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-mail</label>
                        {!! Form::email('email', old('email', $user ? $user->email : ''), ['class' => 'form-control', 'placeholder' => 'User E-mail']) !!}
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        @if ( $user )
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'New Password']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password']) !!}
                            <p class="help-block">Only enter a new password if you are changing from the current password. Otherwise, leave blank.</p>
                        @else
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">{{ $user ? 'Update' : 'Create' }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
