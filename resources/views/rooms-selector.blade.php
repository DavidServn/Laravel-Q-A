@extends('layouts.master')

@section('title')
    Rooms
@endsection

@section('content')
    <div class="container container-with-banner" style="margin-top: 100px">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <h1 class="text-center">Available Rooms</h1>
			@foreach ($rooms as $room)
                <a href="/questions/{{ $room->id }}" class="room btn btn-block btn-primary">
                    {{ $room->name }}
                </a>
            @endforeach
        </div>
        <div class="col-md-3"></div>	
    </div>
    </div>
@endsection