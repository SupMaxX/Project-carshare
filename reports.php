<?php require "header.php" ; ?>
<?php require "../config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  
}
$reptypes = $conn->query("SELECT car_type, count(car_type) as quantity FROM cars GROUP BY car_type");

$reptypes->execute();
$types=$reptypes->fetchAll(PDO::FETCH_OBJ);
$i=0;
?>
       <div class="row"></div>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Stoc Automobile</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tip</th>
                    <th scope="col">Cantitate</th>
                  </tr>
                </thead>
                <body>
                  <?php foreach($types as $type) { $i++; ?>
                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $type->car_type; ?></td>
                    <td><?php echo $type->quantity; ?></td>
                  </tr>
                  <?php } ?>
                </body>
              </table> 
            </div>
          </div>
        </div>
      </div>
<?php
$repoffers = $conn->query("SELECT type, count(type) as quantity FROM cars GROUP BY type");

$repoffers->execute();
$offers=$repoffers->fetchAll(PDO::FETCH_OBJ);
$i=0;
?>
       <div class="row"></div>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Stoc Oferte</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tip</th>
                    <th scope="col">Cantitate</th>
                  </tr>
                </thead>
                <body>
                  <?php foreach($offers as $offer) { $i++; ?>
                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $offer->type; ?></td>
                    <td><?php echo $offer->quantity; ?></td>
                  </tr>
                  <?php } ?>
                </body>
              </table> 
            </div>
          </div>
        </div>
      </div>


        <?php require "footer.php" ; ?>