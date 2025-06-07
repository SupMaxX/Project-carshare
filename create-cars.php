<?php require "header.php" ; ?>
<?php require "../config.php"; ?>


<?php 


if(isset($_POST['submit'])) {

  
  if(empty($_POST['name']) OR  empty($_POST['location']) OR empty($_POST['price']) 
  OR empty($_POST['seats'])OR empty($_POST['km']) OR empty($_POST['car_type'])
  OR empty($_POST['year']) OR empty($_POST['type']) OR empty($_POST['description'])){
    echo"<script>alert('Masina adaugata cu succes'');</script>";
  } else {

    $name = $_POST['name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $seats = $_POST['seats'];
    $km = $_POST['km'];
    $car_type = $_POST['car_type'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $adminname = $_SESSION['adminname'];
    $image = $_FILES['thumbnail']['name'];

    $dir = "../images/" . basename($image);

    $insert = $conn->prepare("INSERT INTO cars(name, location, price, seats, km, car_type, year, type, description, image, admin_name) 
    VALUES (:name, :location, :price, :seats, :km, :car_type, :year, :type, :description, :image, :adminname)");
    $insert->execute([
      ':name' =>$name,
      ':location' => $location,
      ':price' =>$price,
      ':seats' =>$seats,
      ':km' =>$km,
      ':car_type' =>$car_type,
      ':year' =>$year,
      ':type' =>$type,
      ':description' =>$description,
      ':adminname' =>$adminname,
      ':image' =>$image,
    ]);
    if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $dir)){
      echo"<script>alert('Datele sunt incomplete'');</script>";
    }


	}
}



?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Creeaza automobil</h5>
                    <form method="POST" action="create-cars.php" enctype="multipart/form-data">
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Nume" />
                        </div>    
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" class="form-control" placeholder="Locatie" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="Pret" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="seats" id="form2Example1" class="form-control" placeholder="Scaune" />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="km" id="form2Example1" class="form-control" placeholder="KM" />
                        </div>   
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year" id="form2Example1" class="form-control" placeholder="An" />
                        </div> 
                        <select name="car_type" class="form-control form-select" aria-label="Default select example">
                            <option selected>Selecteaza tipul automobilului</option>
                            <option value="sedan">Sedan</option>
                            <option value="coupe">Coupe</option>
                            <option value="hatchback">Hatchback</option>
                        </select>   
                        <select name="type" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                            <option selected>Selecteaza tipul</option>
                            <option value="rent">Chirie</option>
                            <option value="sale">Vanzare</option>
                        </select>  
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descrierea automobilului</label>
                            <textarea placeholder="Descriere" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Imagine</label>
                            <input name="thumbnail" class="form-control" type="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Galeria de imagini</label>
                            <input name="images" class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Creeaza</button>
                
                    </form>

            </div>
          </div>
        </div>
      </div>
      <?php require "footer.php" ; ?>