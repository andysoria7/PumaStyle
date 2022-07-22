         <?php 
         if($_SESSION['usu_tipo']==2){
        echo '<ul class="navbar-nav mr-auto">
                 
                      <a href="ver_carrito.php"><img src="img/carrito.png" class="logo-carrito" alt="logo"></a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="icon ion-md-menu"></i>
                      </button>
                </ul>';
              }
              ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php
                echo $_SESSION['apellido'].', '.$_SESSION['nombre'];
                if($_SESSION['usu_tipo']==1){
                  echo ' (Admin)';
                }else{
                  echo ' (Cliente)';
                }
              ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php 

              if($_SESSION['usu_tipo']==1){
              echo '<a class="dropdown-item" href="admin-usuarios.php">Usuarios</a>
                  <a class="dropdown-item" href="admin-productos.php">Productos</a>
                  <a class="dropdown-item" href="estadisticas.php">Estadísticas</a>
                  
                  <a class="dropdown-item" href="admin-categorias.php">Categorias</a>
                  <a class="dropdown-item" href="cambiar_pass.php">Cambiar Pass</a>
                <a class="dropdown-item" href="logout.php">Salir</a>
              ';
              }else{
              echo '
                  <a class="dropdown-item" href="ver_carrito.php">Ver Carrito</a>
                  <a class="dropdown-item" href="ver_mis_compras.php">Ver mis compras</a>
                  <a class="dropdown-item" href="cambiar_pass.php">Cambiar Pass</a>
                <a class="dropdown-item" href="logout.php">Salir</a>
              ';
              echo'</div>';
             
              }
              ?>
            </li>
          </ul>