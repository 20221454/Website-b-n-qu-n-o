<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Shop Quần Áo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ route('admin.products.index') }}">
            ⚙️ Admin Panel
        </a>

        <ul class="navbar-nav flex-row align-items-center">

            <!-- SẢN PHẨM -->
            <li class="nav-item me-3">
                <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                    📦 Sản phẩm
                </a>
            </li>

            <!-- ĐƠN HÀNG -->
            <li class="nav-item me-3">
                <a class="nav-link text-white" href="{{ route('admin.orders.index') }}">
                    🧾 Quản lý đơn hàng
                </a>
            </li>

            <!-- 🔔 THÔNG BÁO -->
            <li class="nav-item me-3">
                <a class="nav-link text-white" href="{{ route('admin.notifications.create') }}">
                    🔔 Thông báo
                </a>
            </li>

            <!-- USER -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown">
                    {{ auth()->user()->ho_ten }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            🚪 Đăng xuất
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</nav>

<div class="container mt-4">