<?php
namespace App\Http\Controllers;

use App\Question;
use Session;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class QuestionController extends Controller
{
	public function sendQuestion(Request $request)
	{
        $name = $request->get('name');
        $question = $request->get('question');
        $roomId = $request->get('room');
        $password = $request->get('password');

        $room = Room::findOrFail($roomId);

        if($password == $room->password) {
            $qid = $room->questions()->create([
                'name' => $name,
                'question' => $question
            ])->id;

			$data = [
				'event' => 'send_question',
				'data' => [
					'id' => $qid,
					'name' => $name,
					'question' => $question,
					'room' => $roomId,
				]
			];

			//Send question to Socket.io
			Redis::publish('chat', json_encode($data));
		
			return redirect()->back()
				->with('mobile_message', 'success')
				->with('mobile-name', $name)
				->with('mobile-romm', $roomId);
		} else {
			return redirect()->back()->with('mobile_message', 'error');
		}
	}
}