<!DOCTYPE html>
<html lang="en">
@if (session()->has('notice'))
    <script>
        alert("{{ session('notice') }}");
    </script>
@endif

<head>
    <title>Ask | Chat với người lạ</title>
    <meta name="keywords" content="Ask, Private, Anonymous, Timemail, Chat, Cvnl, Chat với người lạ">
    <meta name="description" content="Askmeprivate | Cvnl | Chat với người lạ trực tuyến miễn phí và ẩn danh.">
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
    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="chat.css">
    <!-- End CSS -->

</head>

<body>
    @include('layouts.navbar')
    @php
        $username = session('username');
    @endphp
    <script>
        console.log('Username:', '{{ $username }}');
        console.log('Phòng: ', '{{ $room_id }}')

        function playNotificationSound() {
            var audio = document.getElementById("notificationAudio");
            audio.play();
        }
    </script>
    @if ($username == null)
        <!-- Display window alert and redirect to homepage when OK is clicked -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-0 mb-0">
                </div>
                <div class="col-lg-8 col-md-12 mb-12">
                    <h1 style="font-size: 1em;"">Hãy tố cáo nếu như người lạ có hành vi không đúng</h1>
                </div>
             </div>
        </div>
        <script>
            // Function to display window alert
            function showWindowAlert() {
                window.alert("Bạn chưa đăng nhập!");
            }

            // Function to redirect to homepage
            function redirectToHomePage() {
                window.location.href = "/login";
            }

            // Call the functions when the page is loaded
            window.onload = function() {
                showWindowAlert();
                redirectToHomePage();
            }
        </script>
    @else
        <div class="chat">
            <div class="container">
                <div class="row">
                    <audio id="notificationAudio">
                        <source src="/notification.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <!-- Header -->
                    <!-- End Header -->
                    <!-- Chat -->
                    <div class="col-lg-4 col-md-12 mb-12">
                        <ul class="list-group">
                            <a href="/chat" class="list-group-item list-group-item-action active" aria-current="true">
                                Chat với người lạ
                            </a>
                            <a href="/history" class="list-group-item list-group-item-action">Lịch sử trò chuyện</a>
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-12 mb-12">
                        @if ($room_id)
                            @if ($messages && $otherUser)
                                <div class="messages" id="messageContainer" style="height: 510px; overflow-y: auto;">
                                    @foreach ($messages as $message)
                                        @if ($message->username === $username)
                                            <!-- Kiểm tra xem tin nhắn có thuộc về $username hay không -->
                                            <div class="right message">
                                                <div><small class="text-muted">{{$username}}:</small></div>
                                                <div>
                                                    <p title="{{$message->timestamp}}">{{$message->content}}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="left message">
                                            <div><small class="text-muted">Người lạ:</small></div>
                                            <div>
                                                <p title="{{$message->timestamp}}">{{$message->content}}</p>
                                            </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="bottom" id="inputbottom">
                                    <form>
                                        <input type="text" id="message" name="message"
                                            placeholder="Enter message..." autocomplete="off" required>
                                        <button type="submit" class="btn btn-info"
                                            style="background: url('https://assets.edlin.app/icons/font-awesome/paper-plane/paper-plane-regular.svg') center no-repeat;"></button>
                                    </form>
                                    <button onclick="confirmRedirect('/leave');" class="btn btn-info"
                                        style="background: url('https://thumb.ac-illust.com/cd/cdc7d9829ba04efc1f1d919b9b9983b7_t.jpeg') center no-repeat; background-size: cover;"></button>
                                </div>
                                <div class="text-center" id="alertbottom" style="display:none; text-align: center; justify-content: center;">
                                    <div class="d-inline-block align-middle">
                                        <p>Người lạ đã thoát mất rồi :( </p>
                                        <a href="create" class="btn btn-info">Tìm Người Mới</a>
                                    </div>
                                </div>
                                <script>
                                    function confirmRedirect(url) {
                                        // Hiển thị cửa sổ cảnh báo
                                        if (confirm("Bạn có chắc muốn thoát cuộc trò chuyện này?")) {
                                            // Nếu người dùng đồng ý, thực hiện chuyển hướng
                                            window.location.href = url;
                                        } else {
                                            // Nếu người dùng không đồng ý, không làm gì cả
                                        }
                                    }
                                    var roomId = "{{ $room_id }}";

                                    function checkleave() {
                                        $.ajax({
                                            url: '/checkleave',
                                            type: 'GET',
                                            data: {
                                                room_id: roomId
                                            },
                                            success: function(response) {
                                                if (response.status === 'leaved') {
                                                    // Chuyển hướng đến trang chat
                                                    // document.getElementById("messageContainer").style.display = "none";
                                                    document.getElementById("inputbottom").style.display = "none";
                                                    document.getElementById("alertbottom").style.display = "block";
                                                } else {
                                                    // $otherUser vẫn chưa tồn tại, thực hiện các hành động khác nếu cần
                                                }
                                            }
                                        });
                                    }

                                    $(document).ready(function() {
                                        // Kiểm tra $otherUser mỗi giây
                                        setInterval(checkleave, 1000);
                                    });
                                </script>
                                <script>
                                    // Hàm để cuộn đoạn div xuống dưới cùng
                                    function scrollToBottom() {
                                        var messageContainer = document.getElementById("messageContainer");
                                        messageContainer.scrollTop = messageContainer.scrollHeight;
                                    }

                                    // Cuộn xuống dưới cùng khi trang được tải hoàn chỉnh
                                    window.onload = scrollToBottom;

                                    // Cuộn xuống dưới cùng sau khi có tin nhắn mới được thêm vào
                                    var observer = new MutationObserver(scrollToBottom);
                                    observer.observe(document.getElementById("messageContainer"), {
                                        childList: true
                                    });
                                </script>
                            @else
                                <div style="text-align: center; align-items: center;height: 250px;margin-top: 200px;">
                                    <span style="text-align: center;">Đang kết nối với người dùng khác, vui lòng
                                        đợi xíu</span>
                                    <img src="ZKZg.gif" alt="loading animation" style="width: 50px; height: auto;">
                                </div>
                                <script>
                                    

                                    function checkOtherUser() {
                                        $.ajax({
                                            url: '/checkotheruser',
                                            type: 'GET',
                                            success: function(response) {
                                                if (response.status === 'success') {
                                                    // Phát âm thanh thông báo trước khi chuyển hướng đến trang chat
                                                    playNotificationSound();
                                                    // Chuyển hướng đến trang chat
                                                    window.location.href = '/chat';
                                                } else {
                                                    // $otherUser vẫn chưa tồn tại, thực hiện các hành động khác nếu cần
                                                }
                                            }
                                        });
                                    }

                                    $(document).ready(function() {
                                        // Kiểm tra $otherUser mỗi giây
                                        setInterval(checkOtherUser, 1000);
                                    });
                                </script>
                            @endif
                            <!-- End Chat -->

                            <!-- Footer -->
                            <script>
                                const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
                                    cluster: 'ap1'
                                });
                                const room_id = "{{ $room_id }}";
                                const channel = pusher.subscribe(room_id);
                                //Receive messages
                                channel.bind('chat', function(data) {
                                    $.post("/receive", {
                                            _token: '{{ csrf_token() }}',
                                            message: data.message,
                                            username: '{{ $username }}'
                                        })
                                        .done(function(res) {
                                            // Kiểm tra xem có tin nhắn nào ban đầu không
                                            var messagesContainer = $(".messages");
                                            var isFirstMessage = messagesContainer.children().length === 0;

                                            // Nếu là tin nhắn đầu tiên, thêm vào phần tử '.messages'
                                            if (isFirstMessage) {
                                                messagesContainer.append(res);
                                            } else {
                                                // Nếu không phải tin nhắn đầu tiên, thêm vào phần tử cuối cùng
                                                messagesContainer.children().last().after(res);
                                            }
                                            playNotificationSound();
                                            // $(document).scrollTop($(document).height());
                                        });
                                });

                                //Broadcast messages
                                $("form").submit(function(event) {
                                    event.preventDefault();

                                    $.ajax({
                                        url: "/broadcast",
                                        method: 'POST',
                                        headers: {
                                            'X-Socket-Id': pusher.connection.socket_id
                                        },
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            message: $("form #message").val(),
                                        }
                                    }).done(function(res) {
                                        // Kiểm tra xem có tin nhắn nào ban đầu không
                                        var messagesContainer = $(".messages");
                                        var isFirstMessage = messagesContainer.children().length === 0;

                                        // Nếu là tin nhắn đầu tiên, thêm vào phần tử '.messages'
                                        if (isFirstMessage) {
                                            messagesContainer.append(res);
                                        } else {
                                            // Nếu không phải tin nhắn đầu tiên, thêm vào phần tử cuối cùng
                                            messagesContainer.children().last().after(res);
                                        }
                                        $("form #message").val('');
                                        // $(document).scrollTop($(document).height());
                                    });
                                });
                            </script>
                        @else
                            <div
                                style="text-align: center; align-items: center; justify-content: center; line-height: 250px;">
                                <h1 style="font-size: 1em; padding-top: 150px; padding-bottom: 20px">Chào mừng bạn đến với chat với người lạ</h1>
                                <a href="create" class="btn btn-info">Bắt đầu chat</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-0 mb-0">
                    </div>
                    <div class="col-lg-8 col-md-12 mb-12">
                    <h1 style="font-size: 1em;"">Hãy tố cáo nếu như người lạ có hành vi không đúng</h1>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    @endif
    <!-- Footer -->
    @include('layouts.footer')
    <!-- End Footer -->
</body>



</html>
