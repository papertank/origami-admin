@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="page-header">
                <h2 class="page-title">Search Results</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['method' => 'GET', 'class' => 'card-filters']) !!}
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="q" class="sr-only">Search</label>
                                    {!! Form::text('q', old('q'), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @if ($results->isEmpty())
                <div class="card-body">
                    <div class="no-content">
                        @if ( Input::except('page') )
                            <p>No results match that search</p>
                        @else
                            <p>No results</p>
                        @endif
                    </div>
                </div>
                @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col" width="200">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $results as $result )
                                <tr data-href="{{ $result->getSearchResultUrl() }}">
                                    <th scope="row">
                                        <a href="{{ $result->getSearchResultUrl() }}" class="link">{{ $result->getSearchResultTitle() }}</a>
                                    </td>
                                    <td>{{ $result->getSearchResultType() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop
