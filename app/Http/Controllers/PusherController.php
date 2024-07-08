<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Events\PusherBroadcast;
use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PusherController extends Controller
{
    public function leave(Request $request) {
        $username = $request->session()->get('username');
        if(!$username){
            return view('error');
        }else{
            $roomchat = RoomChat::where(function($query) use ($username) {
                $query->where('user1', $username)
                      ->orWhere('user2', $username);
            })
            ->where('iswaiting', 0)
            ->where('leave', 0)
            ->first();
            if($roomchat){
                $roomchat->leave = 1;
                $roomchat->save();
            }else{
                return view('error');
            }
            $notice = "Bạn đã thoát cuộc trò truyện";
            return redirect('/chat')->with('notice', $notice);
        }
    }
    public function checkleave(Request $request) {
        $room_id = $request->get('room_id');
        if(!$room_id){
            return view('error');
        }
        $roomchat = RoomChat::where('id', $room_id)->first();
        if ($roomchat->leave == 1) {
            return response()->json(['status' => 'leaved']);
        } else {
            return response()->json(['status' => 'not']);
        }
    }
    public function checkotheruser(Request $request) {
        $username = $request->session()->get('username');
        $roomchat = RoomChat::where(function($query) use ($username) {
            $query->where('user1', $username)
                  ->orWhere('user2', $username);
        })
        ->where('iswaiting', 0)
        ->where('leave', 0)
        ->first();
        if ($roomchat && $roomchat->user1 && $roomchat->user2) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'waiting']);
        }
    }
    public function index(Request $request)
    {
        $username = $request->session()->get('username');

        $roomchat = RoomChat::where(function($query) use ($username) {
            $query->where('user1', $username)
                  ->orWhere('user2', $username);
        })
        ->where('iswaiting', 0)
        ->where('leave', 0)
        ->first();
        if($roomchat){
            if ($roomchat->user1 === $username) {
                // Nếu $username là user1, chọn user2
                $otherUser = $roomchat->user2;
            } else {
                // Nếu $username là user2, chọn user1
                $otherUser = $roomchat->user1;
            }
            
            // Lấy tất cả tin nhắn của người dùng có username là $username
            $messages = Message::where('inroom', $roomchat->id)->get();
            return view('realtimechat.chat', ['messages' => $messages, 'room_id' => $roomchat->id, 'otherUser' => $otherUser] );
        }else{
            $roomchat = RoomChat::where(function($query) use ($username) {
                $query->where('user1', $username)
                      ->orWhere('user2', $username);
            })
            ->where('iswaiting', 1)
            ->where('leave', 0)
            ->first();
            if($roomchat){
                return view('realtimechat.chat', ['messages' => null, 'room_id' => $roomchat->id, 'otherUser' => null] );
            }else{
                return view('realtimechat.chat', ['messages' => null, 'room_id' => null, 'otherUser' => null] );
            }
        }
    }

    public function broadcast(Request $request)
    {
        if(!$request->get('message')){
            return view('error');
        }
        $username = $request->session()->get('username');
        $roomchat = RoomChat::where(function($query) use ($username) {
            $query->where('user1', $username)
                  ->orWhere('user2', $username);
        })
        ->where('iswaiting', 0)
        ->where('leave', 0)
        ->first();
        
        if($roomchat){
            if ($roomchat->user1 === $username) {
                // Nếu $username là user1, chọn user2
                $otherUser = $roomchat->user2;
            } else {
                // Nếu $username là user2, chọn user1
                $otherUser = $roomchat->user1;
            }
            if($roomchat->user1 && $roomchat->user2){
                $message = $request->get('message');
                DB::table('message')->insert([
                    'username' => $username,
                    'content' => $message,
                    'inroom' => $roomchat->id,
                ]);
            }else{
                $message = 'Vui lòng đợi 1 người nữa';
            }
        }
        $timestamp = Carbon::now()->toDateTimeString();
        broadcast(new PusherBroadcast((string)$roomchat->id, $otherUser, $message))->toOthers();
        return view('realtimechat.broadcast', [
        'message' => $message,
        'timestamp' => $timestamp,
        ]);
    }

    public function receive(Request $request)
    {
        if(!$request->get('message')){
            return view('error');
        }
        $timestamp = Carbon::now()->toDateTimeString();
        return view('realtimechat.receive', ['message' => $request->get('message'), 'timestamp' => $timestamp,]);
    }
    public function create(Request $request)
    {
        $username = $request->session()->get('username');
        if(!$username){
            return view('error');
        }
        $roomchatcheck = RoomChat::where(function($query) use ($username) {
            $query->where('user1', $username)
                  ->orWhere('user2', $username);
        })
        ->where('iswaiting', 0)
        ->where('leave', 0)
        ->first();
        $roomchatwait= RoomChat::where('user1', $username)
        ->where('iswaiting', 1)
        ->where('leave', 0)
        ->first();
        
        if($roomchatcheck || $roomchatwait){
            return redirect('/chat');
        }else{
            $roomchat = RoomChat::where('iswaiting', 1)
                ->first();
            if($roomchat){
                $roomchat1 = RoomChat::where('iswaiting', 0)
                ->where('leave', 1)
                ->where('user1', $roomchat->user1)
                ->where('user2', $username)
                ->first();
                $roomchat2 = RoomChat::where('iswaiting', 0)
                ->where('leave', 1)
                ->where('user2', $roomchat->user1)
                ->where('user1', $username)
                ->first();
                if($roomchat1 || $roomchat2){
                    $roomchat = new RoomChat();
                    $roomchat->user1 = $username;
                    $roomchat->iswaiting = 1; // Đặt iswaiting là 1 để đánh dấu phòng đang chờ
                    $roomchat->save();
                    return redirect('/chat');
                }else{
                    $roomchat->user2 = $username;
                    $roomchat->iswaiting = 0;
                    $roomchat->save();
                    return redirect('/chat');
                }
            }else{
                $roomchat = new RoomChat();
                $roomchat->user1 = $username;
                $roomchat->iswaiting = 1; // Đặt iswaiting là 1 để đánh dấu phòng đang chờ
                $roomchat->save();
                return redirect('/chat');
            }
        }
    }
}
