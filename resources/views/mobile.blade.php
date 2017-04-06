@extends('layouts.master')

@section('title')
	Send a question
@endsection

@section('content')
    <div class="container container-with-banner" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="text-center">{{ trans('mobile.sendquestion') }}</h1>
			@if(Session::get('mobile_message') == "error")
				<div class="error-feeds alert alert-danger">{{ trans('mobile.wrong_password') }}</div>
			@endif
			@if(Session::get('mobile_message') == "success")
				<div class="error-feeds alert alert-success">{{ trans('mobile.send_ok') }}</div>
			@endif
            <form action="{{ route('send_question') }}" method="post">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="name">{{ trans('mobile.name') }}</label>
					@if(Session::get('mobile-name') != null)
        	            <input class="form-control" type="text" name="name" id="name" value="{{ Session::get('mobile-name') }}">
					@else
        	            <input class="form-control" type="text" name="name" id="name" value="">
					@endif
                </div>
				<div class="form-group">
                    <label for="question">{{ trans('mobile.question') }}</label>
					@if(Session::get('mobile-question') != null)
	                    <input class="form-control" type="text" name="question" id="question" value="{{ Session::get('mobile-question') }}">
					@else
    	                <input class="form-control" type="text" name="question" id="question" value="">
					@endif
                </div>
				<div class="form-group">
                    <label for="room">{{ trans('mobile.room') }}</label>				
					<select class="form-control" name="room" id="room">
						@foreach ($rooms as $room)
							@if(Session::get('mobile-room') == $room->id)
							 	<option value="{{ $room->id }}" selected>{{ $room->name }}</option>
							@else
							 	<option value="{{ $room->id }}">{{ $room->name }}</option>
							@endif
						@endforeach
					</select>
				</div>
                <div class="form-group">
                    <label for="password">{{ trans('mobile.password') }}</label>
                    <input class="form-control" type="text" name="password" id="password" value="">
                </div>
				<div class="form-group text-center">				
	                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ trans('mobile.send') }}</button>
				</div>
            </form>
        </div>
        <div class="col-md-4"></div>	
    </div>
    </div>
@endsection