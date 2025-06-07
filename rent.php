<?php
require "header.php";
require "config.php";

$select = $conn->query("SELECT * FROM cars ORDER by name DESC");
$select->execute();

$cars = $select->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="slide-one-item home-slider owl-carousel">
    <?php foreach($cars as $car) : ?>

      <div class="site-blocks-cover overlay" style="background-image: url(images/<?php echo $car->image;  ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
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
      
      <div class="site-blocks-cover overlay" style="background-image: url(images/car8.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
            <span class="d-inline-block bg-danger text-white px-3 mb-3 car-offer-type rounded">Vânzare</span>
              <h1 class="mb-2">Lamborghini Gallardo</h1>
              <p class="mb-5"><strong class="h2 text-success font-weight-bold">300 RON/ZI</strong></p>
              <p><a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">Vezi Detalii</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
          <form class="form-search col-md-12" method="POST" action= "search.php" style="margin-top: -100px;">
            <div class="row  align-items-end">
              <div class="col-md-3">
                <label for="list-tip">Tipuri de mașini</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="types" id="list-types" class="form-control d-block rounded-0">
                    <option value="sedan">Sedan</option>
                    <option value="hatchback">Hatchback</option>
                    <option value="coupe">Coupe</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="offer-type">Tipul ofertei</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="offers" id="offer-types" class="form-control d-block rounded-0">
					          <option value="Chirie">Chirie</option>
                    <option value="Vanzare">Vânzare</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="select-cities">Selectează oraș</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="cities" id="select-cities" class="form-control d-block rounded-0">
                    <option value="bucuresti">Bucuresti</option>
                    <option value="cluj">Cluj</option>
                    <option value="iasi">Iasi</option>
                    <option value="brasov">Brasov</option>
                    <option value="constanta">Constanta</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
              </div>
            </div>
          </form>
        </div>  

        <div class="row">
          <div class="col-md-12">
            <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
              <div class="mr-auto">
                <a href="./" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                <a href="view-list.html" class="icon-view view-list"><span class="icon-view_list"></span></a>
                
              </div>
              <div class="ml-auto d-flex align-items-center">
                <div>
                  <a href="./" class="view-list px-3 border-right active">Toate</a>
                  <a href="rent.php?type=Chirie" class="view-list px-3 border-right">Închiriază</a>
                  <a href="sale.php?type=Vanzare" class="view-list px-3">Cumpără</a>
                </div>


              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
      <div class="site-sectionsite-section-smpb-0"></div>
    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
        <div class="row mb-5">
          <?php foreach($cars as $car) : ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.php?id=<?php echo $car->id; ?>" class="car-thumbnail">
              <div class="offer-type-wrap">

                  <span class="offer-type bg-<?php if ($car->type == "Chirie") {echo "success";} else {echo "danger";}?>"><?php echo $car->type; ?> </span>
                </div>
                <img src="images/<?php echo $car->image; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <h2 class="car-title"><a href="car-details.php?id=<?php echo $car->id; ?>"><?php echo $car->name; ?></a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span><?php echo $car->location; ?></span>
                <strong class="car-price text-primary mb-3 d-block text-success"><?php echo $car->price; ?></strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number"><?php echo $car->seats; ?></span>
                    
                  </li>

                  <li>
                    <span class="car-specs">KM</span>
                    <span class="car-specs-number"><?php echo $car->km; ?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.html" class="car-thumbnail">
              <div class="offer-type-wrap">
                  <span class="offer-type bg-success">Chirie</span>
                </div>
                <img src="images/car4.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <a href="#" class="car-favorite active"><span class="icon-heart-o"></span></a>
                <h2 class="car-title"><a href="car-details.html">Ford Mustang 2024</a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span>B-ul Expozitiei 1B Cluj</span>
                <strong class="car-price text-primary mb-3 d-block text-success">250 RON/ZI</strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number">4 <sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="car-specs">KM</span>
                    <span class="car-specs-number">5000</span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.html" class="car-thumbnail">
                <div class="offer-type-wrap">
                <span class="offer-type bg-danger">Vânzare</span>>
                </div>
                <img src="images/car3.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <a href="#" class="car-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="car-title"><a href="car-details.html">Mercedes AMG GT 2024</a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span>B-ul Expozitiei 1B București</span>
                <strong class="car-price text-primary mb-3 d-block text-success">450 RON/ZI</strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number">2 <sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="car-specs">KM</span>
                    <span class="car-specs-number">7000</span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.html" class="car-thumbnail">
              <div class="offer-type-wrap">
                  <span class="offer-type bg-danger">Vânzare</span>
                </div>
                <img src="images/car5.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <a href="#" class="car-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="car-title"><a href="car-details.html">Volkswagen Jetta 2024</a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span> B-ul Expozitiei 1B Brașov</span>
                <strong class="car-price text-primary mb-3 d-block text-success">150 RON/ZI</strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number">5 <sup>+</sup></span>
                  </li>

                  <li>
                    <span class="car-specs">KM</span>
                    <span class="car-specs-number">6000</span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="car-entry h-100">
              <a href="car-details.html" class="car-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-success">Chirie</span>
                  </div>
                <img src="images/car6.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 car-body">
                <a href="#" class="car-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="car-title"><a href="car-details.html">Mercedes G Class 2024</a></h2>
                <span class="car-location d-block mb-3"><span class="car-icon icon-room"></span>B-ul Expozitiei 1B București</span>
                <strong class="car-price text-primary mb-3 d-block text-success">600 RON/ZI</strong>
                <ul class="car-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="car-specs">Scaune</span>
                    <span class="car-specs-number">5 <sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="car-specs">KM</span>
                    <span class="car-specs-number">4000</span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <div class="site-section-title">
              <h2>Why Choose Us?</h2>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis maiores quisquam saepe architecto error corporis aliquam. Cum ipsam a consectetur aut sunt sint animi, pariatur corporis, eaque, deleniti cupiditate officia.</p>
          </div>
        </div>

     

    <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7">
          <div class="site-section-title text-center">
            <h2>Proprietari Auto</h2>
            <p>Mai jos puteți vedea persoanele care au decis să colaboreze cu pltforma noastră, și au devenit Proprietari Auto.</p>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/eu.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Max Silvestru</h2>
                <span class="d-block mb-3 text-white-opacity-05">Proprietar Auto</span>
                <p>Max Silvestru este un tânăr pasionat de mașini și tehnologie. Deși are doar 21 de ani, el a acumulat o vastă experiență în industria auto, participând la numeroase evenimente și expoziții. Îi place să împărtășească pasiunea sa pentru mașini cu alți oameni și consideră că car sharing-ul este o modalitate excelentă de a face asta. Max este mereu în căutarea celor mai noi și mai inovatoare modele de mașini, astfel încât utilizatorii aplicației de car sharing să aibă acces la cele mai moderne și confortabile vehicule.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/matei1.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Matei Modoran</h2>
                <span class="d-block mb-3 text-white-opacity-05">Proprietar Autor</span>
                <p>Matei Modoran este un antreprenor în devenire, care a văzut o oportunitate în piața car sharing-ului. La vârsta de 24 de ani, Matei a reușit să-și creeze propria flotă de mașini, pe care le pune la dispoziția utilizatorilor prin intermediul aplicației sale. El este cunoscut pentru atenția sa la detalii și pentru asigurarea unei experiențe de încredere și confortabilă pentru toți utilizatorii săi. Matei pune accent pe comunicare și se asigură că toate mașinile sale sunt întreținute în mod regulat și în stare impecabilă.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
            <div class="team-member">

              <img src="images/vadim.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Vadim Panteleiciuc</h2>
                <span class="d-block mb-3 text-white-opacity-05">Proprietar Autor</span>
                <p>Vadim Panteleiciuc este un entuziast al mașinilor sport și al aventurilor pe patru roți. Deși este doar la începutul carierei sale, el are o pasiune puternică pentru automobile și vrea să împărtășească această pasiune cu alții. Vadim este cunoscut pentru flota sa variată de mașini sportive și off-road, pe care le pune la dispoziția utilizatorilor aplicației de car sharing. El crede că fiecare mașină are o poveste de spus și își dorește ca utilizatorii să se bucure de fiecare experiență de conducere.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

        </div>
    </div>
    <?php require "footer.php";