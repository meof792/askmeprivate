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

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserWeb;
use App\Models\RoomChat;
use App\Models\ipUser;
use App\Models\EmailCaptcha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
class UserWebController extends Controller
{
    //
    public function paymentcheck(Request $request)
    {
        if(!$request->input('email')) return redirect('404');
        $id = $request->input('roomId');
        $content = $request->input('content');
        $toEmail = $request->input('email');
        $apiKey = getenv('MAILTRAP_API_KEY');
        $mailtrap = new MailtrapClient(new Config($apiKey));
        $email = (new Email())
            ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
            ->to(new Address($toEmail, 'User'))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Xác nhận tìm lại người lạ tại askmeprivate')
            ->text('Xác nhận tìm lại người lạ tại askmeprivate')
            ->html("
            <h2>Bạn đã gửi yêu cầu tìm lại người lạ trong mã phòng $id</h3>
            <p>Nội dung: $content</p>
            <h4>Sau khi hệ thống kiểm tra về nội dung và trạng thái chuyển khoản, thư của bạn sẽ ngay lập tức được gửi cho người lạ
            <h4>Trong trường hợp đơn hàng chưa được thanh toán trong vòng 1 ngày kể từ lúc tạo, đơn hàng của bạn sẽ tự động bị hủy bỏ")
            ;
        try {
            $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
            
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $email2 = (new Email())
            ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
            ->to(new Address('minhb8909@gmail.com', 'User'))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Có đơn hàng tìm người lạ tại askmeprivate')
            ->text('Có đơn hàng tìm người lạ tại askmeprivate')
            ->html("
            <h2>$toEmail đã gửi yêu cầu tìm lại người lạ trong mã phòng $id</h3>
            <p>Nội dung: $content</p>
            <h4> Vui lòng xem xét, và xử lý đơn</h4>")
            ;
        try {
            $response = $mailtrap->sending()->emails()->send($email2); // Email sending API (real)
            
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $notice = 'Đã tiếp nhận yêu cầu, vui lòng kiểm tra email!';
        session()->flash('notice', $notice);
        return redirect('/history');
    }
    public function payment(Request $request)
    {
        if(!$request->input('roomId')) return redirect('404');
        $roomId = $request->input('roomId');
        return view('payment')->with(compact('roomId'));
    }
    public function history($id)
    {   
        $username = session()->get('username');
        $roomchat = \App\Models\RoomChat::where(function ($query) use ($username) {
                                    $query->where('user1', $username)
                                          ->orWhere('user2', $username);
                                })
                                ->where('id', $id)
                                ->first();
        if($roomchat){
            $roomId = $id;
            return view('roomchat')->with(compact('roomId'));
        }else{
            return redirect('404');
        }
    }
    public function checkemail(Request $request)
    {
        $emailcaptcha = EmailCaptcha::where("email", $request->input('email'))->first();
        if($emailcaptcha){
            // Nếu đã tồn tại email, sửa giá trị captcha thành 6 số ngẫu nhiên
            $captcha = mt_rand(100000, 999999);
            DB::table('emailcaptcha')->where('email', $request->input('email'))->update(['captcha' => $captcha]);
            $toEmail = $request->input('email');
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));
            $viewData = [
                'captcha' => $captcha,
            ];
            $html = view('emailcaptcha', $viewData)->render();
            $email = (new Email())
                ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
                ->to(new Address($toEmail, 'User'))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Mã xác thực đăng kí askmeprivate')
                ->text('Mã xác thực đăng kí askmeprivate')
                ->html($html)
                ;
            try {
                $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
                
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            return response()->json(['status' => 'success', 'message' => 'Captcha updated successfully']);
        } else {
            // Nếu chưa tồn tại email, thêm mới một bản ghi với email và captcha ngẫu nhiên
            $captcha = mt_rand(100000, 999999);
            DB::table('emailcaptcha')->insert([
                'email' => $request->input('email'),
                'captcha' => $captcha
            ]);
            $toEmail = $request->input('email');
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));
            $viewData = [
                'captcha' => $captcha,
            ];
            $html = view('emailcaptcha', $viewData)->render();
            $email = (new Email())
                ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
                ->to(new Address($toEmail, 'User'))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Mã xác thực đăng kí askmeprivate')
                ->text('Mã xác thực đăng kí askmeprivate')
                ->html($html)
                ;
            try {
                $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
                
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            return response()->json(['status' => 'success', 'message' => 'New record created successfully']);
        }
    }
    public function addtimemail(Request $request)
    {
        $username = $request->input('username');
        $nickname = $request->input('nickname');
        $subject = $request->input('subject');
        $content = $request->input('content');
        $date = $request->input('date');
        DB::table('timemail')->insert([
            'to_email' => $username,
            'from' => $nickname,
            'subject' => $subject,
            'content' => $content,
            'send_at' => $date,
        ]);
        $notice = 'Lên lịch gửi thư thành công!';
        session()->flash('notice', $notice);
        return redirect('/timemail');
    }
    public function getIp(Request $request)
    {
        $ipUser = $request->ip();
        $ip = ipUser::where("ip", $ipUser)->first();
        if(!$ip){
            DB::table('ip')->insert([
                'ip' => $ipUser,
                'times' => 1,
            ]);
            $toEmail = 'minhb8909@gmail.com';
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));
            $email = (new Email())
                ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
                ->to(new Address($toEmail, 'Minh'))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Chúc mừng! Trang web của chúng ta đã được 1 vị khách mới ghé thăm')
                ->text('Chúc mừng! Trang web của chúng ta đã được 1 vị khách mới ghé thăm')
                ->html("
                <h3>Có vị khách mới đã truy cập vào askmeprivate</h3>
                <p>Địa chỉ ip của họ là: $ipUser</p>"
                )
                ;
            try {
                $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
                
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            return response()->json(['ip' => $ipUser]);
        }else{
            DB::table('ip')->where('ip', $ipUser)->increment('times', 1);
            return response()->json(['ip' => $ipUser]);
        }
    }
    public function logout()
    {
        Session::forget('username');

        // Hoặc có thể sử dụng phương thức pull để xóa session và trả về giá trị của session đó
        // $username = Session::pull('username');

        // Redirect đến trang chủ hoặc trang sau khi đăng xuất thành công
        $notice = 'Vui lòng đăng nhập lại';
        session()->flash('notice', $notice);
        return redirect('/login');
    }
    public function alluser()
    {
        $users = UserWeb::get();
    }
    public function login(Request $request)
    {
        //Hash::check($request->input('password'), $userweb->password)
        // return 'check';
        $userweb = UserWeb::where("username", $request->input('username'))
            ->select("password")
            ->first();
        if ($userweb && isset($userweb->password) && (Hash::check($request->input('password'), $userweb->password))) {
            // return 'yes';
            // Xác thực thành công
            // Set session "username" với giá trị của $userweb->username
            $request->session()->put('username', $request->input('username'));
            // Redirect đến trang chính hoặc trang sau khi đăng nhập thành công
            return redirect('');
        } else {
            $error = 'Tên người dùng hoặc mật khẩu không đúng.';
            return view('login')->with(compact('error'));
        }
    }
    public function updatenickname(Request $request)
    {
        // if(!$request->exists('username')){
        //     return redirect('404');
        // }
        $userweb = UserWeb::where("username", $request->session()->get('username'))
            ->select("password")
            ->first();
        if($request->input('nickname') == null){
            $alert = 'Nickname không hợp lệ, trống rỗng...';
            return redirect('update')->with('alert', $alert);
        }
        // dd($userweb);
        if ($userweb && isset($userweb->password) && (Hash::check($request->input('pass'), $userweb->password))) {
            // return 'yes';
            // Xác thực thành công
            DB::update('UPDATE user SET nickname = ? WHERE username = ?', [$request->input('nickname'), $request->session()->get('username')]);
            // Redirect đến trang chính hoặc trang sau khi đăng nhập thành công
            $alert = "Cập nhật biệt danh thành công.";
            return redirect('update')->with('alert', $alert);
        } else {
            $alert = 'Mật khẩu không đúng.';
            return redirect('update')->with('alert', $alert);
        }
    }
    public function updatedescription(Request $request)
    {
        // if(!$request->exists('username')){
        //     return redirect('404');
        // }
        $userweb = UserWeb::where("username", $request->session()->get('username'))
            ->select("password")
            ->first();
        if($request->input('description') == null){
            $alert = 'Mô tả không hợp lệ, trống rỗng...';
            return redirect('update')->with('alert', $alert);
        }
        // dd($userweb);
        if ($userweb && isset($userweb->password) && (Hash::check($request->input('pass'), $userweb->password))) {
            // return 'yes';
            // Xác thực thành công
            DB::update('UPDATE user SET description = ? WHERE username = ?', [$request->input('description'), $request->session()->get('username')]);
            // Redirect đến trang chính hoặc trang sau khi đăng nhập thành công
            $alert1 = 'Cập nhật mô tả thành công.';
            return redirect('update')->with('alert1', $alert1);
        } else {
            $alert1 = 'Mật khẩu không đúng.';
            return redirect('update')->with('alert1', $alert1);
        }
    }
    public function updatepassword(Request $request)
    {
        // if(!$request->exists('username')){
        //     return redirect('404');
        // }
        $userweb = UserWeb::where("username", $request->session()->get('username'))
            ->select("password")
            ->first();
        if($request->input('password') == null){
            $alert = 'Mật khẩu không hợp lệ, trống rỗng...';
            return redirect('update')->with('alert', $alert);
        }
        // dd($userweb);
        if ($userweb && isset($userweb->password) && (Hash::check($request->input('pass'), $userweb->password))) {
            // return 'yes';
            // Xác thực thành công
            $hashedPassword = Hash::make($request->input('password'));
            DB::update('UPDATE user SET password = ? WHERE username = ?', [$hashedPassword, $request->session()->get('username')]);
            // Redirect đến trang chính hoặc trang sau khi đăng nhập thành công

            return redirect('logout');
        } else {
            $alert2 = 'Mật khẩu không đúng.';
            return redirect('update')->with('alert2', $alert2);
        }
    }
    public function forget(Request $request)
    {
        // if(!$request->exists('username')){
        //     return redirect('404');
        // }
        $username = $request->input('username');

        $user = DB::table('user')
            ->where('username', $username)
            ->first();
        if ($user) {
            $password = Str::random(6).(Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString());
            $password = str_replace([' ', '-', ':'], '', $password);
            $hashedPassword = Hash::make($password);
            // Tên đăng nhập tồn tại, tiến hành xử lý lấy email và gửi mật khẩu tạm thời
            DB::table('user')
                ->where('username', $username)
                ->update(['password' => $hashedPassword]);
            // (Đây là phần bạn đã làm trong các bước tiếp theo)
            $toEmail = $user->email;
            $apiKey = getenv('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));
            $viewData = [
                'password' => $password,
                'username' => $user->username,  // Đảm bảo bạn truyền cả user nếu cần sử dụng thông tin của user trong view
            ];
            $html = view('password', $viewData)->render();
            $email = (new Email())
                ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
                ->to(new Address($toEmail, $user->username))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Khôi phục tài khoản tại Askmeprivate')
                ->text('Hey! Learn the best practices of building HTML emails and play with ready-to-go templates. Mailtrap’s Guide on How to Build HTML Email is live on our blog')
                ->html($html)
                ;
                
            try {
                $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
                
                var_dump(ResponseHelper::toArray($response)); // body (array)
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

            // Mail::send('password',compact('password'), function($email) use ($toEmail){
                
            //     $email->to($toEmail, 'meoep')->subject('Khôi phục mật khẩu');
            // });
            // Sau khi xử lý xong, bạn có thể sử dụng session để hiển thị thông báo hoặc redirect.
            // return redirect()->route('forget')->with('username', $username);
            $notice = 'Vui lòng kiểm tra email(có thể trong mục spam)';
            session()->flash('notice', $notice);
            return redirect('/login');

        } else {
            $notice = 'Tên đăng nhập không tồn tại';
            session()->flash('notice', $notice);
            return redirect('/forget');
        }
    }
    public function register(Request $request)
    {
        // if(!$request->exists('username')){
        //     return redirect('404');
        // }
        $userwebcheck = UserWeb::where("username", $request->input('username'))
            ->first();
        $emailcheck = UserWeb::where("email", $request->input('email'))->first();
        if (!isset($userwebcheck)) {
            //Chưa có người dùng
            if (isset($emailcheck)) {
                // Email tồn tại
                // Tiếp tục xử lý tại đây
                $error = 'Email đã tồn tại.';
                $username1 = $request->input('username');
                $email1 = $request->input('email');
                $nickname1 = $request->input('nickname') ?? "";
                return view('register')->with(compact('error', 'username1', 'email1', 'nickname1'));
            } else {
                // Email không tồn tại
                // Tiếp tục xử lý tại đây
                $captcha = $request->input('captcha');
                $emailcaptcha = EmailCaptcha::where("email", $request->input('email'))->first();
                if(!$emailcaptcha){
                    //Chưa tồn tại xác thực email
                    $error = 'Vui lòng ấn vào gửi mã xác thực trước';
                    $username1 = $request->input('username');
                    $email1 = $request->input('email');
                    $nickname1 = $request->input('nickname') ?? "";
                    return view('register')->with(compact('error', 'username1', 'email1', 'nickname1'));
                }else{
                    //Đã tồn tại xác thực email
                    if($emailcaptcha->captcha != $captcha){
                        //Không đúng mã xác thực
                        $error = 'Mã xác thực không đúng';
                        $username1 = $request->input('username');
                        $email1 = $request->input('email');
                        $nickname1 = $request->input('nickname') ?? "";
                        return view('register')->with(compact('error', 'username1', 'email1', 'nickname1'));
                    }else{
                        //Đã nhập đúng mã xác thực
                        $username = $request->input('username');
                        $password = $request->input('password');
                        $hashedPassword = Hash::make($password);
                        $email = $request->input('email');
                        
                        // Tạo bản ghi mới trong bảng users
                        $userweb = new UserWeb();
                        $userweb->username = $username;
                        $userweb->password = bcrypt($password); // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
                        $userweb->email = $email;
                        DB::table('user')->insert([
                            'username' => $username,
                            'password' => $hashedPassword,
                            'email' => $email,
                            
                        ]);
                        $notice = 'Đăng kí thành công';
                        session()->flash('notice', $notice);
                        return redirect('/login');
                    }
                }
            }
        } else {
            //Đã tồn tại người dùng
            $error = 'Tên người đùng đã tồn tại.';
            $username1 = $request->input('username');
            $email1 = $request->input('email');
            $nickname1 = $request->input('nickname') ?? "";
            return view('register')->with(compact('error', 'username1', 'email1', 'nickname1'));
        }
    }
}
