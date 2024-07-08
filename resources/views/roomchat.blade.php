<!DOCTYPE html>
<html lang="en">
@php
    // Kiểm tra xem session 'username' đã tồn tại hay chưa
    $username = session('username');
@endphp

@if (!$username)
    <script>
        alert('Bạn cần đăng nhập để truy cập vào trang lịch sử.');
        window.location.href = '/login';
    </script>
@endif
@if (session()->has('notice'))
    <script>
        alert("{{ session('notice') }}");
    </script>
@endif

<head>
    <title>Ask | Lịch sử trò chuyện</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon"
        href="https://scontent.fhan2-4.fna.fbcdn.net/v/t1.15752-9/363102452_666214241646879_2538633744490536440_n.png?_nc_cat=100&cb=99be929b-3346023f&ccb=1-7&_nc_sid=ae9488&_nc_ohc=UmNIRjD7RG4AX-gBgzJ&_nc_ht=scontent.fhan2-4.fna&oh=03_AdRFoWPYFIkPDtx1rq8AkxLludWFxB60zrFfxU5gRMuu1Q&oe=64E5B1D6">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css" />
    <link href="https://miraweb.tenten.vn/tem3/css/mira-vanchuyen001.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script>
        // function logout() {
        // 	window.location.href = "logout.php";
        // }
        function login() {
            window.location.href = "login";
        }

        function showDropdownMenu() {
            document.querySelector('.dropdown-menu').classList
                .remove('dropdown-hidden');
        }

        function hideDropdownMenu() {
            document.querySelector('.dropdown-menu').classList
                .add('dropdown-hidden');
        }
    </script>
    <style>
        .jumping-text {
            display: inline-block;
            animation: jump 1s infinite;
        }

        @keyframes jump {

            0%,
            100% {
                transform: translateY(0);
            }

            25% {
                transform: translateY(-20px);
            }

            50% {
                transform: translateY(-15px);
            }

            75% {
                transform: translateY(-10px);
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="/chat.css">
    <!-- End CSS -->

</head>

<body>
    <!-- Nav bar -->
    @include('layouts.navbar')
    <!-- End Navbar -->
    @php
        $message = \App\Models\Message::where('inroom', $roomId)->get();
    @endphp
    <div class="chat">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-12">
                    <ul class="list-group">
                        <a href="/chat" class="list-group-item list-group-item-action">
                            Chat với người lạ
                        </a>
                        <a href="/history" class="list-group-item list-group-item-action active"
                            aria-current="true">Lịch sử trò chuyện</a>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12 mb-12">
                    <div class="messages" id="messageContainer" style="height: 510px; overflow-y: auto;">
                        @foreach ($message as $msg)
                            @if ($msg->username === $username)
                                <!-- Kiểm tra xem tin nhắn có thuộc về $username hay không -->
                                <div style="text-align: right;">
                                    <small class="text-muted">{{ $username }}:</small>
                                    <p>{{ $msg->content }}</p>
                                    <small class="text-muted">Lúc: {{ $msg->timestamp }}</small>
                                </div>
                            @else
                                <div style="text-align: left;">
                                    <small class="text-muted">Người lạ:</small>
                                    <p>{{ $msg->content }}</p>
                                    <small class="text-muted">Lúc: {{ $msg->timestamp }}</small>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div style="text-align: center; align-items: center; justify-content: center;">
                        <p>Đoạn chat này đã kết thúc</p>
                        <form action="/payment" class="login-form" method="post" id="login_form">
                            @csrf
                            <input type="hidden" name="roomId" value="{{ $roomId }}">
                            <button type="submit" class="btn btn-secondary">Tìm lại người lạ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    @include ('layouts/footer')
    <!-- End Footer -->
</body>

</html>
