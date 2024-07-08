
<!DOCTYPE html>
<html lang="vi">

<head>
<meta charset="UTF-8">
<title>Ask me private | Hỏi đáp ẩn danh</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Ask, Private, Anonymous, Timemail, Chat, Cvnl, Chat với người lạ, Hỏi, Trả lời, Ẩn danh">
<meta name="description" content="Nền tảng độc đáo cho phép bạn đặt câu hỏi và trả lời, chat với người lạ một cách ấn danh.">
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

<link rel="stylesheet" type="text/css"
	href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css" />
<link href="https://miraweb.tenten.vn/tem3/css/mira-vanchuyen001.css"
	rel="stylesheet">
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
	<!-- Nav bar -->
	@include('layouts.navbar')
	<!-- End Navbar -->
	<!-- Page content -->
	<script>
		function welcome(){
			$(document).ready(function() {
				$.ajax({
					url: '/welcome',
					type: 'GET',
					dataType: 'json',
				});
			});
		}
	welcome();
	</script>
	<div class="mira_defauilt_detailds">
		<div>
			<header class="bg_full banner_tem section-banner "
				style="background-image: url('{{ asset('1.png')}}'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
				<div class="container">
					<div class="banner">
						<div class="txt_banner"></div>
					</div>
				</div>
			</header>
			<div class="body_content">
				<div id="arim_tide_etalpmet_derutea_about_us_tem"
					class="section2 section-about-us background_background_about_us "
					style="">
					<div class="container">
						<div class="list_about">
							<div class="mira_about">
								<div class="img_about image_about_us-tem">
									<img class="img_about image_about_us-tem"
										src=" https://images.unsplash.com/photo-1612347332984-2de6ec274b13?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w0Njg3ODl8MHwxfHJhbmRvbXx8fHx8fHx8fDE2ODk5NDAyNjV8&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080 "
										alt="main_image">
								</div>
								<div class="txt_about">
									<h1 class="tit text-title-about_us title_about_us_tem" style="">Trang
										hỏi đáp bí mật</h1>
									<p
										class="text-description text-description-about_us description_about_us_tem"
										style="">Tìm hiểu về một nền tảng độc đáo cho phép bạn đặt
										câu hỏi ẩn danh và câu trả lời sẽ được công khai hiển thị trên
										trang chủ của người được hỏi.</p>
									<button id="learnMoreButton" class="btn btn-outline-success"
										type="button">Tìm hiểu thêm</button>
									<script>
										var learnMoreButton = document
												.getElementById("learnMoreButton");

										learnMoreButton
												.addEventListener(
														"click",
														function() {
															window.location.href = "help";
														});
									</script>

								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="section5" id="arim_tide_etalpmet_deruteaf_tem">
					<div class="container">
						<div
							class="content_news section-features background_background_features "
							style="">
							<div class="list_news section-features-tem-tt">
								<div class="box_news">
									<div class="img_box_news image_1-tem">
										<img
											src="https://img2.storyblok.com/filters:format(webp)/f/84825/1200x630/27c8c6b42a/ask-2341784_1280.jpg"
											alt="image_ask">
									</div>
									<div class="txt_box_news">
										<h3 class="tit text-title text-title-feature1 title_f_tem_1"
											style="">Hỏi và trả lời</h3>
										<p
											class="text-description text-description-feature1 description_f_tem_1"
											style="">Thỏa sức hỏi đáp và chia sẻ kiến thức dưới dạng
											ẩn danh</p>
									</div>
								</div>
								<div class="box_news">
									<div class="img_box_news image_2-tem">
										<img
											src="https://pics.craiyon.com/2023-07-05/87e4edbc60234874b9cecf587f9f2dfb.webp"
											alt="image_question">
									</div>
									<div class="txt_box_news">
										<h3 class="tit text-title text-title-feature2 title_f_tem_2"
											style="">Hỏi lung tung, trả lời giấu tên</h3>
										<p
											class="text-description text-description-feature2 description_f_tem_2"
											style="">Hãy chung tay giải đáp mọi thắc mắc và câu hỏi
											của bạn sẽ công khai trên trang chủ. Nói là công khai nhưng
											sẽ không ai biết bạn hỏi đâu ;)</p>
									</div>
								</div>
								<div class="box_news">
									<div class="img_box_news image_3-tem">
										<img
											src="https://media.istockphoto.com/id/505172994/it/foto/piccolo-ragazzo-e-ragazza-trasmette-unidea.jpg?s=612x612&w=0&k=20&c=dEIVDvycBtz9Redlwcu8ZKhje9ACIyZQDJhSNIccEP4="
											alt="image_askmeprivate">
									</div>
									<div class="txt_box_news">
										<h3 class="tit text-title text-title-feature3 title_f_tem_3"
											style="">Tại sao chọn askmeprivate?</h3>
										<p
											class="text-description text-description-feature3 description_f_tem_3"
											style="">Bí quyết hỏi đáp là sự lựa chọn hoàn hảo vì
											chúng Tôi cung cấp dịch vụ chất lượng, đội ngũ giàu kinh
											nghiệm và cam kết với bảo mật thông tin của bạn. Hãy cùng
											trải nghiệm sự khác biệt với chúng tôi ngày hôm nay!</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End Page content -->
	<!-- Footer -->
	@include('layouts.footer')
	<!-- End Footer -->
</body>

</html>