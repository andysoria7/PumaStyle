<?php
session_start();
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    $errors = [];
    $errorMessage = '';

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    if (empty($nombre)) {
        $errors[] = 'Ingrese el Nombre';
    }

    if (empty($apellido)) {
        $errors[] = 'Ingrese el Apellido';
    }

    if (empty($email)) {
        $errors[] = 'Ingrese el Email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'El Email es Invalido';
    }

    if (empty($mensaje)) {
        $errors[] = 'Ingrese el Asunto';
    }


    if (!empty($errors)) {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    } else {
        $mail = new PHPMailer();

        // specify SMTP credentials
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'aac66761eb18ce';
        $mail->Password = '13c5d7abafde8a';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        $mail->setFrom($email, 'Mailtrap Website');
        $mail->addAddress('andys7778@gmail.com', 'Me');
        $mail->Subject = 'New message from your website';

        // Enable HTML if needed
        $mail->isHTML(true);

        $bodyParagraphs = ["Nombre: {$nombre}", "Apellido: {$apellido}", "Email: {$email}", "Mensaje:", nl2br($mensaje)];
        $body = join('<br />', $bodyParagraphs);
        $mail->Body = $body;

        echo $body;
        if($mail->send()){

            header('Location: contacto.php'); // redirect to 'thank you' page
        } else {
            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}

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

  <title>Contacto</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>
  <nav>
      <a href="visitante-index.php">Inicio ></a>
          <a>Contacto</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">

        <h2>
          Contacto
        </h2>
        <br>

        <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>

        <form action="contacto.php" method="post" class="form">
          
        
        <table>
          
            <tr>
              
                <td>
                  
                    <label for="nombres">Nombres(*)</label> 
                </td>
                
                
                <td>   
                    <input type=text name="nombre" id="nombres" placeholder="Ingrese el nombre">
                    
                </td>
                
            </tr>

            <tr>
                <td>
                     <label for="apellidos">Apellidos(*)</label></td>
                 <td>   <input type=text name="apellido" id="apellidos" placeholder="Ingrese el apellido">
                 </td>
            </tr>

            <tr>
                <td>
                     <label for="email">Email(*)</label>
                </td>
                 <td>   
                     <input type=email name="email" id="email" placeholder="Ingrese el email">
                 </td>
            </tr>

            <tr>
                <td>
                     <label for="asunto">Asunto(*)</label>
                </td>
                 <td>   
                     <textarea name="mensaje" id="asunto" cols="30" rows="10"></textarea> 
                     
                 </td>
                 
                 
            </tr>
            <tr>
                <td>
                  <input type="reset" class="btn btn-danger" value="Borrar">
                </td>
                <td>
                     <input type="submit" name="enviar" value="Enviar" class="btn btn-success"></td>
            </tr>
            
        </table>

        </form>

        <br>

        <p>(*)Datos oblgatorios</p>


      </div>

    </div>

    <footer class="footer">
      <address>Todos los derechos reservados a PumaStyle</address>
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