
@if(session()->has('notice'))
    <script>
        alert("{{ session('notice') }}");
    </script>
@endif

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Ask | Đăng nhập</title>
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

.rq {
	color: red;
}
</style>
<link
	href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css'
	rel='stylesheet'>
<link href='' rel='stylesheet'>
<style>
@import
	url(https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap)
	;

body {
	background: #f5f5f5;
}

@media only screen and (max-width: 767px) {
	.hide-on-mobile {
		display: none;
	}
}

.login-box {
	background: url(https://i.imgur.com/73BxBuI.png);
	background-size: cover;
	background-position: center;
	padding: 50px;
	margin: 50px auto;
	min-height: 700px;
	-webkit-box-shadow: 0 2px 60px -5px rgba(0, 0, 0, 0.1);
	box-shadow: 0 2px 60px -5px rgba(0, 0, 0, 0.1);
}

.logo {
	font-family: "Script MT";
	font-size: 54px;
	text-align: center;
	color: #888888;
	margin-bottom: 50px;
}

.logo .logo-font {
	color: #3BC3FF;
}

@media only screen and (max-width: 767px) {
	.logo {
		font-size: 34px;
	}
}

.header-title {
	text-align: center;
	margin-bottom: 50px;
}

.login-form {
	max-width: 300px;
	margin: 0 auto;
}

.login-form .form-control {
	border-radius: 0;
	margin-bottom: 30px;
}

.login-form .form-group {
	position: relative;
}

.login-form .form-group .forgot-password {
	position: absolute;
	top: 6px;
	right: 15px;
}

.login-form .btn {
	border-radius: 0;
	-webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	margin-bottom: 30px;
}

.login-form .btn.btn-primary {
	background: #3BC3FF;
	border-color: #31c0ff;
}

.slider-feature-card {
	background: #fff;
	max-width: 280px;
	margin: 0 auto;
	padding: 30px;
	text-align: center;
	-webkit-box-shadow: 0 2px 25px -3px rgba(0, 0, 0, 0.1);
	box-shadow: 0 2px 25px -3px rgba(0, 0, 0, 0.1);
}

.slider-feature-card img {
	height: 80px;
	margin-top: 30px;
	margin-bottom: 30px;
}

.slider-feature-card h3, .slider-feature-card p {
	margin-bottom: 30px;
}

.carousel-indicators {
	bottom: -50px;
}

.carousel-indicators li {
	cursor: pointer;
}
</style>
<script type='text/javascript' src=''></script>
<script type='text/javascript'
	src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript'
	src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
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
<body oncontextmenu='return false' class='snippet-body'>
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

	<section class="body">
		<div class="container">
			<div class="login-box">
				<div class="row">
					<div class="col-sm-6">
						<div class="logo">
							<a href="/"><span>askmeprivate</span></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<br>
						<h3 class="header-title">Quên mật khẩu</h3>
						
						<form action="/forgetcheck" class="login-form" method="post"
							id="login_form" >
							@csrf
                            
							<div class="form-group">
								<label for="username" class="form-label">Nhập tên đăng nhập<span
                                    class="rq">*</span></label> <input type="text" class="form-control"
                                    id="username" name="username"  required>
							</div>
							<div id="emailHelp" class="form-text">Hệ thống sẽ gửi mật khẩu về email mà bạn đã đăng kí</div>
							<div class="form-group">
								<button type="submit" value="Submit" name="submit" class="btn btn-primary btn-block"
									>Xác nhận</button>
							</div>
							<div class="form-group">
								<div class="text-center">
									<a href="login">Quay trở lại đăng nhập</a>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-6 hide-on-mobile">
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type='text/javascript'></script>
</body>
</html>