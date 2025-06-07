
<?php require "header.php" ; ?>
<?php require "../config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  
}
$admins = $conn->query("SELECT * FROM admins");

$admins->execute();
$allAdmins=$admins->fetchAll(PDO::FETCH_OBJ);
?>
       <div class="row"></div>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Administratori</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Adaugă Administrator</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nume de utilizator</th>
                    <th scope="col">Adresa de e-mail</th>
                  </tr>
                </thead>
                <body>
                  <?php foreach($allAdmins as $admin) : ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                   
                  </tr>
                  <?php endforeach; ?>
                </body>
              </table> 
            </div>
          </div>
        </div>
      </div>



        <?php require "footer.php" ; ?>