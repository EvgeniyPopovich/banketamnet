<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Банкетам.Нет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-cream mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <img src="assets/img/icon.png" class="me-2" style="width: 120px; height: 50px; object-fit: cover;" alt="Логотип">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Панель Администратора</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="userzav.php">Личный кабинет</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-black" href="#"><?= htmlspecialchars($_SESSION['login'] ?? 'Профиль') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-black fw-bold ms-lg-2" href="logout.php">Выход</a>
                    </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-light text-black fw-bold ms-lg-2" href="login.php">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-light text-black fw-bold ms-lg-2" href="reg.php">Регистрация</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>    
    </div>
</nav>