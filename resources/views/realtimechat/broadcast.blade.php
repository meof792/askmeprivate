@php
// Kiểm tra xem session 'username' đã tồn tại hay chưa
$username = session('username');
@endphp
<div class="right message">
    <div><small class="text-muted">{{$username}}:</small></div>
    <div>
        <p title="{{$timestamp}}">{{$message}}</p>
    </div>
</div>
  