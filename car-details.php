<?php
require "header.php";
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cars_id']) && isset($_POST['user_id'])) {
        $cars_id = $_POST['cars_id'];
        $user_id = $_POST['user_id'];

        $check_favorite = $conn->prepare("SELECT * FROM favs WHERE cars_id = :cars_id AND user_id = :user_id");
        $check_favorite->bindParam(':cars_id', $cars_id, PDO::PARAM_INT);
        $check_favorite->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $check_favorite->execute();
        $existing_favorite = $check_favorite->fetch(PDO::FETCH_ASSOC);

        if ($existing_favorite) {
            $stmt = $conn->prepare("DELETE FROM favs WHERE cars_id = :cars_id AND user_id = :user_id");
            $stmt->bindParam(':cars_id', $cars_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("INSERT INTO favs (cars_id, user_id, created_at) VALUES (:cars_id, :user_id, NOW())");
            $stmt->bindParam(':cars_id', $cars_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
 
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $single = $conn->prepare("SELECT * FROM cars WHERE id = :id");
    $single->bindParam(':id', $id, PDO::PARAM_INT);
    $single->execute();
    $allDetails = $single->fetch(PDO::FETCH_OBJ);

    if ($allDetails) {
        $relatedCars = $conn->prepare("SELECT * FROM cars WHERE car_type = :car_type AND id != :id");
        $relatedCars->bindParam(':car_type', $allDetails->car_type, PDO::PARAM_STR);
        $relatedCars->bindParam(':id', $id, PDO::PARAM_INT);
        $relatedCars->execute();
        $allRelatedCars = $relatedCars->fetchAll(PDO::FETCH_OBJ);
    }

    $images = $conn->prepare("SELECT * FROM related_images WHERE cars_id = :cars_id");
    $images->bindParam(':cars_id', $id, PDO::PARAM_INT);
    $images->execute();
    $allImages = $images->fetchAll(PDO::FETCH_OBJ);
}
?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/car7.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <span class="d-inline-block text-white px-3 mb-3 car-offer-type rounded">Detaliile mașinii</span>
        <h1 class="mb-2">Tesla Model S</h1>
        <p class="mb-5"><strong class="h2 text-success font-weight-bold">300 RON/ZI</strong></p>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div>
          <div class="slide-one-item home-slider owl-carousel">
            <?php foreach($allImages as $image) : ?>
              <div><img src="images/<?php echo htmlspecialchars($image->image); ?>" alt="Image" class="img-fluid"></div>
            <?php endforeach; ?>
          </div>
        </div>
        
        <div class="bg-white car-body border-bottom border-left border-right">
          <div class="row mb-5">
            <div class="col-md-6">
              <strong class="text-success h1 mb-3">300 RON/ZI</strong>
            </div>
            <div class="col-md-6">
              <ul class="car-specs-wrap mb-3 mb-lg-0 float-lg-right">
                <li>
                  <span class="car-specs">Scaune</span>
                  <span class="car-specs-number">4 </span>
                </li>
            
                <li>
                  <span class="car-specs">Km</span>
                  <span class="car-specs-number">7,000</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Tipul Mașinii</span>
              <strong class="d-block">Sedan</strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">An</span>
              <strong class="d-block">2024</strong>
            </div>
          </div>
          <h2 class="h4 text-black">Mai multă informație</h2>
          <p> Un automobil super dotat, care își merită banii.</p>

          <div class="row no-gutters mt-5">
            <div class="col-12">
              <h2 class="h4 text-black mb-3">Galerie de poze</h2>
            </div>
            <?php foreach($allImages as $image) : ?>
              <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="images/<?php echo htmlspecialchars($image->image); ?>" class="image-popup gal-item"><img src="images/<?php echo htmlspecialchars($image->image); ?>" alt="Image" class="img-fluid"></a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
      <div class="bg-white widget border rounded">
    <h3 class="h4 text-black widget-title mb-3">Contactează Proprietarul</h3>
    <?php if(isset($_SESSION['user_id'])) : ?>
    <form action="process-request.php" method="POST" class="form-contact-agent">
        <div class="form-group">
            <label for="name">Nume</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="cars_id" value="<?php echo $id; ?>" class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="admin_name" value="<?php echo $allDetails->admin_name; ?>" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Trimite mesaj">
        </div>
    </form>
    <?php else : ?>
      <p>Loghează-te pentru a trimite un mesaj de interes pentru această mașină</p>
      <?php endif; ?>
        </div>

        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3 ml-0">Distribuie</h3>
          <div class="px-3" style="margin-left: -15px;">
            <a href="https://www.facebook.com/sharer/sharer.php?u=&quote=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text=&url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
          </div>
        </div>

        <div class="bg-white widget border rounded">
  <h3 class="h4 text-black widget-title mb-3 ml-0">
    <?php
    $check_favorite = $conn->prepare("SELECT * FROM favs WHERE cars_id = :cars_id AND user_id = :user_id");
    $check_favorite->bindParam(':cars_id', $id, PDO::PARAM_INT);
    $check_favorite->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $check_favorite->execute();
    $existing_favorite = $check_favorite->fetch(PDO::FETCH_ASSOC);

    if ($existing_favorite) {
        echo "Scoate de la favorite"; 
    } else {
        echo "Adaugă la favorite"; 
    }
    ?>
  </h3>
  <div class="px-3" style="margin-left: -15px;">
  <?php if(isset($_SESSION['user_id'])) : ?>

    <?php if(isset($message)) echo '<p>' . $message . '</p>'; ?>
    <form action="" class="form-contact-agent" method="POST">
      <div class="form-group">
        <input type="hidden" id="cars_id" name="cars_id" value="<?php echo htmlspecialchars($id); ?>" class="form-control" readonly>
      </div>
      <div class="form-group">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>" class="form-control" readonly>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $existing_favorite ? 'Scoate de la favorite' : 'Adauga la favorite'; ?>">
      </div>
    </form>
    <?php else : ?>
      <p>Loghează-te pentru a adăuga la favorite această mașină</p>
      <?php endif; ?>

  </div>
</div>

</div>
</div>
</div>
</div>
    <?php require "footer.php"; ?>