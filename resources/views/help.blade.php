
<!DOCTYPE html>
<html lang="vi">

<head>
<meta charset="UTF-8">
<title>Ask | Trợ giúp</title>
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
<link rel="stylesheet" type="text/css"
	href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css" />
<link href="https://miraweb.tenten.vn/tem3/css/mira-vanchuyen001.css"
	rel="stylesheet">
<style>
   .scrollable-content {
      max-height: 100vh; /* Đặt chiều cao tối đa là chiều cao của màn hình */
      overflow-y: auto;  /* Chỉ hiển thị thanh cuộn theo chiều dọc khi cần thiết */
	scroll-behavior: smooth;
	
   }
   html {
  scroll-behavior: auto;
}
</style>

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
</head>
<body>
	<!-- Nav bar -->
	@include('layouts.navbar')
	<!-- End Navbar -->
	<!-- Page content -->
	<div class="row">
		<div class="col-4">
		  <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
			<nav class="nav nav-pills flex-column">
			  <a class="nav-link" href="#item-1">Hỏi và trả lời</a>
			  <nav class="nav nav-pills flex-column">
				<a class="nav-link ms-3 my-1" href="#item-1-1">Đặt câu hỏi</a>
				<a class="nav-link ms-3 my-1" href="#item-1-2">Trả lời câu hỏi</a>
			  </nav>
			  <a class="nav-link" href="#item-3">Cài đặt tài khoản</a>
			</nav>
		  </nav>
		</div>
	  
		<div class="col-8 scrollable-content">
		  <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
			<div id="item-1">
			  <h4>Hỏi và trả lời</h4>
			</div>
			<div id="item-1-1">
			    <h5>Đặt câu hỏi</h5>
                
                <p>Ấn vào dấu 3 gạch để hiện thị thanh chức năng</p>
                <div style="text-align: center;">
    				<img src="1.jpg" style="width: 30%;" alt="help_image">
				</div>
			    <p>Để có thẻ gửi câu hỏi, hãy tìm kiếm tên người dùng của họ trong ô tìm kiếm</p>
                <div style="text-align: center;">
    				<img src="3.jpg" style="width: 30%;" alt="help_image">
				</div>
				<p> Bạn không cần đăng nhập để thực hiện đặt câu hỏi
                <p> Ngoài ra, bạn có thể nhấn vào đường liên kết mà họ đã chia sẻ với bạn bè trên mạng xã hội</p>
				<p> Sau khi ấn tìm, giao diện của người dùng sẽ hiện ra, bạn có thể gửi câu hỏi cũng như xem các câu hỏi trước đó tại đây</p>
                <div style="text-align: center;">
    				<img src="2.jpg" style="width: 30%;" alt="help_image">
				</div>
				<p> Bạn cũng có thể đặt câu hỏi ẩn danh cho người lạ, thông qua mục <a href="alluser">khám phá</a> trong thanh chức năng</p>                     
			</div>
			<div id="item-1-2">
			  <h5>Trả lời câu hỏi</h5>
			  <p>Trước hết, bạn cần phải đăng nhập để trả lời những câu hỏi mà mọi người hỏi bạn</p>
                <p>Ấn vào dấu 3 gạch để hiện thị thanh chức năng, sau đó ấn vào đăng nhập</p>
                <div style="text-align: center;">
    				<img src="1.jpg" style="width: 30%;" alt="help_image">
				</div>
				<br>
				<div style="text-align: center;">
    				<img src="4.jpg" style="width: 30%;" alt="help_image">
				</div>
	            <p>Nếu bạn là người dùng mới, bạn có thể đăng ký để tạo trang hỏi đáp của riêng mình tại <a href="register">Đăng ký</a></p>
              <p>Sau khi đã đăng nhập xong, bạn sẽ thấy một dòng xin chào tại thanh chức năng, hãy ấn vào nó và chọn "câu hỏi của tôi"</p>
				<div style="text-align: center;">
					<img src="5.jpg" style="width: 30%;" alt="help_image">
				</div><p>Tại đây bạn sẽ thấy những câu hỏi mà người dùng hỏi bạn, bạn có thể trả lời/sửa câu trả lời ban đầu/xóa câu hỏi/xóa câu trả lời tại đây thông qua id câu hỏi</p>
				<div style="text-align: center;">
    				<img src="6.jpg" style="width: 30%;" alt="help_image">
				</div>
				<div style="text-align: center;">
    				<img src="7.jpg" style="width: 30%;" alt="help_image">
				</div>

			</div>
			
			<div id="item-3">
			  <h4>Cài đặt tài khoản</h4>
			  <p>Ấn vào xin chào trong thanh chức năng, bạn sẽ thấy danh sách được hiện ra, hây ấn vào hồ sơ</p>
              	<div style="text-align: center;">
    				<img src="5.jpg" style="width: 30%;" alt="help_image">
				</div><p>Bạn có thể dễ dàng thực hiện thay đổi thông tin cá nhân, ngoại trừ email và username bạn đã đăng ký</p>
			</div>
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					var scrollLinks = document.querySelectorAll('.nav-link');

					scrollLinks.forEach(function (scrollLink) {
						scrollLink.addEventListener('click', function (event) {
							// event.preventDefault();

							var targetId = this.getAttribute('href').substring(1);
							var targetElement = document.getElementById(targetId);

							if (targetElement) {
							targetElement.scrollIntoView({
								behavior: 'smooth',
							});
							}
						});
					});
				});
			</script>

		</div>
	</div>
	<!-- End Page content -->
	<!-- Footer -->
	@include('layouts.footer')
	<!-- End Footer -->
</body>

</html>