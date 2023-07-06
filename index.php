<?php

$servername = "localhost";
$db = "DATABASE";
$username = "DB_USERNAME";
$password = "PASSWORD";


function getLikes($conn,$id){
    $likes = $conn->prepare('SELECT likes FROM reviews WHERE id = :id');
    $likes->bindValue(':id',$id , PDO::PARAM_INT);
    $likes->execute();
    return $likes->fetch(PDO::FETCH_ASSOC)['likes'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postVal = $_POST['id'];
    $id = filter_var($postVal, FILTER_SANITIZE_NUMBER_INT);

  if ($id) {
     
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  

    $user_likes = getLikes($conn,$id);

    $add_likes = $conn->prepare('UPDATE reviews SET likes = :new_like WHERE id = :id');
    $add_likes->bindValue(':id',$id , PDO::PARAM_INT);
    $likeVal = 0;
    if($postVal === 'l_'.$id){
        $likeVal = $user_likes+1;
        setcookie("liked_".$id, 1, time() + (86400 * 365), "/");
    }else{
        $likeVal = $user_likes-1;
        setcookie("liked_".$id, "", time() - 3600);
    }
    $add_likes->bindValue(':new_like',$likeVal, PDO::PARAM_INT);
    $add_likes->execute();

    echo getLikes($conn,$id);

    $conn = null;
 
    } catch(PDOException $e) {
    echo "Error to save like.";
    }
    
    }
  
  
}else{
    
    
?><!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BA Bus - Codo a Codo</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <div class="container header-container">
    <header class="d-flex flex-wrap justify-content-center py-3">

      <div class="header_content">
        <a href="" id="logo-container"
          class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <img id="logo" src="img/logo.png" alt="Destinos BA" title="Destinos BA" width="256" height="256">
          <span class="fs-4 logo_txt">BA Bus</span>
        </a>


        <ul class="nav nav-pills">
          <li class="nav-item"><a href="#" class="nav-link">Viajar en BA Bus</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Micros</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Recorridos</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Servicios</a></li>
          <li class="nav-item"><a href="#ticket-prices" class="nav-link active" aria-current="page">Tickets</a></li>
        </ul>
      </div>
    </header>
  </div>


  <main>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active"
          aria-current="true"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
      </div>

      <div class="carousel-inner">

        <div class="carousel-item">

          <img class="slide-image" src="img/bsas.jpg" alt="Buenos Aires" title="Buenos Aires" width="1500" height="500">
          <div class="container">
            <div class="carousel-caption">
              <h2>Buenos Aires</h2>
              <p class="description">Buenos Aires es la gran capital cosmopolita de Argentina. Su centro es la Plaza de
                Mayo, rodeada de imponentes edificios del siglo XIX, incluida la Casa Rosada, el icónico palacio
                presidencial que tiene varios balcones.</p>
              <div class="buttons-container">
                <a class="btn btn-outline-light" href="#">Ver más</a>
                <a class="btn btn-primary" href="#">Desde $2000</a>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-item active">

          <img class="slide-image" src="img/mardel.jpg" alt="Mar del Plata" title="Mar del Plata" width="1500"
            height="500">

          <div class="container">
            <div class="carousel-caption">
              <h2>Mar del Plata</h2>
              <p class="description">Mar del Plata es una ciudad balnearia argentina en la costa del Atlántico. Su larga
                franja de playas incluye la amplia Punta Mogotes y Playa Grande, con sus rompientes para el surf. Detrás
                de Playa Grande, las calles rodeadas de árboles del barrio Los Troncos tienen elegantes casas de
                comienzos del siglo XX, que ahora son museos.</p>

              <div class="buttons-container">
                <a class="btn btn-outline-light" href="#">Ver más</a>
                <a class="btn btn-primary" href="#">Desde $3500</a>
              </div>

            </div>
          </div>
        </div>

        <div class="carousel-item">
          <img class="slide-image" src="img/cordoba.jpg" alt="Córdoba" title="Córdoba" width="1500" height="500">

          <div class="container">
            <div class="carousel-caption">
              <h2>Córdoba</h2>
              <p class="description">Córdoba, la capital de la provincia argentina del mismo nombre, es conocida por su
                arquitectura colonial española. Alberga la Manzana Jesuítica, un complejo del siglo XVII con claustros
                activos, iglesias y el campus original de la Universidad Nacional de Córdoba, una de las universidades
                más antiguas de Sudamérica.</p>
              <div class="buttons-container">
                <a class="btn btn-outline-light" href="#">Ver más</a>
                <a class="btn btn-primary" href="#">Desde $5500</a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

    </div>



    <section class="container marketing">
      <div class="marketing-title-cont">
        <h3>Viajá a tu medida</h3>
        <p class="subtitle">¡Elegí la opción que más te guste y preparate para viajar!</p>
      </div>

      <div class="row categories_container">

        <div class="col-lg-4">

          <img class="categories-img" src="img/economic.jpeg" alt="Economic" title="Economic" width="500" height="500">

          <h4 class="fw-normal">Economic</h4>
          <p class="description">Some representative placeholder content for the three columns of text below the
            carousel. This is the first
            column.</p>
          <p><a class="btn btn-secondary categories-price-button" href="#">Desde $1500</a></p>
        </div>

        <div class="col-lg-4">

          <img class="categories-img" src="img/standard.jpg" alt="Standard" title="Standard" width="500" height="500">

          <div class="recommended-container">
            <h4 class="fw-normal">Standard</h4><span class="badge badge-success recommended-badge">Recomendado</span>
          </div>
          <p class="description">Another exciting bit of representative placeholder content. This time, we've moved on
            to the second column.
          </p>
          <p><a class="btn btn-secondary categories-price-button" href="#">Desde $1850</a></p>
        </div>

        <div class="col-lg-4">

          <img class="categories-img" src="img/executive.jpg" alt="Executive" title="Executive" width="500"
            height="500">

          <h4 class="fw-normal">Executive</h4>
          <p class="description">And lastly this, the third column of representative placeholder content.</p>
          <p><a class="btn btn-secondary categories-price-button" href="#">Desde $2000</a></p>
        </div>

      </div>





      <div class="row featurette our_buses_cont">

        <div class="col-md-7 order-md-2 our_buses_desc_cont">
          <h4 class="featurette-heading fw-bold lh-1">Transportes de confianza</h4>
          <p class="lead our_buses_txt description">La seguridad de nuestros pasajeros y tripulación es el pilar
            fundamental para el desarrollo de nuestro trabajo. Por ello las constantes revisiones técnicas de nuestras
            unidades, la incorporación permanente de tecnología, el personal altamente capacitado y el respaldo de
            marcas como Volvo (empresa sueca líder mundial en seguridad automotriz) y Michelín (prestigiosa empresa
            mundial de fabricación de neumáticos y llantas). Esto nos permite alcanzar los estándares más altos de
            calidad.</p>
          <a class="btn btn-lg btn-outline-light our_buses_btn" href="#">Conocer más</a>
        </div>

        <div class="col-md-5 order-md-1 our_buses_img_cont">

          <img class="our_buses_img" src="img/bus.jpg" alt="Buses" title="Buses" width="400" height="400">

        </div>

      </div>


    </section>



    <section>
      <div class="marketing-title-cont">
        <h3>Viajes Especiales</h3>
        <p class="subtitle">Ponemos a su alcance un exclusivo servicio de contratación para que usted, su Agencia de
          Turismo o Empresa cuente con la seguridad, confort y garantía que ofrecemos en todos nuestros viajes.</p>
      </div>

      <div class="form_container">
        <p class="form_txt">Le invitamos a completar el formulario a continuación y nuestro equipo se pondrá en contacto
          para darle el
          mejor asesoramiento.</p>


        <form action="">
          <div class="aligned-inputs">
            <input type="text" class="form-control" placeholder="Nombre">
            <input type="text" class="form-control" placeholder="Apellido">
          </div>

          <div class="textarea_container">
            <textarea type="textarea" class="form-control" placeholder="Contanos cómo podemos ayudarte"></textarea>
            <small id="emailHelp" class="form-text text-muted">Brindanos todos los detalles del servicio que
              necesitás.</small>
          </div>

          <button type="submit" class="btn btn-primary">Enviar mensaje</button>
        </form>
      </div>
    </section>

    <section id="ticket-prices">


      <div class="box-container">

        <div class="ticket-box-container">
          <div class="ticket-box student">
            <h5>Estudiante</h5>
            <p>Tienen un descuento</p>
            <p><strong>80%</strong></p>
            <p class="clarification">* presentar documentación</p>
          </div>
        </div>

        <div class="ticket-box-container">
          <div class="ticket-box trainee">
            <h5>Trainee</h5>
            <p>Tienen un descuento</p>
            <p><strong>50%</strong></p>
            <p class="clarification">* presentar documentación</p>
          </div>
        </div>

        <div class="ticket-box-container">
          <div class="ticket-box junior">
            <h5>Junior</h5>
            <p>Tienen un descuento</p>
            <p><strong>15%</strong></p>
            <p class="clarification">* presentar documentación</p>
          </div>
        </div>

      </div>



      <div class="form_container">

        <h3 class="tickets-title">Comprar tickets</h3>

        <form action="" onsubmit="event.preventDefault();">
          <div class="tickets-inputs">
            <input type="text" class="form-control medimum" placeholder="Nombre">
            <input type="text" class="form-control medimum" placeholder="Apellido">
            <input type="email" class="form-control" placeholder="Correo electrónico">

            <div class="medimum">
              <p>Recorrido</p>
              <select name="route" id="route" class="form-control">
                <option value="bsas-cor">Buenos Aires - Córdoba</option>
                <option value="cor-bsas">Córdoba - Buenos Aires</option>
                <option value="bsas-mar">Buenos Aires - Mar del plata</option>
                <option value="mar-bsas">Mar del plata - Buenos Aires</option>
              </select>
            </div>

            <div class="medimum">
              <p>Categoría</p>
              <select name="category" id="category" class="form-control">
                <option value="economic">Economic</option>
                <option value="standard">Standard</option>
                <option value="executive">Executive</option>
              </select>
            </div>

            <div class="medimum">
              <p>Cantidad</p>
              <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Máximo 10 tickets"
                min="1" max="10" value="1">
            </div>

            <div class="medimum">
              <p>Promoción</p>
              <select name="promotion" id="promotion" class="form-control">
                <option value="none">-</option>
                <option value="student">Estudiante</option>
                <option value="trainee">Trainee</option>
                <option value="junior">Junior</option>
              </select>
            </div>

          </div>


          <div class="total-price-container">
            <p>Total a pagar: <span id="price">$0</span></p>
          </div>

          <div class="form-buttons">
            <button id="reset" class="btn btn-primary ticket-btn">Restablecer</button>
            <button id="resume" class="btn btn-primary ticket-btn">Resumen</button>
          </div>
        </form>

      </div>

    </section>
    


    <section id="reviews"><hr>

    <h4 class="reviews-title" id="latest_reviews">Últimas reseñas</h4>

    
     <?php

try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  
 foreach($conn->query('SELECT * from reviews ORDER BY date DESC') as $data) {
     
        ?>
        <div class="review-container">
            <div>
      <img class="review-avatar" src="/img/users_avatar/<?php echo strtolower($data['name'])?>.jpg" alt="review-avatar" title="<?php echo $data['name']?>" width="50" height="50">
      </div>
      <div>
      <p class="review-name"><?php echo $data['name']?></p>
      <div class="rating-container">
          <div>
          <?php
          for ($x = 0; $x < $data['rating']; $x++) {
  echo '<span class="fa fa-star checked"></span>';
}
          for ($y = $data['rating']; $y < 5; $y++) {
  echo '<span class="fa fa-star"></span>';
}
?>

      </div><span class="review_date"><?php echo $data['date']?></span></div>
      <p><?php echo $data['comment']?></p>
      

 <div class="like_review">
     <div>
     <i class="fa fa-heart-o heart" id="<?php echo 'l_'.$data['id']?>"onclick="like(this.id)"></i>
     <i class="fa fa-heart heart" id="<?php echo 'nl_'.$data['id']?>" onclick="nlike(this.id)"></i>
 </div>
     <span id="<?php echo 'likes_'.$data['id']?>"><?php echo $data['likes']?></span>
 </div>
      </div>
    </div>
    
        <?php
    }
    $conn = null;
 
} catch(PDOException $e) {
  echo "Error to load reviews.";
}


?>
 
  </section>
    
    
  </main>

  <footer>
    <div class="footer_content">
      <div>
        <a href="">FAQs</a>
        <a href="">Contacto</a>
        <a href="">Prensa</a>
        <a href="">Conferencias</a>
      </div>
      <div>
        <a href="">Condiciones de servicio</a>
        <a href="">Privacidad</a>
        <a href="">Estudiantes</a>
      </div>
    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>

</body>

</html>
<?php
    
    
}


