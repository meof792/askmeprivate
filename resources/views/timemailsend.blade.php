<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Email</title>
</head>

<body>
    <h1>Chào bạn của hiện tại,</h1>
    <h3>Đây là thư thời gian đã được lên lịch gửi từ {{ $timestamp }} tại askmeprivate</h3>
    <h4>Bởi: {{ $user }}</h4>
    <h4>Tiêu đề: {{ $subject }}</h4>
    <b>Nội dung:</b>
    <div style="text-align: center">
    <br>
    <i>{{ $content }}</i></div>
</body>

</html>
