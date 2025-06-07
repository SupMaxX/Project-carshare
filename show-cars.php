<?php require "header.php" ; ?>
<?php require "../config.php"; ?>
<?php 
if(!isset($_SESSION['adminname'])){
  
  header("location: login-admins.php");
  
}
$cars = $conn->query("SELECT * FROM cars");

$cars->execute();
$allCars=$cars->fetchAll(PDO::FETCH_OBJ);
?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Automobile</h5>
              <a href="create-cars.php" class="btn btn-primary mb-4 text-center float-right">Adaugă Automobil</a>

              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Denumirea</th>
                    <th scope="col">Prețul</th>
                    <th scope="col">Tipul</th>
                    <th scope="col">Șterge</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allCars as $car) : ?>
                  <tr>
                    <th scope="row"><?php echo $car->id; ?></th>
                    <td><?php echo $car->name; ?></td>
                    <td><?php echo $car->price; ?></td>
                    <td><?php echo $car->car_type; ?></td>
                     <td><a href="delete-cars.php?id=<?php echo $car->id; ?>" class="btn btn-danger  text-center">Șterge</a></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

      <?php require "footer.php" ; ?>