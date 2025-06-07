<?php require "header.php" ; ?>
<?php require "../config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
    header("location: login-admins.php");
  }

  $requests = $conn->query("SELECT * FROM requests");

  $requests->execute();
  $allRequests=$requests->fetchAll(PDO::FETCH_OBJ);
  ?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Cereri</h5>
            
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nume</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Vezi automobil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allRequests as $request) : ?>
                  <tr>
                    <th scope="row"></th><?php echo $request->id; ?></th>
                    <td><?php echo $request->name; ?></td>
                    <td><?php echo $request->email; ?></td>
                    <td><?php echo $request->phone; ?></td>
                     <td><a href="../car-details.php?id=<?php echo $request->cars_id; ?>" class="btn btn-success  text-center ">Vezi</a></td>
                  </tr>
                    <?php endforeach; ?>
              
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


      <?php require "footer.php" ; ?>
