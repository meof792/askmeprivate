<?php

namespace App\Http\Controllers;

use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

require '../vendor/autoload.php';

use App\Models\Answer;
use App\Models\ForumQuestion;
use App\Models\Question;
use App\Models\UserWeb;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function questionforum($id){
        $question = ForumQuestion::where("type", $id)
            ->orderBy('timestamp', 'desc') // 'desc' for descending order (newest first)
            ->where('auth', 1)
            ->get();
        $popularquestion = ForumQuestion::where("type", $id)
            ->orderBy('reps', 'desc') // 'desc' for descending order (newest first)
            ->where('auth', 1)
            ->get();
        $newid = "";
        if($id=="tech"){
            $newid = "công nghệ";
        }else if($id=="life"){
            $newid = "đời sống";
        }else if($id=="animal"){
            $newid = "động vật";
        }else if($id=="enjoy"){
            $newid = "sở thích";
        }else if($id=="sport"){
            $newid = "thể thao";
        }else if($id=="food"){
            $newid = "âm thực";
        }else if($id=="art"){
            $newid = "nghệ thuật";
        }else if($id=="else"){
            $newid = "chém gió";
        }else{
            return redirect('404');
        }
        return view('forum.index', [
            'title' => $id,
            'newid' => $newid,
            'question' => $question,
            'popularquestion' => $popularquestion,
        ]);
    }
    public function forum($type, $id){
        $question = ForumQuestion::where("id", $id)
            ->where('auth', 1)
            ->first();
        
        $popularquestion = ForumQuestion::where("type", $type)
            ->orderBy('reps', 'desc') // 'desc' for descending order (newest first)
            ->where('auth', 1)
            ->get();
        $newid = $type;
        if($newid=="tech"){
            $newid = "công nghệ";
        }else if($newid=="life"){
            $newid = "đời sống";
        }else if($newid=="animal"){
            $newid = "động vật";
        }else if($newid=="enjoy"){
            $newid = "sở thích";
        }else if($newid=="sport"){
            $newid = "thể thao";
        }else if($newid=="food"){
            $newid = "âm thực";
        }else if($newid=="art"){
            $newid = "nghệ thuật";
        }else if($newid=="else"){
            $newid = "chém gió";
        }else{
            return redirect('404');
        }
        if($question){
            return view('forum.forumquestion', [
                'title' => $type,
                'newid' => $newid,
                'question' => $question,
                'popularquestion' => $popularquestion,
            ]);
        }else{
            return redirect('404');
        }
    }
    public function questionforumcheck(Request $request){
        $question_content = $request->input('question');
        $title = $request->input('title');
        $type = $request->input('type');
        if($request->input('question') == null){
            $question_content = "null";
        }
        if($request->input('title') == null){
            $title = "null";
        }
        if($request->input('type') == null){
            $type = "null";
        }
        DB::table('forumquestions')->insert([
            'question_content' =>  $question_content,
            'title' =>  $title = $request->input('title'),
            'type' => $type,
            'auth' => 0,
            // Các trường khác của bảng qu  estions (nếu có
        ]);
        return redirect('forum/' . $request->input('type'))->with('alert', 'Đăng câu hỏi thành công! Admin sẽ phê duyệt chủ đề của bạn');
    }
    public function answerforum(Request $request){
        if (!($request->exists('answer') && $request->exists('id'))){
            return redirect('404');
        }
        $question = ForumQuestion::where("id", $request->input('id'))
                ->first();
        if($request->input('answer') == null){
            $notice = "Câu trả lời không hợp lệ, trỗng rỗng...";
            return redirect('forum/'.($question->type).'/'.$request->input('id'))->with('notice', $notice);
        }else{
            DB::table('forumanswers')->insert([
                'answer_content' => $request->input('answer'),
                'question_id' => $request->input('id'),
                // Các trường khác của bảng questions (nếu có
            ]);
            DB::table('forumquestions')->where('id', $request->input('id'))->increment('reps');
            $notice = "Gửi câu trả lời thành công";
            return redirect('forum/'.($question->type).'/'.$request->input('id'))->with('notice', $notice);
        }
    }
    public function addquestion(Request $request){
        if(!$request->exists('username')){
            return redirect('404');
        }
        $notice = "Gửi câu hỏi thành công, câu hỏi sẽ hiển thị ngay khi ".$request->input('username')." trả lời";
        $question_content = $request->input('question');
        if($request->input('question')== null){
            $notice = "Câu hỏi không hợp lệ, trống rỗng,...";
        }else{
            DB::table('questions')->insert([
                'question_content' => $question_content,
                'username' => $request->input('username'),
                // Các trường khác của bảng questions (nếu có
            ]);
            $user = DB::table('user')
                ->where('username', $request->input('username'))
                ->first();
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));
            
            $email = (new Email())
                ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
                ->to(new Address($user->email, $user->username))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Bạn nhận được câu hỏi mới')
                ->text('Hey! Learn the best practices of building HTML emails and play with ready-to-go templates. Mailtrap’s Guide on How to Build HTML Email is live on our blog')
                ->html('<p>Có ai đó đã hỏi bạn tại askmeprivate. Đăng nhập để trả lời ngay :)</p>')
                ;
                
            try {
                $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
                
                var_dump(ResponseHelper::toArray($response)); // body (array)
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            $notice = "Gửi câu hỏi thành công, câu hỏi sẽ hiển thị ngay khi ".$request->input('username')." trả lời";
        }
        return redirect('wall/'.$request->input('username'))->with('notice', $notice);
    }
    public function wall($id)
    {
        $question = Question::where("username", $id)
            ->get();
       
        $userweb = UserWeb::where("username", $id)->first();
        if (!$userweb) {
            // Handle the case where the user is not found
            // For example, you can redirect back with a message
            return redirect('404');
        }

        return view('Questions.index', [
            'question' => $question,
            'userweb' => $userweb,
            // 'answer' => $answer,
            'title' => $id,
        ]);
    }

    //
}
