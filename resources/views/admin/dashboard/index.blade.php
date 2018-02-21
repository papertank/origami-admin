@extends('admin.layouts.default')

@section('content')

<div class="card-group">
	{{-- <a href="{{ aurl('users') }}" class="card card-stats">
		<div class="card-body">
			<i data-feather="user"></i>
		    <h5>
		        <?php $total = App\User::count(); ?>
		        {{ $total }}
		        <small>{{ Str::plural('User', $total) }}</small>
		    </h5>
		</div>
	</a> --}}
</div>

@stop
