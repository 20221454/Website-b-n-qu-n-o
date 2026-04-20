@include('layouts.Admin.header')

<div class="container mt-4">
    <h2>Quản lý đơn hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>

        @foreach($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>

            {{-- ✅ FIX HIỂN THỊ TÊN --}}
            <td>
                <b>{{ $o->user->ho_ten ?? 'Không xác định' }}</b>
            </td>

            <td>{{ number_format($o->tong_tien) }}đ</td>

            <td>
                @if($o->trang_thai == 'cho_xu_ly')
                    <span class="badge bg-secondary">Chờ xử lý</span>
                @elseif($o->trang_thai == 'da_xac_nhan')
                    <span class="badge bg-info">Đã xác nhận</span>
                @elseif($o->trang_thai == 'dang_giao')
                    <span class="badge bg-warning">Đang giao</span>
                @elseif($o->trang_thai == 'da_giao')
                    <span class="badge bg-primary">Đã giao</span>
                @elseif($o->trang_thai == 'huy')
                    <span class="badge bg-danger">Đã hủy</span>
                @endif
            </td>

            <td>
                <a href="/admin/orders/update/{{ $o->id }}/da_xac_nhan" class="btn btn-success btn-sm">Duyệt</a>

                <a href="/admin/orders/update/{{ $o->id }}/dang_giao" class="btn btn-warning btn-sm">Giao</a>

                <a href="/admin/orders/update/{{ $o->id }}/da_giao" class="btn btn-primary btn-sm">Hoàn thành</a>

                <a href="/admin/orders/update/{{ $o->id }}/huy" class="btn btn-danger btn-sm">Hủy</a>

                <a href="/admin/orders/{{ $o->id }}" class="btn btn-info btn-sm">Xem</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@include('layouts.footer')