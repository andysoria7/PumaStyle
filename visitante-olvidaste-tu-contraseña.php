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

  <title>¿Olvido la clave?</title>

</head>

<body>

  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a href="visitante-index.php"><img src="img/nikepng.png" class="logo-nike" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon ion-md-menu"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="visitante-iniciar-sesion.php" id="iniciosesion">Iniciar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="visitante-tienda.php" id="noticias">Tienda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="visitante-contacto.php" id="plantel">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="visitante-sobrenosotros.php" id="tienda">Sobre Nosotros</a>
          </li>
        
          
        </ul>
        <div>
        </div>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
      </div>
  </nav>

  <nav>
      <a href="visitante-index.php">Inicio ></a>
      <a href="iniciar-sesion.php">Iniciar Sesion ></a>
      <a>¿Olvidaste tu Contraseña?</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">
       
        <h2>
            Recuperacion De Contraseña

        </h2>
        <table> 
            <tr>
                <td>
                    <label for="email"> Ingrese el Email Con el Cual Registro La Cuenta</label>
                </td>
                <td>
                    <input type="email" name="email" id=email>
                </td>
                
            </tr>

            <tr>
              <td>
                    <button onclick="alertarecuperar()">Recuperar Contraseña</button>

                    <script>
                     function alertarecuperar() {
                     alert("Se Ha Recuperado la Contraseña, Revise su Email");
                     }
                     </script>
              </td>
          </tr>

        </table>

      </div>

    </div>

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