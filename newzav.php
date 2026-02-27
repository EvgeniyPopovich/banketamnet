<?php
    session_start();
    require_once 'includes/db.php';
    $pdo = Db::getConnection();
    $message = "";
    $user_id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $zal = $_POST["zal"];
    $pay = $_POST["pay"];
    $date = $_POST["date_event"];
    $sql = "INSERT INTO `zayav` (`user_id`,`zal`,`pay`,`date_event`) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $zal, $pay, $date]);
    $message = "Заявка создана";
    }
    include "templates/header.php";
?>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="display-4">Новая заявка</h3>
    <?php if (!empty($message)): ?>
        <div class = "alert <?= strpos($message, 'создана') !==false ? 'alert-success' : 'alert-danger' ?>">
            <?=  htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Зал</label>
            <select name="zal" class="form-control" required>
                <option value="Зал">Зал</option>
                <option value="ресторан">ресторан</option>
                <option value="летняя веранда">летняя веранда</option>
                <option value="закрытая веранда">закрытая веранда</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Дата</label>
            <input type="date" class="form-control" name="date_event" required>
        </div>
          <div class="mb-3">
            <label>Оплата</label>
            <select name="pay" class="form-control" required>
                <option value="Картой">Картой</option>
                <option value="Наличными">Наличными</option>
            </select>
        </div>
        <button class="btn btn-light text-black w-100">Отправить заявление</button>
    </form>
</div>
<?php 
    include "templates/footer.php";
?>