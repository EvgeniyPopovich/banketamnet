<?php
session_start();
require_once 'includes/db.php';
$pdo = Db::getConnection();
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST["login"];
    $password = $_POST["password"];
    $fio = $_POST["fio"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    if ($stmt->fetch()){
        $message = "Логин уже занят";
    }else{
        $sql = "INSERT INTO `users` (`login`,`password`,`fio`,`phone`,`email`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$login, $password_hash, $fio, $phone, $email]);
        $message = "Пользователь создан";
    }
}
include 'templates/header.php';
?>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-3 text-center">Регистрация</h3>
    <?php if (!empty($message)): ?>
        <div class = "alert <?= strpos($message, 'создан') !==false ? 'alert-success' : 'alert-danger' ?>">
            <?=  htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" required>
        </div>
         <div class="mb-3">
            <label class="form-label">ФИО</label>
            <input type="text" class="form-control" name="fio" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <button class="btn btn-light text-black w-100">Зарегистрированы</button>
        <a class="mt-2 fw-bold" href="login.php">Уже зарегистрированы? Вход</a>
    </form>
</div>
<?php 
include 'templates/footer.php';
?>