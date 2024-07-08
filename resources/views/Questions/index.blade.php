
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Askmeprivate | {{$userweb->username}} - {{$question->count()}} câu hỏi">
<meta name="keywords" content="Ask, Private, Anonymous, Timemail, Chat, Cvnl, Chat với người lạ">
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
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<style>
   .scrollable-content {
      max-height: 100vh; /* Đặt chiều cao tối đa là chiều cao của màn hình */
      overflow-y: auto;  /* Chỉ hiển thị thanh cuộn theo chiều dọc khi cần thiết */
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

<title>Ask | {{$title}}</title>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
	<div class="page-wrapper">
		<!-- Nav bar -->
		@include('layouts.navbar')
		<!-- End Navbar -->
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
		<div class="container" style = "margin-top: 10px">
			<div class="row">
				<div class="col-lg-4 col-md-12 mb-12">
					<div class="card" style="width: 18rem; margin: 0 auto 20px;">
						<div class="card-body">
							@if($userweb->username=="Bùi Quang Minh")
							<div class="card">
								<img src="{{ asset('minh.png')}}" class="card-img-top"
									alt="...">
								<div class="card-body">
									<h5 class="card-title" style="text-align: center;">{{$userweb->username}}
									</h5>
									<i style="text-align: center;">người duy nhất có avatar</i>
								</div>
							</div>
							@else
							<div class="card">
								<img src="{{ asset('unknown.jpg')}}" class="card-img-top"
									alt="...">
								<div class="card-body">
									<h5 class="card-title" style="text-align: center;">{{$userweb->username}}
									</h5>
								</div>
							</div>
							@endif
							<table class="table">
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
				<div class="col-lg-8 col-md-12 mb-12 " >
					<div>
						<h3>
							Hỏi {{$userweb->username}} gì đó:
						</h3>
						<form action="/addquestion" method="post">
							@csrf
							<input type="hidden" name="username" value="{{$userweb->username}}">
							<textarea id="messageInput" rows="6" style="width: 100%;"
								name="question" placeholder="Nói gì đó với {{$userweb->username}}"
								required="required"></textarea>
							@if (session('notice'))
								@if(session('notice') == "Câu hỏi không hợp lệ, trống rỗng,...")
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
								<button type="submit">Gửi</button>
							</div>
						</form>
					</div>
						<h3>
							Câu hỏi của {{$userweb->username}}:
						</h3>
					<div class="container scrollable-content" style="margin: 0 auto 20px; height: 320px">
						@php
						$reversedQuestions = $question->reverse();
						@endphp
						@if($reversedQuestions->isEmpty())
							<ul class="list-group media-list media-list-stream">
								<li id="Message32496133" class="media list-group-item p-a"
									style="">
									<div class="media-body">
										<span style="">{{$userweb->username}} chưa có câu hỏi nào :<</span> <br> <small
											class="text-muted">Hãy là người đầu tiên hỏi {{$userweb->username}} :></small>
										<div class="clearfix"></div>
									</div>
								</li>
							</ul>
						@endif
						@foreach ($reversedQuestions as $ques)
						@php
						// use App\Models\Answer;
						$answer = \App\Models\Answer::where("question_id", $ques->question_id)->get();
									
						@endphp
						@if ($answer->count() > 0)
						<div class="container">
							<div class="panel panel-default panel-profile m-b-md text-rights">
								<ul class="list-group media-list media-list-stream">
									<li id="Message32496133" class="media list-group-item p-a"
										style="">
										<div class="media-body">
											<span style="">{{$ques->question_content}}</span> <br> <small
												class="text-muted">{{$ques->timestamp}} </small>
											<div class="clearfix"></div>
										</div>
									</li>
									<ul>
										@foreach ($answer as $answers)
										<li id="Li1" class="media list-group-item p-a"
											style="border: 2px solid #03a9f459;">
											<div class="media-body">
												<span>{{$userweb->username}} đã trả lời: {{$answers->answer_content}}</span> <br> <small class="text-muted">{{$answers->timestamp}}</small>
												<div class="clearfix"></div>
											</div>
										</li>
										@endforeach
									</ul>
								</ul>
							</div>
						</div>
						@else
						<div class="container">
							<div class="panel panel-default panel-profile m-b-md text-rights">
								<ul class="list-group media-list media-list-stream">
									<li id="Message32496133" class="media list-group-item p-a"
										style="">
										<div class="media-body">
											<span style="">Câu hỏi này sẽ xuất hiện khi {{$userweb->username}} trả lời</span> <br> <small
												class="text-muted">{{$ques->timestamp}} </small>
											<div class="clearfix"></div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						@endif
						@endforeach
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