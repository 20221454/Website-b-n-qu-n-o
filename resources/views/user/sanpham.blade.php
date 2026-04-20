@include('layouts.User.header')

<div class="container mt-4">

    <h2 class="mb-4">Tất cả sản phẩm</h2>

    {{-- SEARCH --}}
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Tìm kiếm..."
                   value="{{ $search ?? '' }}">

            <button class="btn btn-primary">Tìm</button>

            @if(!empty($search))
                <a href="/san-pham" class="btn btn-secondary">Xóa</a>
            @endif
        </div>
    </form>

    <div class="row">

        {{-- CATEGORY --}}
        <div class="col-md-3">
            <div class="list-group">

                <a href="/san-pham"
                   class="list-group-item {{ empty($category) ? 'active' : '' }}">
                    Tất cả
                </a>

                @foreach($categories as $cat)
                    <a href="/san-pham?category={{ $cat->id }}"
                       class="list-group-item {{ ($category ?? null) == $cat->id ? 'active' : '' }}">
                        {{ $cat->ten_danh_muc }}
                    </a>
                @endforeach

            </div>
        </div>

        {{-- PRODUCTS --}}
        <div class="col-md-9">

            <div class="row">

                @forelse($products as $p)
                    <div class="col-md-4 mb-4">

                        <div class="card h-100">

                            <img class="card-img-top"
                                 src="{{ $p->anh ? asset('uploads/'.$p->anh) : 'https://via.placeholder.com/300' }}"
                                 alt="product">

                            <div class="card-body d-flex flex-column">

                                <h6 class="fw-bold">{{ $p->ten_san_pham }}</h6>

                                <p class="text-danger fw-bold">
                                    {{ number_format($p->gia) }} VNĐ
                                </p>

                                <p class="text-muted small">
                                    {{ $p->category->ten_danh_muc ?? '' }}
                                </p>

                                <div class="mt-auto">

                                    <a href="/san-pham/{{ $p->id }}"
                                       class="btn btn-primary w-100 mb-2">
                                        Xem chi tiết
                                    </a>

                                    <a href="/them-gio-hang/{{ $p->id }}"
                                       class="btn btn-success w-100">
                                        🛒 Thêm vào giỏ
                                    </a>

                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">
                            Không có sản phẩm nào
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')