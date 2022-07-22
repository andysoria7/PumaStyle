<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="estilos.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600&display=swap" rel="stylesheet">

  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

  <title> Sobre nosotros</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>
  <nav>
      <a href="visitante-index.php">Inicio ></a>
          <a>Sobre Nosotros</a>
        </nav>

        <section id="hero">
            <div class="container">
              <div class="content-center">
                <h1>
                  Sobre Nosotros
                </h1>
                <h2>
                  Ubicacion de La Empresa
                </h2>
        
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56119.31727020566!2d-65.80798653295749!3d-28.465770821398973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x942428bf1d0f9fcd%3A0x7e1edd4b1609861a!2sSan%20Fernando%20del%20Valle%20de%20Catamarca%2C%20Catamarca!5e0!3m2!1ses-419!2sar!4v1597100002459!5m2!1ses-419!2sar" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        
                <br>
        
                <h2>Acerca de la Empresa</h2>
        
                <br>
        
                <div autocapitalize="center"><a href="#"><img src="img/puma-tienda.jpg" alt="nombre" width="500" height="400" /></a>
                </div>
                <p>
                    Puma es considerada una de las marcas de indumentaria deportiva numero 1 del mundo.
                </p>
        
                <h2>Informacion del Sitio</h2>

                <div autocapitalize="center"><a href="#"><img src="img/infositio.jpg" alt="nombre" width="500" height="400" /></a>
                </div>
        
                <p>Somos PumaStyle, aqui podras encontrar los mejores productos de la marca lider en deportes.
                  A todos nos gusta hacer actividad fisica y vestir bien, ¿Que estas esperando?, ve a la tienda y observa
                  todo lo que tenemos para vos. 

                </p>
        
                <h2>
                    Datos del Administrador
                </h2>
                <p>
                    Correo: asoria@pumastyle.com.ar
        
                </p>
                
                  <h3>Redes sociales</h3>
                  
                  <br>
                            
                  <div autocapitalize="center">
                    <a href="#"><img src="img/facebook.png" alt="nombre" width="70" height="40"/></a>
                    <a href="#"><img src="img/instagram.png" alt="nombre" width="70" height="40" /></a>
                    <a href="#"><img src="img/twitter.png" alt="nombre" width="70" height="40" /></a>
                    
                 </div>

                     <br>
    
              </div>
    
            </div>
        
            <footer style = "text-align: center; background: black;">
                <address>Todos los derechos reservados para PumaStyle</address>
            </footer>
        
        
          </section>
  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>