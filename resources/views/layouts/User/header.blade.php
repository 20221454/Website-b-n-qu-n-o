<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Quần Áo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@php
    // GIỎ HÀNG
    $cart = session('cart', []);
    $totalQty = 0;

    foreach ($cart as $item) {
        if (isset($item['so_luong'])) {
            $totalQty += $item['so_luong'];
        }
    }

    // THÔNG BÁO
    $notiCount = 0;
    if(auth()->check()){
        $notiCount = \App\Models\Notification::where('is_read', false)
            ->where(function($q){
                $q->whereNull('user_id')
                  ->orWhere('user_id', auth()->id());
            })->count();
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="/">🛍️ Shop Quần Áo</a>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Trang chủ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/san-pham">Sản phẩm</a>
                </li>
            </ul>

            <ul class="navbar-nav">

                <!-- 🔔 THÔNG BÁO -->
                @auth
                <li class="nav-item me-3">
                    <a href="/thong-bao" class="nav-link position-relative">
                        🔔
                        @if($notiCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $notiCount }}
                            </span>
                        @endif
                    </a>
                </li>
                @endauth

                <!-- 🛒 GIỎ HÀNG -->
                <li class="nav-item me-3">
                    <a href="/gio-hang" class="nav-link position-relative">
                        🛒

                        @if($totalQty > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $totalQty }}
                            </span>
                        @endif
                    </a>
                </li>

                <!-- USER -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ auth()->user()->ho_ten }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/don-hang">
                                    🧾 Đơn hàng
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="/logout">
                                    🚪 Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Đăng nhập</a>
                    </li>
                @endauth

            </ul>

        </div>

    </div>
</nav>

<div class="container mt-4">