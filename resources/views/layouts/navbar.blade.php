<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto" href="/"><img class="navbar-brand mx-auto" src="{{ asset('meof.png')}}" style="width: auto; height: 50px;" alt="meof"></a>
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active"
                    aria-current="page" href="/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="/help">Trợ
                        giúp</a></li>
                <li class="nav-item"><a class="nav-link" href="/alluser">Khám phá</a></li>
                <li class="nav-item"><a class="nav-link" href="/timemail">Thư thời gian</a></li>
                <li class="nav-item dropdown" onmouseover="showDropdownMenu()"
                    onmouseout="hideDropdownMenu()">
                    <a class="nav-link dropdown-toggle" href="/forum" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">Diễn đàn
                    </a>
                    <ul class="dropdown-menu dropdown-hidden">
                        <li><a class="nav-link" href="/forum/sport">Thể thao</a></li>
                        <li><a class="nav-link" href="/forum/tech">Công nghệ</a></li>
                        <li><a class="nav-link" href="/forum/animal">Động vật</a></li>
                        <li><a class="nav-link" href="/forum/art">Nghệ thuật</a></li>
                        <li><a class="nav-link" href="/forum/food">Ẩm thực</a></li>
                        <li><a class="nav-link" href="/forum/enjoy">Sở thích</a></li>
                        <li><a class="nav-link" href="/forum/life">Đời sống</a></li>
                        <li><a class="nav-link" href="/forum/else">Chém gió</a></li>
                    </ul></li>
                @php
                // Lấy giá trị của biến username từ session (nếu tồn tại)
                $username = session('username');
                @endphp
                <li class="nav-item"><a class="nav-link" href="/chat">Chat với người lạ</a></li>
                @if ($username != null)
                <li class="nav-item dropdown" onmouseover="showDropdownMenu()"
                    onmouseout="hideDropdownMenu()"><a
                    class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"> Xin chào {{$username}}
                </a>
                    <ul class="dropdown-menu dropdown-hidden">
                        <li><a class="dropdown-item" href="/profile">Câu
                                hỏi của tôi</a></li>
                        <li><a class="dropdown-item" href="/update">Hồ
                                sơ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                    </ul></li>
                @endif
            </ul>
            
            @if ($username == null)
            <button class="btn btn-outline-success" type="button"
                onclick="login()">Đăng nhập</button>
            @endif
            <div class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="Nhập tên người dùng"
                    aria-label="Search" name="usernameInput" id="usernameInput" list="userList">
                <datalist id="userList">
                    @php
                        $users = \App\Models\UserWeb::orderBy('username', 'asc')->get();
                    @endphp
                    @foreach ($users as $user)
                        <option value="{{ $user->username }}">{{ $user->username }}</option>
                    @endforeach
                </datalist>
                <script>
                    const input = document.getElementById('usernameInput');
                    const datalist = document.getElementById('userList');
                    
                    function validate() {
                        const selected = document.querySelector(`#userList > option[value="${input.value}"]`);
                        // Checks for option with value attribute identical the same as user input

                        if (selected && selected.value.length > 0) {
                            alert("Valid"); // Runs if check for option does not return null and input > 0
                        } else {
                            alert("Invalid"); // Runs if option is null (user entered a non-suggested value
                        }
                    }
                    
                    function handler(data) {

                        const dataList = document.querySelector('#userList');
                        if (input.value.length > 0) {
                            data.forEach((arrayObject, index) => {
                                const option = document.createElement('option');
                                option.value = arrayObject.name.common;
                                dataList.appendChild(option);
                            });                        
                        }
                    }
                </script>
                <button type="submit" class="btn btn-outline-success"
                    onclick="redirectToIdCheck()">Tìm</button>
            </div>

            <script>
                function redirectToIdCheck() {
                    var usernameInputValue = document.getElementById("usernameInput").value;
                    window.location.href = "/wall/"+ usernameInputValue;
                }
                const inputElement = document.getElementById('usernameInput');

                // Hàm xử lý sự kiện khi ấn phím trên ô input
                function handleEnterKeyPress(event) {
                    // Kiểm tra xem phím được nhấn có phải là Enter (mã phím 13)
                    if (event.keyCode === 13) {
                        redirectToIdCheck(); // Gọi hàm thực hiện chuyển hướng
                    }
                }

                // Gán hàm xử lý cho sự kiện keydown trên ô input
                inputElement.addEventListener('keydown', handleEnterKeyPress);
            </script>
        </div>
    </div>
</nav>