<?php
require "header.php";
require "config.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Logati-va pentru a va vedea masinile favorite.');</script>";
    echo "<script>window.location.href='./login.php'</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = $conn->prepare("
    SELECT cars.* 
    FROM favs 
    JOIN cars ON favs.cars_id = cars.id 
    WHERE favs.user_id = :user_id
");
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$favCars = $query->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <h2>Masini favorite</h2>
    <div class="row" style="min-height: 400px;"> 
        <?php if (!empty($favCars)): ?>
            <?php foreach ($favCars as $car): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="car-details.php?id=<?php echo htmlspecialchars($car->id); ?>">
                            <img class="card-img-top" src="images/<?php echo htmlspecialchars($car->image); ?>" alt="">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="car-details.php?id=<?php echo htmlspecialchars($car->id); ?>"><?php echo htmlspecialchars($car->name); ?></a>
                            </h4>
                            <h5>$<?php echo htmlspecialchars($car->price); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($car->description); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 d-flex align-items-center justify-content-center">
                <p style="font-size: 1.5em; color: #ff0000; background-color: #f8f9fa; padding: 20px; border-radius: 10px;">Nu ati adaugat nici o masina la favorite.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require "footer.php"; ?>