
<!DOCTYPE html>
<html lang="vi">

<head>
<meta charset="UTF-8">
<title>Ask | Khám phá</title>
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
	<div class="container">
        @php
        $users = \App\Models\UserWeb::get();
        $perPage = 10; // Number of rows to display per page
        $currentPage = request()->get('page', 1); // Get the current page from the URL query parameter
        $slicedUsers = $users->slice(($currentPage - 1) * $perPage, $perPage);
        $index = ($currentPage - 1) * $perPage + 1;
        @endphp
        <h1>Danh sách người dùng:</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Số câu hỏi</th>
                    <th scope="col">Số câu trả lời</th>
                </tr>
            </thead>
            <tbody>
            @foreach($slicedUsers as $user)
            @php
            $question = \App\Models\Question::where('username', $user->username)->count();
            $totalAnswers = \App\Models\Answer::join('questions', 'answers.question_id', '=', 'questions.question_id')
                                            ->where('questions.username', $user->username)
                                            ->count();
            @endphp
            <tr>
                <th scope="row">{{$index++}}</th>
                <td><a href="/wall/{{$user->username}}">{{$user->username}}</a></td>
                <td><b>{{$question}}</b> câu hỏi</td>
                <td><b>{{$totalAnswers}}</b> câu trả lời</td>
            </tr>
            @endforeach
            </tbody>
          </table>
          <div>
        @if ($users->count() > $perPage)
        <ul class="pagination">
            @php
            $paginationUrl = url()->current(); // Get the current URL for pagination links
            $currentPage = (int) $currentPage; // Convert the current page to an integer value
            $totalPages = ceil($users->count() / $perPage); // Calculate the total number of pages
            $maxVisiblePages = 10; // Maximum number of visible page links
            $halfMaxVisiblePages = floor($maxVisiblePages / 2);
            $startPage = max($currentPage - $halfMaxVisiblePages, 1);
            $endPage = min($currentPage + $halfMaxVisiblePages, $totalPages);

            if ($endPage - $startPage + 1 < $maxVisiblePages) {
                if ($startPage === 1) {
                    $endPage = min($totalPages, $maxVisiblePages);
                } elseif ($endPage === $totalPages) {
                    $startPage = max(1, $totalPages - $maxVisiblePages + 1);
                }
            }
            @endphp

            @if ($startPage !== 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginationUrl }}?page=1">1</a>
                </li>
                @if ($startPage > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginationUrl }}?page={{ $i }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($endPage !== $totalPages)
                @if ($endPage < $totalPages - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginationUrl }}?page={{ $totalPages }}">{{ $totalPages }}</a>
                </li>
            @endif
        </ul>
        @endif
    </div>
    </div>
	<!-- End Page content -->
	<!-- Footer -->
	@include('layouts.footer')
	<!-- End Footer -->
</body>

</html>