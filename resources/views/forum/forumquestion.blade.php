<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        .scrollable-content {
            max-height: 100vh;
            /* Đặt chiều cao tối đa là chiều cao của màn hình */
            overflow-y: auto;
            /* Chỉ hiển thị thanh cuộn theo chiều dọc khi cần thiết */
        }
    </style>

    <style>
        td.breakline {
            word-break: break-word;
        }
    </style>
    <script>
        function logout() {
            window.location.href = "../logout";
        }
        function addquestionforum() {
            window.location.href = "/addquestionforum";
        }
        function login() {
            window.location.href = "../login";
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
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .post-container {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .post {
            display: flex;
            justify-content: space-between;
            overflow: hidden;
        }

        .post-left {
            width: 70%;
            /* Điều chỉnh độ rộng theo ý muốn */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
        }

        .post-left-left {
            width: 70%;
            /* Điều chỉnh độ rộng theo ý muốn */
        }

        .post-right {
            width: 30%;
            /* Điều chỉnh độ rộng theo ý muốn */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            flex: 1;
        }

        .post-left a,
        .post-right a {
            text-decoration: none;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .post-right button {
            margin-top: 10px;
        }

        /* Add more styles as needed */
    </style>
    <title>Ask | {{ $title }}</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="page-wrapper">
        <!-- Nav bar -->
        @include('layouts.navbar')
        <!-- End Navbar -->
        <script>
            function welcome() {
                $(document).ready(function() {
                    $.ajax({
                        url: '/welcome',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {

                            // Xử lý dữ liệu ở đây
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                });
            }
            welcome();
        </script>
        <!-- Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-6">
                    <h2>Diễn đàn {{ $newid }}</a></h2>
                </div>
                <div class="col-lg-4 col-md-6 col-6">
                    <button style="float: right;"class="btn btn-outline-warning" type="button" onclick=addquestionforum()>Đăng bài</button>
                </div>
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="post-container">
                        <h2>{{ $question->title }}</h2>
                        <div class="post">
                            <div class="post-left-left">
                                <p>{{ $question->question_content }}</p>
                                <small class="text-muted">Vào lúc: <span
                                        class="timestamp">{{ $question->timestamp }}</span></small>
                            </div>
                            <div class="post-right">
                                <p>Reps: <span class="comments">{{ $question->reps }}</span></p>
                            </div>
                        </div>
                        <form action="/addanswerforum" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$question->id}}">
                            <textarea id="messageInput" rows="6" style="width: 100%;" name="answer" placeholder="Nhập câu trả lời ở đây"
                                required="required"></textarea>
                            @if (session('notice'))
                                @if(session('notice')=='Câu trả lời không hợp lệ, trỗng rỗng...')
                                    <!-- Hiển thị thông báo với màu sắc phù hợp -->
                                    <div class="alert alert-danger">
                                        {{ session('notice') }}
                                    </div>
                                @else
                                    <!-- Hiển thị thông báo với màu sắc phù hợp -->
                                    <div class="alert alert-success">
                                        {{ session('notice') }}
                                    </div>
                                @endif
                            @endif
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="btn btn-info">Trả lời</button>
                                <button style="float: right;" type="button" class="btn btn-danger">Report</button>
                            </div>
                        </form>
                    </div>
                    @php
                        $answers = \App\Models\ForumAnswer::where('question_id', $question->id)->get();
                    @endphp
                    @if ($answers->count() > 0)
                        <div style="overflow: auto; padding: 5px; height: 800px;">
                        @foreach ($answers as $answer)
                            <div class="post-container">
                                <small class="text-muted">Vào lúc: <span
                                        class="timestamp">{{ $answer->timestamp }}</span></small>
                                <p>{{ $answer->answer_content }}</p>
                                <div>
                                    <button type="button" class="btn btn-danger">Report</button>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <div class="post-container">
                            <p>Có vẻ bạn là người đầu tiên tới đây</p>
                            <small class="text-muted">Hãy trở thành người đầu tiên trả lời nữa nhé ^^</small>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="post-container">
                        <h2>Bài đăng khác</h2>
                        @php
                            $n = 4;
                            if($popularquestion->count()<4){
                                $n = $popularquestion->count();
                            }
                        @endphp
                        @for ($i = 0; $i < $n; $i++)
                            <div class="post">
                                <div class="post-left">
                                    <p><a
                                            href="/forum/{{ $title }}/{{ $popularquestion[$i]->id }}">{{ $popularquestion[$i]->title }}</a>
                                    </p>
                                    <small class="text-muted">Vào lúc: <span
                                            class="timestamp">{{ $popularquestion[$i]->timestamp }}</span></small>
                                </div>
                                <div class="post-right">
                                    <p>Reps: <span class="comments">{{ $popularquestion[$i]->reps }}</span></p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
        <!-- Footer -->
        @include('layouts.footer')
        <!-- End Footer -->
    </div>
</body>

</html>
