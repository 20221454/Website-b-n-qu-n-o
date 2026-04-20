@include('layouts.header')

<div class="container mt-5" style="max-width:400px;">
    <h3>Đăng ký</h3>

    {{-- HIỂN THỊ LỖI --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
    @endif

    {{-- HIỂN THỊ LỖI CUSTOM --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <input type="text" name="ho_ten" class="form-control mb-3" placeholder="Họ tên" required>

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Mật khẩu" required>

        <button class="btn btn-success w-100">Đăng ký</button>
    </form>

    <p class="mt-3">
        Đã có tài khoản? <a href="/login">Đăng nhập</a>
    </p>
</div>

@include('layouts.footer')