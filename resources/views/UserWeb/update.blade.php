@php
// Kiểm tra xem session 'username' đã tồn tại hay chưa
$username = session('username');
@endphp
@if (!session('username')) 
@php
    // Nếu session chưa được thiết lập, thực hiện điều hướng đến trang đăng nhập
    header("Location: /login"); // Update the URL to your login page URL
    exit; // Đảm bảo dừng việc xử lý trang hiện tại sau khi điều hướng
@endphp
@endif
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon"
	href="https://scontent.fhan2-4.fna.fbcdn.net/v/t1.15752-9/363102452_666214241646879_2538633744490536440_n.png?_nc_cat=100&cb=99be929b-3346023f&ccb=1-7&_nc_sid=ae9488&_nc_ohc=UmNIRjD7RG4AX-gBgzJ&_nc_ht=scontent.fhan2-4.fna&oh=03_AdRFoWPYFIkPDtx1rq8AkxLludWFxB60zrFfxU5gRMuu1Q&oe=64E5B1D6">
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
	crossorigin="anonymous">
<script
	src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
	integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
	crossorigin="anonymous"></script>
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
	integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
	crossorigin="anonymous"></script>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
<style>
td.breakline {
	word-break: break-word;
}
</style>
<script>
	function logout() {
		window.location.href = "../logout";
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
    function my_register(event) {
		event.preventDefault(); // Ngăn chặn hành vi mặc định của nút Submit

		re_password = document.getElementById("re_password").value;
		password = document.getElementById("password").value;
		errorMessage = document.getElementById("error_message");

		if (password === re_password) {
			var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[%$#@!^&*])[A-Za-z\d%$#@!^&*]{8,}$/;
			
			if (!passwordPattern.test(password)) {
				errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
				passwordErrorMessage.style.display = "inline"; // Hiển thị thông báo mật khẩu không hợp lệ
				return false; // Ngăn chặn việc gửi form đi khi mật khẩu không hợp lệ
			}else{
				errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
				login_form = document.getElementById("login_form");
				login_form.submit();
			}
		} else {
			errorMessage.style.display = "inline";
			invalid.style.display = "none";// Hiển thị thông báo
			return false; // Ngăn chặn việc gửi form đi khi nhập không đúng mật khẩu
		}
	}
</script>
<style>
    .rq {
        color: red;
    }
/* Các phần CSS hiện có */

/* Thêm CSS cho Flexbox */
body {
	display: flex;
	flex-direction: column;
	min-height: 100vh;
}

.page-wrapper {
	flex-grow: 1;
}

footer {
	flex-shrink: 0;
}
</style>

<title>Ask | Thông tin</title>
</head>
<body>
	<div class="page-wrapper">
		<!-- Nav bar -->
		@include('layouts.navbar')
		<!-- End Navbar -->
		<div class="container">
			<div class="row">
                @php
                $userweb = \App\Models\UserWeb::where("username", $username)->first();
                @endphp
				<div class="col-lg-4 col-md-12 mb-12">
					<div class="card" style="width: 18rem; margin: 0 auto 20px;">
						<div class="card-body">
							<div class="card">
								@if($userweb->username==='Bùi Quang Minh')
								<img src="{{ asset('minh.png')}}" class="card-img-top"
									alt="...">
								@else
								<img src="{{ asset('unknown.jpg')}}" class="card-img-top"
									alt="...">
								@endif
								<div class="card-body">
									<h5 class="card-title" style="text-align: center;">{{$userweb->username}}
									</h5>
								</div>
							</div>
							<table class="table">
                                <tr>
									<th>Email:</th>
									<td class="breakline">{{$userweb->email}}</td>
								</tr>
								<tr>
									<th>Biệt danh:</th>
									<td class="breakline">{{$userweb->nickname}}</td>
								</tr>
								<tr>
									<th>Mô tả:</th>
									<td class="breakline"></td>
								</tr>
								<tr>
                                    <td class="breakline" colspan="2">{{$userweb->description}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12 mb-12" style="margin: 0 auto 20px;">
					<div class="container">
                        <h1>Cập nhật thông tin:</h1>
                        <form action="/updatenickname" method="post">
                            @csrf
                            <h3>Thay đổi biệt danh:</h3>
                            <div class="mb-3">
                                <label for="nickname" class="form-label">Biệt danh<span class="rq">*</span>
                                </label> <input type="text" class="form-control" id="nickname" name="nickname"
                                    required value="{{$userweb->nickname}}" placeholder="{{$userweb->nickname}}">
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Nhập mật khẩu để xác nhận<span class="rq">*</span>
                                </label> <input type="password" class="form-control" id="pass" name="pass"
                                    required>
                            </div>
                            <!-- Kiểm tra xem có thông báo trong session không -->
                            @if (session('alert'))
                                @php
                                    $alertClass = session('alert') === 'Mật khẩu không đúng.' ? 'alert-danger' : 'alert-success';
                                @endphp

                                <!-- Hiển thị thông báo với màu sắc phù hợp -->
                                <div class="alert {{ $alertClass }}">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                        <form action="/updatedescription" method="post">
                            @csrf
                            <h3>Thay đổi mô tả:</h3>
                            <div>Mô tả<span class="rq">*</span></div>
                            <textarea id="description" rows="5" style="width: 100%;"
                            name="description" placeholder="{{$userweb->description}}" required="required">{{$userweb->description}}</textarea>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Nhập mật khẩu để xác nhận<span class="rq">*</span>
                                </label> <input type="password" class="form-control" id="pass" name="pass"
                                    required>
                            </div>
                            <!-- Kiểm tra xem có thông báo trong session không -->
                            @if (session('alert1'))
                                @php
                                    $alertClass = session('alert1') === 'Mật khẩu không đúng.' ? 'alert-danger' : 'alert-success';
                                @endphp

                                <!-- Hiển thị thông báo với màu sắc phù hợp -->
                                <div class="alert {{ $alertClass }}">
                                    {{ session('alert1') }}
                                </div>
                            @endif
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                        <form action="/updatepassword" method="post" id="login_form"
                        onsubmit="return my_register(event);">
                        @csrf
                        <h3>Thay đổi mật khẩu:</h3>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Mật khẩu hiện tại<span class="rq">*</span>
                            </label> <input type="password" class="form-control" id="pass" name="pass"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới<span
                                class="rq">*</span></label> <input type="password" class="form-control"
                                id="password" name="password" required>
                            <div id="passwordHelp" class="form-text">Mật khẩu phải có ít
                                nhất 8 kí tự, 1 chữ viết hoa, 1 chữ số và 1 kí hiệu đặc biệt
                                (%,$,@,#,..)</div>
                        </div>
                        <div class="mb-3">
                            <label for="re_password" class="form-label">Nhập lại mật
                                khẩu<span class="rq">*</span>
                            </label> <input type="password" class="form-control" id="re_password"
                                required>
                                <div id="passwordHelp" class="form-text">Sau khi thay đổi mật khẩu thành công, tài khoản của bạn sẽ tự động đăng xuất</div>
                        </div>
                        <span id="error_message" style="color: red; display: none;">Bạn
                            phải nhập lại đúng mật khẩu<br>
                        </span>
                        <span id="passwordErrorMessage" style="color: red; display: none;">Mật khẩu phải có ít
                            nhất 8 kí tự, 1 chữ viết hoa, 1 chữ số và 1 kí hiệu đặc biệt
                            (%,$,@,#,..)<br>
                        </span>
                        @if (session('alert2'))
                            @php
                                $alertClass = session('alert1') === 'Mật khẩu không đúng.' ? 'alert-danger' : 'alert-success';
                            @endphp

                            <!-- Hiển thị thông báo với màu sắc phù hợp -->
                            <div class="alert {{ $alertClass }}">
                                {{ session('alert2') }}
                            </div>
                        @endif
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="btn btn-primary" onclick="my_register()">Cập nhật</button>
                        </div>
                        </form>
                    </div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		@include('layouts.footer')
		<!-- End Footer -->
	</div>
</body>
</html>