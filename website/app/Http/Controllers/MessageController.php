<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController
{
    public function sendMessage(Request $request, $roomId)
    {

        $input = $request->all();

        if (isset($input['content']) && strstr($input['content'], 'http://localwebsite.th/storage/')) {
            $type = 'image';
        }else {
            $type = 'text';
        }
        $message = Message::create([
            'chatRoomId' => $roomId,
            'user_id' => Auth::user()->id,
            'content' => $input['content'],
            'type' => $type,
        ]);

//        echo '<pre>';
//        print_r($input);
//        print_r($type);
//        echo '</pre>';
//        exit();
        return response()->json($message, 200);
    }
        public function editMessage(Request $request, $id)
    {
        // Kiểm tra xem tin nhắn có tồn tại không
        $message = Message::find($id);
        if (!$message) {
            return response()->json(['error' => 'Tin nhắn không tồn tại'], 404);
        }

        // Kiểm tra xem người dùng có quyền chỉnh sửa tin nhắn hay không
        // Ở đây, chúng ta giả sử rằng chỉ có người tạo tin nhắn mới có quyền chỉnh sửa
        if ($message->user_id != auth()->id()) {
            return response()->json(['error' => 'Bạn không có quyền chỉnh sửa tin nhắn này'], 403);
        }

        // Kiểm tra và xác thực dữ liệu được gửi từ biểu mẫu
        $validatedData = $request->validate([
            'message_content' => 'required|string|max:255',
        ]);

        // Cập nhật nội dung tin nhắn
        $message->content = $validatedData['message_content'];
        $message->save();

        // Chuyển hướng hoặc trả về phản hồi thành công tùy thuộc vào yêu cầu
        return redirect()->back()->with('success', 'Tin nhắn đã được cập nhật thành công');
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
