<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$rooms = App\Room::all();
	return view('rooms-selector', compact('rooms'));
});

Route::get('/admin', function() {
	$rooms = App\Room::all();
	return view('login', compact('rooms'));
});

Route::post('/signin', [
	'uses' => 'UserController@postSignIn',
	'as' => 'signin'
]);

Route::get('/logout', function () {
	Auth::logout();
	$rooms = App\Room::all();
	return view('login', compact('rooms'));
});

Route::get('/mobile', function () {
	App::setLocale('en');
    $rooms = App\Room::all();
	return view('mobile', compact('rooms'));
});

Route::get('/feed', [
	'uses' => 'UserController@getFeed',
	'as' => 'feed'
]);

Route::get('/questions/{room}', function(App\Room $room) {
	$questions = $room->questions()->accepted()->get();
	return view('questions', compact('room', 'questions'));
});

Route::post('/send_question', [
	'uses' => 'QuestionController@sendQuestion',
	'as' => 'send_question'
]);

Route::get('/question/delete/{question}', function(App\Question $question) {
    $question->delete();
    return Response::json($question);
});

Route::get('/question/accept/{question}', function(App\Question $question) {
    $question->accepted = true;
	$question->save();

	$data = [
		'event' => 'accept_question',
		'data' => [
			'id' => $question->id,
			'name' => $question->name,
			'question' => $question->question,
			'room' => $question->room->id,
		]
	];
	//Send accepted question to Socket.io
	Redis::publish('chat', json_encode($data));

    return Response::json($question);
});

Route::group(['prefix' => 'es'], function() {
	Route::get('mobile', function() {
		App::setLocale('es');
		$rooms = App\Room::all();
		return view('mobile', compact('rooms'));
	});
});

/* TO SINGUP MORE USERS
	-- UserController already has the signup method.
	
Route::post('/signup', [
	'uses' => 'UserController@postSignUp',
	'as' => 'signup'
]);

<div class="col-md-6">
	<h3>signup</h3>
	<form action="{{ route('signup') }}" method="post">
		<div class="form-group">
			<label for="username">Usuario</label>
			<input class="form-control" type="text" name="username" id="username" value="">
		</div>
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input class="form-control" type="password" name="password" id="password" value="">
		</div>
		<div class="form-group">
			<label for="is_admin">Admin</label>				
			<select class="form-control" name="is_admin" id="is_admin">
				<option value="1">Si</option>
				<option value="0">No</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Entrar</button>
		<input type="hidden" name="_token" value="{{ Session::token() }}">
	</form>
</div>

*/