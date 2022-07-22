
<?php

$fotoch=$_POST['fotoch'];
$cate_id=$ultimo_id;
$target_dir = "img/cate_".$cate_id.'_';
                    $target_file = $target_dir . basename($_FILES["fotoch"]["name"]);
$target_file_paradb = $target_dir . basename($_FILES["fotoch"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fotoch"]["tmp_name"]);
                        if($check !== false) {
                            $m_error = "El archivo es una imagen - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            $m_error =  "El archivo NO es una imagen.";
                            $uploadOk = 0;
                        }
                    }
                    // Check if file already exists
                   
                    /*if (file_exists($target_file)) {
                        echo "El archivo ya existe.".$_FILES["prod_fotolugar"]["name"];
                        $uploadOk = 0;
                    }*/
                    // Check file size
                    if ($_FILES["fotoch"]["size"] > 5000000) {
                        $m_error =  "El archivo es demasiado grande.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $m_error =  "Solo JPG, JPEG, PNG & GIF son aceptados.".basename($_FILES["fotoch"]["name"]).' - '.$imageFileType;
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $m_error =  "El archivo no pudo ser subido.";
                    // if everything is ok, try to upload file
                    } else {
                        //borramos el existente si hay
                         if(unlink($fotoch)){
                              // echo 'El archivo "'.$prod_fotoperfil.'" fue eliminado';
                             }
                        //***********************
                        if (move_uploaded_file($_FILES["fotoch"]["tmp_name"], $target_file)) {
                            //echo "El archivo ". basename( $_FILES["prod_fotolugar"]["name"]). " FUE SUBIDO";
                            $subido=1;
                        } else {
                            $m_error =  "Error subiendo el archivo.";
                        }
                    }
               
               
                    if($subido==1){
                          $sql='update categorias set cate_imagen="'.$target_file_paradb.'" where cate_id="'.$cate_id.'"';
                       $result=mysqli_query($link,$sql);
                        //Si la consulta imprime el error de la consulta
                        if(!$result){
                            $m_error = 'no se pudo actualizar el nombre de la imagen en la db.';
                        }
                        //De lo contrario regresa al index
                        else{
                            //echo 'Guardado en DB';

                            $m_error = 'imagen actualizada correctamente';
                        }
                    }
                    
?>
