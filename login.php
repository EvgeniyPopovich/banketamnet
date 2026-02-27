<?php
session_start();
require_once 'includes/db.php';
$pdo = Db::getConnection();
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);
    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['fio'] = $user['fio'];
        $_SESSION['login'] = $user['login'];
        if ($_SESSION['role'] === "admin") {
            header("Location:admin.php");
        } else {
            header("Location:userzav.php");
        }
        exit;
    } else {
        $message = "Неверный логин или пароль";
    }
}
include 'templates/header.php';
?>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-3 text-center">Вход</h3>
    <?php if (!empty($message)): ?>
        <div class = "alert alert-danger">
            <?=  $message ?>
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
        <button class="btn btn-light text-black w-100">Вход</button>
        <a class="mt-2 fw-bold" href="reg.php">Еще не зарегистрированы? Регистрация</a>
    </form>
</div>
<?php 
include 'templates/footer.php';
?>