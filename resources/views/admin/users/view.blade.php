@extends('admin.layouts.default')

<?php $user = isset($user) ? $user : false; ?>

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ aurl('users') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
              </ol>
            </nav>
            <div class="page-header">
                <h2 class="page-title">
                    {{ $user->firstname }}
                </h2>
                <div class="page-actions">
                    <a href="{{ $user->adminUrl('edit') }}" class="btn">
                        <i data-feather="edit"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <img class="align-self-start mr-3" src="{{ $user->avatarUrl() }}">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $user->name }}</h5>
                                    <p class="text-muted mb-1">User since {{ $user->created_at->format('d/m/Y') }}</p>
                                    <p class="text-muted">Last updated {{ $user->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Ref</strong><br />
                                {{ $user->ref }}
                            </li>
                            <li class="list-group-item">
                                <strong>E-mail:</strong><br />
                                {{ $user->email }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
         </div>
    </div>
@stop
