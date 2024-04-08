<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController
{
    public function sendMessage(Request $request, $roomId)
    {

        $input = $request->all();
        $user = Auth::user();

        if (isset($input['content']) && strstr($input['content'], 'http://localwebsite.th/storage/')) {
            $type = 'image';
        }else {
            $type = 'text';
        }
        event(new MessageSent($input["content"] ,$roomId));

        $message = Message::create([
            'chatRoomId' => $roomId,
            'user_id' => Auth::user()->id,
            'content' => $input['content'],
            'type' => $type,
        ]);

        return response()->json(["message" => $message,"user" => $user] , 200);
    }
    public function editMessage(Request $request, $id)
    {
        $message = Message::find($id);
        if (!$message) {
            return response()->json(['error' => 'Message does not exist'], 404);
        }

        if ($message->user_id != auth()->id()) {
            return response()->json(['error' => 'You do not have permission to edit this message'], 403);
        }

        $validatedData = $request->validate([
            'message_content' => 'required|string|max:255',
        ]);

        $message->content = $validatedData['message_content'];
        $message->save();

        return redirect()->back()->with('success', 'Message has been successfully updated');
    }

    public function deleteMessage($id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();
            return response()->json(['message' => 'Message deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete message'], 500);
        }
    }
}
