
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Ask | Đăng ký</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Askmeprivate | Đăng kí tài khoản đặt câu hỏi, trò chuyện trực tuyến một cách ấn danh.">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.rq {
	color: red;
}
</style>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script>
	function my_register(event) {
		event.preventDefault(); // Ngăn chặn hành vi mặc định của nút Submit

		re_password = document.getElementById("re_password").value;
		password = document.getElementById("password").value;
		errorMessage = document.getElementById("error_message");

		if (password === re_password) {
			var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[%$#@!^&*])[A-Za-z\d%$#@!^&*]{8,}$/;
			username = document.getElementById("username").value;
			usernamePattern = /^[a-zA-Z0-9]{5,17}$/;;

			if (!usernamePattern.test(username)) {
				errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
				errorusername.style.display = "inline"; // Hiển thị thông báo tên đăng nhập không hợp lệ
				return false; // Ngăn chặn việc gửi form đi khi tên đăng nhập không hợp lệ
			} else {
				errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
				errorusername.style.display = "none"; // Ẩn thông báo tên đăng nhập không hợp lệ nếu đã nhập đúng
				if (!passwordPattern.test(password)) {
					errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
					passwordErrorMessage.style.display = "inline"; // Hiển thị thông báo mật khẩu không hợp lệ
					return false; // Ngăn chặn việc gửi form đi khi mật khẩu không hợp lệ
				}else{
					errorMessage.style.display = "none"; // Ẩn thông báo nếu nhập đúng
					login_form = document.getElementById("login_form");
					login_form.submit();
				}
			}
		} else {
			errorMessage.style.display = "inline";
			passwordErrorMessage.style.display = "none";// Hiển thị thông báo
			return false; // Ngăn chặn việc gửi form đi khi nhập không đúng mật khẩu
		}
	}
	// function logout() {
	// 	window.location.href = "logout.php";
	// }
	function login() {
		window.location.href = "login";
	}
</script>
	@php
	$username = session('username');
	@endphp
	@if ($username != null)
	
	<!-- Display window alert and redirect to homepage when OK is clicked -->
	<script>
		// Function to display window alert
		function showWindowAlert() {
			window.alert("Bạn đã đăng nhập rồi");
		}

		// Function to redirect to homepage
		function redirectToHomePage() {
			window.location.href = "/";
		}

		// Call the functions when the page is loaded
		window.onload = function() {
			showWindowAlert();
			redirectToHomePage();
		}
	</script>
	@endif
</head>
<body>
	<!-- Nav bar -->
	@include('layouts.navbar')
	<!-- End Navbar -->
	
	<div class="container" style="width: 50%; margin: 0 auto; padding: 20px;">
		<h1 style="text-align: center;"">Đăng kí</h1>
		<form action="/registercheck" method="post" id="login_form" onsubmit="return my_register(event);">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập<span class="rq">*</span></label> <input
                    type="text" class="form-control" id="username" name="username" value="{{ $username1 ?? '' }}"
                    required>
                <div id="usernamelHelp" class="form-text">Tên đăng nhập phải
                    có độ dài từ 5-17 kí tự (không được có dấu cách và không dấu)</div>
                <span id="errorusername" style="color: red; display: none;">Tên đăng nhập phải
                    có độ dài từ 5-17 kí tự và không được có dấu cách và không dấu<br>
                </span>
                @php
                    $check = $error ?? '';
                @endphp
                @if ($check === 'Tên người đùng đã tồn tại.')
                    <div style="color: red">Tên người đùng đã tồn tại.</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email<span class="rq">*</span></label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                        name="email" value="{{ $email1 ?? '' }}" required>
                    <button class="btn btn-outline-secondary" id="submitButton" type="button">Nhận mã</button>
                </div>
                <div id="emailHelp" class="form-text">Email dùng để nhận thông báo khi có câu hỏi và thay đổi
                    mật khẩu</div>
                <div id="emailHelp" class="form-text">Email của bạn sẽ không
                    được công khai</div>
                @php
                    $check2 = $error ?? '';
                @endphp
                @if ($check2 === 'Email đã tồn tại.')
                    <div style="color: red">Email đã tồn tại.</div>
				@elseif ($check2 === 'Vui lòng ấn vào gửi mã xác thực trước')
                    <div style="color: red">Vui lòng ấn vào gửi mã xác thực trước</div>
				@endif
            </div>
			<script>
				$(document).ready(function(){
					$('#submitButton').click(function(){
						var emailValue = $('#email').val(); // Lấy giá trị của trường nhập email
						// Thực hiện Ajax request
						$.ajax({
							type: 'GET',
							url: '/checkemail', // Đường dẫn tới script xử lý dữ liệu ở phía máy chủ
							data: {
								email: emailValue // Dữ liệu cần gửi, trong trường hợp này là giá trị email
							},
							success: function(response) {
								window.alert('Đã gửi mã xác thực, vui lòng kiểm tra email (có thể trong thư mục spam)');
								console.log(response);
								// Xử lý kết quả trả về từ server nếu cần
								
							},
							error: function(xhr, status, error) {
								// Xử lý lỗi nếu có
								console.error(error);
							}
						});
					});
				});
			</script>
            <div class="mb-3">
                <label for="captcha" class="form-label">Mã xác thực Email<span class="rq">*</span></label>
                <input type="text" class="form-control" id="captcha" aria-describedby="emailHelp" name="captcha"
                    placeholder="6 chữ số của mã xác thực" required>
                <div id="emailHelp" class="form-text">Vui lòng ấn vào gửi mã, và lấy mã trong email (có thể kiểm
                    tra thư mục thư rác)</div>
				@php
                    $check = $error ?? '';
                @endphp
                @if ($check === 'Mã xác thực không đúng')
                    <div style="color: red">Mã xác thực không đúng</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu<span class="rq">*</span></label> <input
                    type="password" class="form-control" id="password" name="password" required>
                <div id="passwordHelp" class="form-text">Mật khẩu phải có ít
                    nhất 8 kí tự, 1 chữ viết hoa, 1 chữ số và 1 kí hiệu đặc biệt
                    (%,$,@,#,..)</div>
            </div>
            <div class="mb-3">
                <label for="re_password" class="form-label">Nhập lại mật
                    khẩu<span class="rq">*</span>
                </label> <input type="password" class="form-control" id="re_password" required>
            </div>
            <span id="error_message" style="color: red; display: none;">Bạn
                phải nhập lại đúng mật khẩu<br>
            </span>
            <span id="passwordErrorMessage" style="color: red; display: none;">Mật khẩu phải có ít
                nhất 8 kí tự, 1 chữ viết hoa, 1 chữ số và 1 kí hiệu đặc biệt
                (%,$,@,#,..)<br>
            </span>
            <button type="submit" class="btn btn-primary" onclick="my_register()">Đăng
                ký</button>
        </form>
	</div>
	<!-- Footer -->
	@include ('layouts/footer')
	<!-- End Footer -->
</body>
</html>