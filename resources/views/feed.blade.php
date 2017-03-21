@extends('layouts.master')

@section('title')
	{{ Session::get('room')->name }}
@endsection

@section('banner_content')
		<div class="navbar-header">
			<p class="room-name">{{ Session::get('room')->name }}</p>
		</div>
		<div class="container-fluid footer navbar-fixed-bottom">
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav navbar-nav navbar-right">
					<li class="logout"><a href="{{ URL::to('logout') }}">Logout</a></li>
				</ul>
			</div>
		</div>
		</div>
@endsection

@section('content')
    <div class="container container-with-banner">
	<div class="container theme-showcase" role="main">
		<div class="spinner-feeds" style="text-align: center; margin-top: 200px;">
			<i class="fa fa-spinner fa-spin fa-3x"></i>
		</div>
		<div class="error-feeds alert alert-danger" style="display:none;margin: 0px;">
			Error connecting to Socket.io!
		</div>
		<div id="chat-window">
			<ul id="chat-list">
			@foreach(Session::get('room')->questions()->get() as $question)
				<li>
					<p class="name">{{ $question->name }}</p>
					<p class="question">{{ $question->question }}</p>
				@if(!$question->accepted)
					<button type="button" class="btn btn-success btn-sm" id="msg_accept" value="{{ $question->id }}"><span 	class="glyphicon glyphicon-ok"></span></button>
					<button type="button" class="btn btn-danger btn-sm" id="msg_delete" value="{{ $question->id }}"><span class="glyphicon glyphicon-trash"></span></button>
				@endif
				</li>
			@endforeach
			</ul>
		</div>
	</div>
	</div>
@endsection

@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.min.js"></script>
	<script src="{{asset('js/ajax-questions.js')}}"></script>
	<script>
	var room = "{{ Session::get('room')->id }}";

	var socket = io('127.0.0.1:3000', {
		reconnection: false
	});
	
	$('.spinner-feeds').show();
	$('#chat-window').hide();
	$('.error-feeds').hide();

	socket.on('connect_error', function() {
		$('.spinner-feeds').hide();
		$('#chat-window').hide();
		$('.error-feeds').show();
	});

	socket.on('connect', function() {
		$('.spinner-feeds').hide();
		$('#chat-window').show();
		$('.error-feeds').hide();
	});

	socket.on("chat:send_question", function(data) {
		if(data.room == room) {
			$('#chat-list').append(
			'<li>' +
				'<p class="name">' + escapeHtml(data.name) + '</p>' +
				'<p class="question">' + escapeHtml(data.question) + '</p>' +
				'<button type="button" class="btn btn-success btn-sm" id="msg_accept" value="' + data.id + '"><span class="glyphicon glyphicon-ok"></span></button>\n' +
				'<button type="button" class="btn btn-danger btn-sm" id="msg_delete" value="' + data.id + '"><span class="glyphicon glyphicon-trash"></span></button>' +
			'</li>');
		}
	});

	var entityMap = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#39;',
		'/': '&#x2F;',
		'`': '&#x60;',
		'=': '&#x3D;'
	};

	function escapeHtml(string) {
		return String(string).replace(/[&<>"'`=\/]/g, function (s) {
			return entityMap[s];
		});
	}
	</script>
@endsection