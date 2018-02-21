@extends('admin.layouts.auth')

@section('content')
{!! Form::open(['class' => 'form-login']) !!}
    @include('notice::all')
    <label for="inputEmail" class="sr-only">Email address</label>
    {!! Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'E-mail address', 'required', 'autofocus' => ! old('email')]) !!}
    <label for="inputPassword" class="sr-only">Password</label>
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'inputPassword', 'placeholder' => 'Password', 'required', 'autofocus' => old('email')]) !!}
    <div class="checkbox mb-3">
        <label>
        {!! Form::checkbox('remember', 1) !!} Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-default btn-block" type="submit">Login</button>
{!! Form::close() !!}
@endsection
