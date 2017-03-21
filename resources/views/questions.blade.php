@extends('layouts.master')

@section('title')
	{{ $room->name }}
@endsection

@section('banner_content')
	<div class="navbar-header">
		<p class="navbar-brand room-name">{{ $room->name }}</p>
	</div>
@endsection

@section('content')
    <div class="container container-with-banner">
	<div class="row">
		<div class="col-xs-12">
			<div class="spinner-feeds" style="text-align: center; margin-top: 200px;">
				<i class="fa fa-spinner fa-spin fa-3x"></i>
			</div>
			<div class="error-feeds alert alert-danger" style="display:none;margin: 0px;">
				Error connecting to Socket.io!
			</div>
			<div id="chat-window">
				<ul id="chat-list">
				@foreach($questions as $question)
					<li>
						<p class="name">{{ $question->name }}</p>
						<p class="question">{{ $question->question }}</p>
					</li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.min.js"></script>
	<script src="{{asset('js/ajax-questions.js')}}"></script>
	<script>
	var room = "{{ $room->id }}";

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

	socket.on("chat:accept_question", function(data) {
		if(data.room == room) {
			$('#chat-list').append(
			'<li>' +
				'<p class="name">' + escapeHtml(data.name) + '</p>' +
				'<p class="question">' + escapeHtml(data.question) + '</p>' +
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