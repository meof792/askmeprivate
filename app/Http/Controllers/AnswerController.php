<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\UserWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AnswerController extends Controller
{
    //
    public function answer(Request $request)
    {
        if(!$request->exists('selectedQuestion')){
            return redirect('404');
        }
        if($request->input('answer') == null){
            $notice = 'Câu trả lời không hợp lệ, trống rỗng...';
            return redirect('/profile')->with('notice', $notice);
        }
        $selectedQuestionId = $request->input('selectedQuestion');
        if ($selectedQuestionId != 'Chọn câu hỏi') {
            $answer = new Answer();
            $answer->question_id = $selectedQuestionId;
            $answer->answer_conten = $request->input('answer');
            DB::table('answers')->insert([
                'question_id' => $selectedQuestionId,
                'answer_content' => $request->input('answer'),
            ]);
        }
        $notice = 'Trả lời thành công';
        return redirect('/profile')->with('notice', $notice);
    }
    public function editanswer(Request $request)
    {
        if(!$request->exists('selectedQuestion')){
            return redirect('404');
        }
        if($request->input('answer') == null){
            $notice1 = 'Câu trả lời không hợp lệ, trống rỗng...';
            return redirect('/profile')->with('notice', $notice1);
        }
        $selectedQuestionId = $request->input('selectedQuestion');
        if ($selectedQuestionId != 'Chọn câu hỏi') {
            $answerContent = $request->input('newanswer');
            if ($answerContent != null) {
                DB::table('answers')
                    ->where('question_id', $selectedQuestionId)
                    ->update(['answer_content' => $answerContent]);
            } else {

                DB::table('answers')
                    ->where('question_id', $selectedQuestionId)
                    ->delete();
            }
        }


        $notice1 = 'Chỉnh sửa thành công';
        return redirect('/profile')->with('notice1', $notice1);
    }
    public function deletequestion(Request $request)
    {
        if(!$request->exists('selectedQuestion')){
            return redirect('404');
        }
        $userweb = UserWeb::where("username", $request->session()->get('username'))
            ->select("password")
            ->first();
        // dd($userweb);
        if ($userweb && isset($userweb->password) && (Hash::check($request->input('pass'), $userweb->password))) {
            // return 'yes';
            // Xác thực thành công
            $selectedQuestionId = $request->input('selectedQuestion');
    
            if ($selectedQuestionId != 'Chọn câu hỏi') {
                DB::table('questions')
                    ->where('question_id', $selectedQuestionId)
                    ->delete();
            }
            $notice2 = 'Xóa câu trả lời thành công';
            return redirect('/profile')->with('notice2', $notice2);
        }else{
            $notice2 = 'Mật khẩu không chính xác';
            return redirect('/profile')->with('notice2', $notice2);
        }
    }
}
