<!DOCTYPE html>
<html lang="vi">

@if(session()->has('notice'))
    <script>
        alert("{{ session('notice') }}");
    </script>
@endif
<head>
    <meta charset="UTF-8">
    <title>Ask | Thư thời gian</title>
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

</head>

<body>
    <!-- Nav bar -->
    @include('layouts.navbar')
    <!-- End Navbar -->

    <div class="container" style="width: 50%; margin: 0 auto; padding: 20px;">
        <h1>Thư thời gian</h1>
        <form action="/addtimemail" method="post" id="login_form">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Email người nhận<span class="rq">*</span></label> <input
                    type="email" class="form-control" id="username" name="username" value="{{ $username1 ?? '' }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">Tên người gửi<span class="rq">*</span></label> <input
                    type="text" class="form-control" id="nickname" name="nickname" value="{{ $nickname1 ?? '' }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Tiêu đề thư<span class="rq">*</span></label> <input
                    type="text" class="form-control" id="subject" name="subject" value="{{ $subject ?? '' }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung thư<span class="rq">*</span><input type="hidden" name="content" value="content">
                    <textarea id="content" rows="10" style="width: 100%;"
                        name="content" placeholder="Nội dung thư"
                        required="required"></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Thời gian gửi thư<span class="rq">*</span></label>
                <br>
                <?php
                // Tính toán ngày mai
                $date = date('Y-m-d', strtotime('+2 day'));
                ?>
                <input type="datetime-local" id="date" name="date" style="font-size: 150%"placeholder="Chọn thời gian" required
                    min="<?php echo $date; ?>T00:00">
            </div>
            <button type="submit" class="btn btn-primary" onclick="my_register()">Đăng
                ký</button>
        </form>
    </div>
    <!-- Footer -->
    @include ('layouts/footer')
    <!-- End Footer -->
</body>

</html>
