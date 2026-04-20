@include('layouts.header')

<div class="container mt-5" style="max-width:400px;">
    <h3>Đăng nhập</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Mật khẩu" required>

        <button class="btn btn-primary w-100">Đăng nhập</button>
    </form>

    <p class="mt-3">
        Chưa có tài khoản? <a href="/register">Đăng ký</a>
    </p>
</div>

@include('layouts.footer')