<?php require "header.php" ; ?>
<?php
require "../config.php";

if(isset($_SESSION['adminname']))
{
  header("location: ./");
}
 
if(isset($_POST['submit']))
{

    if(empty($_POST['email']) OR empty($_POST['password']))
	{
      echo"<script>alert('Datele sunt incomplete');</script>";
    }
	else
	{

      $email = $_POST['email'];
      $password = $_POST['password'];

      $login = $conn->query("SELECT * FROM admins WHERE email='$email'");
      $login-> execute();

      $fetch = $login->fetch(PDO::FETCH_ASSOC);

      if($login->rowCount() > 0){
       if(password_verify($password, $fetch['mypassword'])){

        $_SESSION['adminname'] = $fetch['adminname'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['admin_id'] = $fetch['id'];
        echo "<script>alert('V-ati logat cu succes!');</script>";
        header("location: ./");


       } else{
        echo "<script>alert('Email-ul sau parola sunt gresite.');</script>";
       }
      } else {
        echo"<script>alert('Email-ul sau parola sunt gresite.');<script>";
      }
    }
  }
?>

          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mt-5">Login</h5>
                  <form method="POST" class="p-auto" action="./login-admins.php">
  
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                      
                      </div>

                      
  
                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                        
                      </div>




                      <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                    
                    </form>

                </div>
          </div>
          <?php require "footer.php" ; ?>