<?php
namespace App\Http\Controllers;

use Session;
use App\User;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function getFeed()
	{
		if(Auth::user() != null)
		{
			return view('feed');
		}
		else
		{
			return redirect('admin');
		}
	}

	//Create new accounts
	public function postSignUp(Request $request)
	{
		$user = new User();
		$user->username = $request['username'];
		$user->password = bcrypt($request['password']);
		$user->is_admin = $request['is_admin'];

		$user->save();
		return redirect()->back();
	}

	public function postSignIn(Request $request)
	{
		if(Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
			Session::set('room', Room::find($request['room']));
			return redirect()->route('feed');
		}
		return redirect()->back()->with('login_message', 'error');
	}
}