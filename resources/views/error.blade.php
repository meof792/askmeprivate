<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lỗi rùi</title>
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
<link rel="stylesheet" type="text/css"
	href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css" />
<link href="https://miraweb.tenten.vn/tem3/css/mira-vanchuyen001.css"
	rel="stylesheet">
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
        0%, 100% {
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
</head>
<body>
@include('layouts.navbar')

<div style="text-align: center; margin-top: 50px;">
    <h1>
        <span class="jumping-text">4</span>
        <span class="jumping-text">0</span>
        <span class="jumping-text">4</span>
    </h1>
    <p>Xin lỗi, trang bạn đang tìm kiếm không tồn tại.</p>
    <p>Vui lòng kiểm tra lại đường dẫn hoặc trở về trang chủ.</p>
</div>

<script>
    const jumpingTexts = document.querySelectorAll('.jumping-text');

    jumpingTexts.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.5}s`;
    });
</script>

@include('layouts.footer')

</body>
</html>