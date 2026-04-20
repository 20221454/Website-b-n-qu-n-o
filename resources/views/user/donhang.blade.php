@include('layouts.User.header')

<div class="container mt-4">

    <h3>Đơn hàng của tôi</h3>

    <table class="table table-bordered mt-3">

        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>

        @foreach($orders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->created_at }}</td>
                <td>{{ $o->trang_thai }}</td>

                <td>
                    <a href="/don-hang/{{ $o->id }}" class="btn btn-info btn-sm">
                        Xem
                    </a>

                    @if($o->trang_thai == 'cho_xac_nhan')
                        <a href="/huy-don/{{ $o->id }}" class="btn btn-danger btn-sm">
                            Hủy
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

</div>

@include('layouts.footer')