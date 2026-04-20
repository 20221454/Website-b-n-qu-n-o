@include('layouts.User.header')

<h2 class="mb-4">🧾 Thanh toán</h2>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="/thanh-toan">
    @csrf

    <div class="row">

        <!-- 🧍 THÔNG TIN KHÁCH -->
        <div class="col-md-6">
            <h5>Thông tin khách hàng</h5>

            <input type="text" 
                   name="ho_ten"
                   class="form-control mb-2" 
                   placeholder="Họ tên"
                   value="{{ auth()->user()->ho_ten ?? '' }}"
                   required>

            <input type="text" 
                   name="so_dien_thoai"
                   class="form-control mb-2" 
                   placeholder="Số điện thoại"
                   value="{{ auth()->user()->so_dien_thoai ?? '' }}"
                   required>

            <input type="text" 
                   name="dia_chi"
                   class="form-control mb-2" 
                   placeholder="Địa chỉ"
                   value="{{ auth()->user()->dia_chi ?? '' }}"
                   required>
        </div>

        <!-- 🛒 ĐƠN HÀNG -->
        <div class="col-md-6">
            <h5>Đơn hàng</h5>

            @php $tong = 0; @endphp

            @foreach($cart as $item)
                @php 
                    $total = $item['gia'] * $item['so_luong']; 
                    $tong += $total; 
                @endphp

                <div class="d-flex justify-content-between">
                    <span>{{ $item['ten_san_pham'] }} x {{ $item['so_luong'] }}</span>
                    <span>{{ number_format($total) }}đ</span>
                </div>
            @endforeach

            <hr>

            <h5 class="text-end text-danger">
                Tổng: {{ number_format($tong) }}đ
            </h5>

            <button class="btn btn-success w-100 mt-3">
                Xác nhận đặt hàng
            </button>
        </div>

    </div>

</form>

@include('layouts.footer')