<?php

// Tải tệp autoload của Laravel
require_once __DIR__.'/../vendor/autoload.php';

// Tải ứng dụng Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Khởi động ứng dụng
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use App\Mail\SendMail; // Import mô hình Mail bạn đã tạo

// Lấy thời gian hiện tại
$currentDateTime = now()->setTimezone('Asia/Ho_Chi_Minh');

// Lấy tất cả các bản ghi từ bảng timemail có send_at nhỏ hơn hoặc bằng thời gian hiện tại
$emailsToSend = DB::table('timemail')
    ->where('send_at', '<=', $currentDateTime)
    ->where('check', 0)
    ->get();


// Duyệt qua từng bản ghi và gửi email
foreach ($emailsToSend as $emails) {
    DB::table('timemail')
        ->where('id', $emails->id) // Giả sử cột id là cột khóa chính của bảng timemail
        ->update(['check' => 1]);
    $apiKey = getenv('MAILTRAP_API_KEY');
        $mailtrap = new MailtrapClient(new Config($apiKey));
        $viewData = [
                'timestamp' => $emails->timestamp,
                'user' => $emails->from,
                'subject' => $emails->subject,
                'content' => $emails->content,  // Đảm bảo bạn truyền cả user nếu cần sử dụng thông tin của user trong view
            ];
        $html = view('timemailsend', $viewData)->render();
        $email = (new Email())
            ->from(new Address('no_reply@askmeprivate.io.vn', 'Askmeprivate'))
            ->to(new Address($emails->to_email, '$user->username'))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Thư thời gian tại askmeprivate: ' . $emails->subject)
            ->text('Hey! Learn the best practices of building HTML emails and play with ready-to-go templates. Mailtrap’s Guide on How to Build HTML Email is live on our blog')
            ->html($html)
            ;
            
        try {
            $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
            
            var_dump(ResponseHelper::toArray($response)); // body (array)
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
