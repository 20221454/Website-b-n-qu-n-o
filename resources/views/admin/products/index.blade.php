@include('layouts.Admin.header')

<div class="container mt-4">
    <h2>Quản lý sản phẩm</h2>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="/admin/products/create" class="btn btn-primary mb-3">
        Thêm sản phẩm
    </a>

    <table class="table table-bordered text-center align-middle">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>

        @foreach($products as $p)
        <tr>
            <td>{{ $p->id }}</td>

            {{-- ✅ SỬA Ở ĐÂY --}}
            <td>{{ $p->ten_san_pham }}</td>

            <td class="text-danger">
                {{ number_format($p->gia) }}đ
            </td>

            {{-- ✅ SỬA Ở ĐÂY --}}
            <td>
                @if(!empty($p->anh))
                    <img src="{{ asset('uploads/' . $p->anh) }}" width="80">
                @else
                    <span>Không có ảnh</span>
                @endif
            </td>

            <td>
                <a href="/admin/products/edit/{{ $p->id }}" class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <a href="/admin/products/delete/{{ $p->id }}"
                   onclick="return confirm('Xóa sản phẩm này?')"
                   class="btn btn-danger btn-sm">
                    Xóa
                </a>
            </td>
        </tr>
        @endforeach

    </table>
</div>

@include('layouts.footer')