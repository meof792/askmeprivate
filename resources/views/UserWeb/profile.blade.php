@php
// Kiểm tra xem session 'username' đã tồn tại hay chưa
$username = session('username');
@endphp

@if (!$username)
    <script>
        alert('Bạn cần đăng nhập để truy cập vào trang profile.');
        window.location.href = '/login';
    </script>
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
/* Đặt kiểu cho ô "description" */
td.breakline {
	word-break: break-word;
}
</style>
<script>
	
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

<title>Profile | {{$username}}</title>
</head>
<body>
	<!-- Nav bar -->
	@include('layouts.navbar')
	<!-- End Navbar -->
	<div class="container">
		<div class="row">

			<div class="col-lg-6 col-md-12 mb-12">
				<h3>Câu hỏi của bạn:</h3>
				@php
				$question = \App\Models\Question::where("username", $username)->get();
				$reversedQuestions = $question->reverse();
				$questionCount = count($reversedQuestions);
				$questionsPerPage = 3;
				$totalPages = ceil($questionCount / $questionsPerPage); // Tính tổng số trang
				$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại, mặc định là trang 1
				$startQuestionIndex = ($currentPage - 1) * $questionsPerPage;
				$endQuestionIndex = min($startQuestionIndex + $questionsPerPage, $questionCount);
				$numOfPagesToShow = 5; // Số trang hiển thị liên tiếp, ví dụ: 1 2 ...... 5 6
				@endphp
			
				@if($questionCount === 0)
					<ul class="list-group media-list media-list-stream">
						<li id="Message32496133" class="media list-group-item p-a" style="">
							<div class="media-body">
								<span style="">Bạn chưa có câu hỏi nào :<</span> <br>
								<small class="text-muted">Hãy chia sẻ liên kết cho bạn bè để nhận được những câu hỏi thú vị</small>
								<div class="clearfix"></div>
							</div>
						</li>
					</ul>
				@else
					@php
					$questionCounter = 0;
					@endphp
			
					@foreach($reversedQuestions as $ques)
						@php
						$questionCounter++;
						@endphp
			
						{{-- Kiểm tra nếu chưa đến câu hỏi của trang hiện tại thì bỏ qua --}}
						@if($questionCounter <= $startQuestionIndex)
							@continue
						@endif
			
						{{-- Kiểm tra nếu đã hiển thị đủ câu hỏi của trang hiện tại thì dừng vòng lặp --}}
						@if($questionCounter > $endQuestionIndex)
							@break
						@endif
			
						<div class="container">
							<div class="panel panel-default panel-profile m-b-md text-rights">
								<ul class="list-group media-list media-list-stream">
									<li id="Message32496133" class="media list-group-item p-a" style="">
										<div class="media-body">
											<span style="">Ai đó hỏi bạn: <b>{{$ques->question_content}} (Id question: {{$ques->question_id}})</b>
											</span> <br>
											<small class="text-muted">{{$ques->timestamp}}</small>
											<div class="clearfix"></div>
										</div>
									</li>
									@php
									$answer = \App\Models\Answer::where("question_id", $ques->question_id)->first();
									@endphp
									@if (isset($answer) && $answer->count() > 0)
										<ul>
											<li id="Li1" class="media list-group-item p-a" style="border: 2px solid #03a9f459;">
												<div class="media-body">
													<span>Bạn đã trả lời: <b>{{$answer->answer_content}}</b></span> <br>
													<small class="text-muted">{{$answer->timestamp}}</small>
													<div class="clearfix"></div>
												</div>
											</li>
										</ul>
									@else
										<ul>
											<li id="Li1" class="media list-group-item p-a" style="border: 2px solid #03a9f459;">
												<div class="media-body">
													<span>Bạn chưa trả lời câu hỏi này</span> <br>
													<small class="text-muted">Bạn có thể không trả lời hoặc xóa câu hỏi này nếu nó phản cảm</small>
													<div class="clearfix"></div>
												</div>
											</li>
										</ul>
									@endif
								</ul>
							</div>
						</div>
					@endforeach
			
					{{-- Hiển thị phân trang --}}
					<div class="container">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item @if($currentPage === 1) disabled @endif">
									<a class="page-link" href="?page=1">1</a>
								</li>
								@php
								$halfNumOfPagesToShow = ceil($numOfPagesToShow / 2);
								$startPage = max($currentPage - $halfNumOfPagesToShow, 2);
								$endPage = min($currentPage + $halfNumOfPagesToShow, $totalPages - 1);
								@endphp
								@if($startPage > 2)
									<li class="page-item">
										<span class="page-link">...</span>
									</li>
								@endif
								@for($i = $startPage; $i <= $endPage; $i++)
									<li class="page-item @if($i === $currentPage) active @endif">
										<a class="page-link" href="?page={{$i}}">{{$i}}</a>
									</li>
								@endfor
								@if($endPage < $totalPages - 1)
									<li class="page-item">
										<span class="page-link">...</span>
									</li>
								@endif
								<li class="page-item @if($currentPage === $totalPages) disabled @endif">
									<a class="page-link" href="?page={{$totalPages}}">{{$totalPages}}</a>
								</li>
							</ul>
						</nav>
					</div>
				@endif
			</div>
			<div class="col-lg-6 col-md-12 mb-12">
				<div>
					<form action="/answer" method="post">
                        @csrf
						<h3>Trả lời câu hỏi:</h3>
						<select class="form-select" aria-label="Default select example"
							name="selectedQuestion">
							<option selected value="Chọn câu hỏi">Chọn câu hỏi cần trả lời</option>
							@php
                            $question1 = \App\Models\Question::where("username", $username)->get();
                            
							@endphp
							@if(isset($question1))
                            @foreach($question1 as $ques)
                            @php
                            $answer1 = \App\Models\Answer::where("question_id", $ques->question_id)->first();
							@endphp
							@if (!(isset($answer1)))
							<option value={{$ques->question_id}}>{{$ques->question_id}}</option>
                            @endif
							@endforeach
							@endif
						</select>
						<textarea id="messageInput" rows="5" style="width: 100%;"
							name="answer" placeholder="Câu trả lời của bạn:" required="required"></textarea>
						@if (session('notice'))
						<!-- Hiển thị thông báo với màu sắc phù hợp -->
						<div class="alert alert-success">
							{{ session('notice') }}
						</div>
						@endif
						<div style="display: flex; justify-content: center;">
							<button type="submit" class="btn btn-primary">Gửi</button>
						</div>
					</form>
				</div>
				<div>
					<form action="/editanswer" method="post">
						@csrf
						<h3>Chỉnh sửa câu trả lời:</h3>
						<div>
							<select class="form-select" aria-label="Default select example"
								name="selectedQuestion">
								<option selected value="Chọn câu hỏi">Chọn câu hỏi muốn chỉnh sửa</option>
								@php
                                $question2 = \App\Models\Question::where("username", $username)->get();
                                
                                @endphp
								@if(isset($question2))
                                @foreach($question2 as $ques)
                                @php
                                $answer2 = \App\Models\Answer::where("question_id", $ques->question_id)->first();
                                @endphp
                                @if ((isset($answer2) && $answer2->count() > 0))
                                <option value={{$ques->question_id}}>{{$ques->question_id}}</option>
                                @endif
                                @endforeach
								@endif
                            </select>
						</div>
						<textarea id="messageInput" rows="5" style="width: 100%;"
							name="newanswer" placeholder="Để trống nếu bạn xóa câu trả lời:"></textarea>
						@if (session('notice1'))
						<!-- Hiển thị thông báo với màu sắc phù hợp -->
						<div class="alert alert-success">
							{{ session('notice1') }}
						</div>
						@endif
						<div style="display: flex; justify-content: center;">
							<button type="submit" class="btn btn-primary">Gửi</button>
						</div>
					</form>

				</div>
				<div>
					<form action="/deletequestion" method="post"
						onsubmit="return showConfirmation();">
						@csrf
						<h3>Xóa câu hỏi:</h3>
						<div>
							<select class="form-select" aria-label="Default select example"
								name="selectedQuestion">
								<option selected value="Chọn câu hỏi">Chọn câu hỏi muốn xóa</option>
								@php
                                $question3 = \App\Models\Question::where("username", $username)->get();
                                
                                @endphp
								@if(isset($question3))
                                @foreach($question3 as $ques)
                                @php
                                $answer3 = \App\Models\Answer::where("question_id", $ques->question_id)->first();
                                @endphp
                                
                                <option value={{$ques->question_id}}>{{$ques->question_id}}</option>
                                @endforeach
								@endif
                            </select>
							<br>
							<div class="mb-3">
								<label for="pass" class="form-label">Nhập mật khẩu để xác nhận<span style="color: red">*</span>
								</label> <input type="password" class="form-control" id="pass" name="pass"
									required>
							</div>
						</div>
						@if (session('notice2'))
						@php
							$alertClass = session('notice2') === 'Mật khẩu không chính xác' ? 'alert-danger' : 'alert-success';
						@endphp

						<!-- Hiển thị thông báo với màu sắc phù hợp -->
						<div class="alert {{ $alertClass }}">
							{{ session('notice2') }}
						</div>
						@endif
						<div style="display: flex; justify-content: center;">
							<button type="submit" class="btn btn-primary">Confirm</button>
						</div>
					</form>
					<script>
						// Function to show the confirmation dialog
						function showConfirmation() {

							// Display the confirmation dialog with custom message
							var result = confirm("Bạn có chắc muốn xóa câu hỏi không?");

							// If the user selects "OK", proceed with the form submission
							if (result) {
								return true; // Allow the form submission
							}
							// If the user selects "Cancel", prevent the form submission
							else {
								return false;
							}
						}
					</script>
				</div>
			</div>
		</div>

	</div>
	<!-- Footer -->
    @include ('layouts.footer')
	<!-- End Footer -->
</body>
</html>