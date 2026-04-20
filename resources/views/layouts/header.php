<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Quần Áo - Thời Trang Việt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .navbar-brand { font-weight: bold; font-size: 1.6rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">🛍️ ShopQuanao</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="sanpham.php">Sản phẩm</a></li>
                </ul>

                <ul class="navbar-nav">
                    <!-- Giỏ hàng -->
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="giohang.php">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= count($_SESSION['cart']) ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <?= htmlspecialchars($_SESSION['user']['ho_ten']) ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="donhang.php">Đơn hàng của tôi</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="dangnhap.php">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="dangky.php">Đăng ký</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">