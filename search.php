<?php
require "header.php";
require "config.php";

$select = $conn->query("SELECT * FROM cars");
$select->execute();

$cars = $select->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['submit'])) {

	$types = $_POST['car_type'];
	$offers = $_POST['offers'];
	$cities = $_POST['cities'];

	$search = $conn->query("SELECT * FROM cars WHERE car_type LIKE '%$types%' OR type LIKE  '%$offers%' OR location LIKE '%$cities%' ");
	$search->execute();

	$listings = $search->fetchAll(PDO::FETCH_OBJ);

}
else {
	header("location: ./");
}
?>

    <div class="slide-one-item home-slider owl-carousel">
    <?php foreach($cars as $car) : ?>

      <div class="site-blocks-cover overlay" style="background-image:url(images/<?php echo $car->image;  ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
       
            <div class="col-md-10">
            <span class="d-inline-block bg-<?php if ($car->type == "Chirie") {echo "success";} else {echo "danger";}?> text-white px-3 mb-3 car-offer-type rounded"><?php echo $car->type; ?></span>
              <h1 class="mb-2"><?php echo $car->name; ?></h1>
              <p class="mb-5"><strong class="h2 text-success font-weight-bold"><?php echo $car->price; ?></strong></p>
              <p><a href="car-details.php?id=<?php echo $car->id; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">Vezi Detalii</a></p>
            </div>
          
          </div>
        </div>
      </div>  
      <?php endforeach; ?>


    </div>


    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
          <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
            <div class="row  align-items-end">
              <div class="col-md-3">
                <label for="list-types">Tipul mașinii</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="car_type" id="list-types" class="form-control d-block rounded-0">
					<option value="Sedan">Sedan</option>
					<option value="Coupe">Coupe</option>
					<option value="Hatchback">Hatchback</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="offer-type">Tipul ofertei</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="offers" id="offer-type" class="form-control d-block rounded-0">
					<option value="Vanzare">Vânzare</option>
					<option value="Chirie">Chirie</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="select-cities">Localitatea</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="cities" id="select-cities" class="form-control d-block rounded-0">
                    <option value="bucuresti">București</option>
                    <option value="brasov">Brașov</option>					
                    <option value="cluj">Cluj</option>
                    <option value="constanta">Constanța</option>					
                    <option value="iasi">Iași</option>
					<option value="timisoara">Timișoara</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
              </div>
            </div>
          </form>
        </div>  


       
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
        <div class="row mb-5">
            <?php if(count($listings) > 0) : ?>
            <?php foreach($listings as $listing ) : ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.php?id=<?php echo $listing->id; ?>" class="car-thumbnail">
              <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if ($listing->type == "Chirie") {echo "success";} else {echo "danger";} ?>"><?php echo $listing->type; ?></span>
                </div>
                
                <img src="images/<?php echo $listing->image; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <h2 class="car-title"><a href="car-details.php?id= <?php echo $listing->id; ?>"><?php echo $listing->name; ?></a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span> <?php echo $listing->location; ?></span>
                <strong class="car-price text-primary mb-3 d-block text-success"><?php echo $listing->price; ?></strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number"><?php echo $listing->seats; ?></span>
                    
                  </li>
                  <li>
                    <span class="car-specs">Parcurs</span>
                    <span class="car-specs-number"><?php echo $listing->km; ?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
          
          </div>


        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <?php else : ?>
        <div class="bg-success text-white">La moment nu dispunem de maşini care ar satisface cerinţele Dvs.</div>
        <?php endif; ?>

    </div>
    </div>
    </div>
    <?php require "footer.php";