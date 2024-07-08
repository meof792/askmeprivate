<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ask | Diễn đàn</title>
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
    <style>
        .rq {
            color: red;
        }
    </style>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script>
        function my_submit(event) {
            event.preventDefault();
            var titleValue = document.getElementById('title').value
            var regex = /^.{1,50}$/;

            // Kiểm tra xem tiêu đề có đúng định dạng không
            if (!regex.test(titleValue)) {
                document.getElementById('errortitle').style.display = 'inline';
                return false;
            } else {
                login_form.submit();
            }
        }
        // function logout() {
        // 	window.location.href = "logout.php";
        // }
        function login() {
            window.location.href = "login";
        }
    </script>
</head>

<body>
    <!-- Nav bar -->
    @include('layouts.navbar')
    <!-- End Navbar -->

    <div class="container">
        <h1>Đăng câu hỏi lên diễn đàn</h1>
        <form action="/questionforumcheck" method="post" id="login_form" onsubmit="return my_submit(event);">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề<span class="rq">*</span></label> <input
                    type="text" class="form-control" id="title" name="title" required>
                <div id="usernamelHelp" class="form-text">Tên đăng nhập phải
                    có độ dài dưới 50 kí tự</div>
                <span id="errortitle" style="color: red; display: none;">Tên đăng nhập phải
                    có độ dài dưới 50 kí tự<br>
                </span>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Thể loại<span class="rq">*</span></label>
                <select class="form-select" id="type" name="type" required>
                    <option value="" disabled selected hidden>Chọn thể loại</option>
                    <option value="animal">Động vật</option>
                    <option value="life">Đời sống</option>
                    <option value="sport">Thể thao</option>
                    <option value="art">Nghệ thuật</option>
                    <option value="tech">Công nghệ</option>
                    <option value="food">Ẩm thực</option>
                    <option value="enjoy">Sở thích</option>
                    <option value="else">Chém gió</option>
                </select>

            </div>
            <div class="mb-3">
                <textarea id="question" rows="6" style="width: 100%;" name="question" placeholder="Nhập câu hỏi ở đây"
                    required="required"></textarea>
                <button type="submit" class="btn btn-primary" onclick="my_submit()">Xác nhận</button>
        </form>
    </div>
    <!-- Footer -->
    @include ('layouts/footer')
    <!-- End Footer -->
</body>

</html>
