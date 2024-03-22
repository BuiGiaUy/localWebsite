<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = Room::Where('owner_id', '=', Auth::user()->id)->get();
        return view('content.chat.index', ['rooms' => $rooms]);
    }
    public function chat() {
        $rooms = Room::Where('owner_id', '=', Auth::user()->id)->get();

        return view('content.chat.room',['rooms' => $rooms]);
    }
    public function storeRoom(Request $request) {
        $input = $request->all();


        $room = Room::create([
            'name' => $input['room_name'],
            'icon' => $input['room_icon'],
            'description' => $input['room_description'],
            'owner_id' =>  Auth::user()->id,
        ]);

        return response()->json($room, 200);
    }

    public function search(Request $request) {
        $search_room_name = $request->input('search_room_name');
        if ($search_room_name != "") {
            $query = "";
            for ($i=0; $i<strlen($search_room_name);$i++) {
                $query = $query.'%'.$search_room_name[$i];

            }
            $rooms = Room::where('name', 'like', $query.'%')->get();

        }else {
            $rooms = Room::where('owner_id', '=', Auth::user()->id)->get();
        }
        return response()->json($rooms,200);
    }

    public function join(Request $request) :JsonResponse
    {
        $user = Auth::user();
        $input = $request->all();
        $room = Room::find($input['room_id']);

        if ($user && $room)
        {
            $room->users()->attach($user->id);
        }
        $message = "You have joined the room";

        return response()->json(["message" =>$message, "room"=> $room], 200);
    }
}
