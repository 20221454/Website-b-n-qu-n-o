@include('layouts.Admin.header')

@section('content')

<h2>Đăng thông báo</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/admin/notifications">
    @csrf
    <input name="title" placeholder="Tiêu đề">
    <br>
    <textarea name="content" placeholder="Nội dung"></textarea>
    <br>
    <button>Đăng</button>
</form>

@include('layouts.footer')