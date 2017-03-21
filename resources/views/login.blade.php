@extends('layouts.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="container container-with-banner" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1 class="text-center">Login</h1>
			@if(Session::get('login_message') != null)
				<div class="error-feeds alert alert-danger">Wrong credentials!</div>
			@endif	
            <form action="{{ route('signin') }}" method="post">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="" required>
                </div>
				<div class="form-group">
                    <label for="room">Room</label>				
					<select class="form-control" name="room" id="room" required>
						@foreach ($rooms as $room)
						 	<option value="{{ $room->id }}">{{ $room->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group text-center">				
	                <button type="submit" class="btn btn-primary btn-lg btn-block">Enter</button>
				</div>
            </form>
        </div>
        <div class="col-md-3"></div>	
    </div>
    </div>
@endsection