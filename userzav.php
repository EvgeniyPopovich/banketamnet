<?php
    session_start();
    require_once 'includes/db.php';
    $pdo = Db::getConnection();
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM zayav WHERE user_id = ? ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $request = $stmt->fetchAll();
    include "templates/header.php";
?>
<div class="container text-center mt-2 mb-2" style="height: 15vh;">
    <h1 class="display-4">Личный кабинет</h1>
</div>
<div class="container mt-2 mb-2" style="height: 50vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Мои заявки</h1>
        <a href="newzav.php" class="btn btn-light">Подать новую заявку</a>
    </div>
    <?php foreach ($request as $row): ?>
        <div class="mb-4">
            <hr>
            <p><strong>Номер заявки</strong> <?=  htmlspecialchars($row['id']) ?></p>
            <p><strong>Статус</strong>
                <?php 
                    $status_text = ['new' => 'новая', 'accept' => 'Банкет назначен', 'close' => 'Банкет завершен'];
                    echo $status_text[$row['status']] ?? $row['status'];
                ?>
            </p>
            <p><strong>Зал</strong> <?=  htmlspecialchars($row['zal']) ?></p>
            <p><strong>Зал</strong> <?=  htmlspecialchars($row['date_event']) ?></p>
            <p><strong>Зал</strong> <?=  htmlspecialchars($row['pay']) ?></p>
            <hr>
        </div>
<?php endforeach; ?>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div id="heroSlider" class="carousel slide shadow" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner" style="border-radius: 15px; overflow: hidden;">
                    <div class="carousel-item active">
                        <img src="assets/img/slider/1.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slider 1">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slider/2.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slider 2">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slider/3.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slider 3">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slider/4.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slider 4">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php 
    include "templates/footer.php";
?>