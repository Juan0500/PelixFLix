<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PELIX FLIX</title>
  <script src="../js/sweetalert2.all.min.js"></script>
</head>
<body>
  
</body>

<?php
session_start();
  // INCLUIMOS LA CAPA DATOS O SUPERCLASE
  include ("../Datos/Datos_Peliculas.php");
  //CREAMOS LA INSTANCIA DATOS O SUPERCLASE
  $Proyecto= new Peliculas();
  //PELICULA
  // PREGUNTAMOS SI ES LA OPERACION DE CREATE (AGREGAR)
  if($_POST['crud']=="G_Peliculas"){
      $Titulo = $_POST['Titulo'];
      $Productora = $_POST['Productora'];
      $Actores = $_POST['Actores'];
      $Descripcion = $_POST['Descripcion'];
      $URL_Trailer=$_POST['URL_Trailer'];
      $URL_Pelicula=$_POST['URL_Pelicula'];
      $Genero = $_POST['Genero'];
      $Fecha_Estreno = $_POST['Fecha_Estreno'];

      
      if($_FILES['image1']['tmp_name'] == null && $_FILES['image2']['tmp_name'] == null) {
          $Image1 = null;
          $Image2 = null;
      }
      else {
          /***********************************************************/
              //CON IMAGEN
              if(isset($_POST) && !empty($_POST)){
                  /*CALCULAMOS LA IMAGEN*/
                  if(isset($_POST["submit"])){
                      $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
                      $check2 = getimagesize($_FILES["image2"]["tmp_name"]);
                      if($check1 !== false &&  $check2 !== false){
                      $image1 = $_FILES['image1']['tmp_name'];
                      $image2 = $_FILES['image2']['tmp_name'];
                      $imgContent1= addslashes(file_get_contents($image1));
                      $imgContent2= addslashes(file_get_contents($image2));
                      $Image1 = $imgContent1;	
                      $Image2 = $imgContent2;	
                      }
                  }
              }
          /***********************************************************/
          
      }

      $res = $Proyecto->create_Pelicula($Genero, $Titulo, $Productora, $Actores, $Descripcion, $Fecha_Estreno, $Image1, $Image2,  $URL_Trailer, $URL_Pelicula);
      if($res){
          ?>
          <script>
              Swal.fire({
                  title:'Pelicula Guardado con éxito !',
                  icon:'success',
                  showConfirmButton:false,
                  allowOutsideClick: false,
                  timer:1500,
                  timerProgressBar:true
              });
              setTimeout(function () {
                  window.location="../MenuAdmin.php?/=UGVsaWN1bGE=";
              },1300); 
          
      
          </script>
          <?php
      }else{
          ?>
          <script>
              Swal.fire({
                  title:'Error al Guardar la Pelicula!',
                  icon:'error',
                  showConfirmButton:false,
                  allowOutsideClick: false,
                  timer:1500,
                  timerProgressBar:true
              });
              setTimeout(function () {
                  window.location="../MenuAdmin.php?/=UGVsaWN1bGE=";
              },1300); 
          
      
          </script>
          <?php
      }	
  }
  //MODIFICAR PELICULA
  if($_POST['crud']=="M_Peliculas"){
    if(isset($_POST) && !empty($_POST)){
      //CARGO LAS VARIABLES Y LLAMO LA FUNCION Update CON FOTO DE LA CLASE peliculas		
      $Titulo = $_POST['Titulo'];
      $Productora = $_POST['Productora'];
      $Actores = $_POST['Actores'];
      $Descripcion = $_POST['Descripcion'];
      $Genero = $_POST['Genero'];
      $URL_Trailer = $_POST['URL_Trailer'];
      $URL_Film = $_POST['URL_Film'];
      $Fecha_Estreno = $_POST['Fecha_Estreno'];
      $IDPelicula=intval($_POST['IDPelicula']);
      //VERIFICAR SI VIENE CON LAS DOS IMAGENES
      if ($_FILES["image1"]["tmp_name"] != null && $_FILES["image2"]["tmp_name"] != null){  
        /*CALCULAMOS LA IMAGEN*/
        if(isset($_POST["submit"])){
          $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
          $check2 = getimagesize($_FILES["image2"]["tmp_name"]);
          if($check1 !== false && $check2 !== false){ 
            $image1 = $_FILES['image1']['tmp_name'];
            $image2 = $_FILES['image2']['tmp_name'];
            $imgContent1 = addslashes(file_get_contents($image1));
            $imgContent2 = addslashes(file_get_contents($image2));
            $Image1 = $imgContent1;	
            $Image2 = $imgContent2;	
          }
        }
        $res = $Proyecto->updateCFDoble_Pelicula($Titulo, $Productora, $Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film, $Fecha_Estreno,$Image1, $Image2, $IDPelicula);
      }
      //VERIFICAR SI VENE SOLO CON IMAGEN CHICA
      else if ($_FILES["image1"]["tmp_name"] != null)
      {  
        /*CALCULAMOS LA IMAGEN*/
        if(isset($_POST["submit"])){
          $check = getimagesize($_FILES["image1"]["tmp_name"]);
          if($check !== false){
            $image = $_FILES['image1']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            $Image = $imgContent;	
          }
        }
        $res = $Proyecto->updateCFChica_Pelicula($Titulo, $Productora, $Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film, $Fecha_Estreno,$Image,$IDPelicula);
      }
      //VERIFICAR SI VIENE SOLO CON IMAGEN GRANDE
      else if ($_FILES["image2"]["tmp_name"] != null)
      {
        /*CALCULAMOS LA IMAGEN*/
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["image2"]["tmp_name"]);
            if($check !== false){
            $image = $_FILES['image2']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

                $Image = $imgContent;	
            }
        }
          
        $res = $Proyecto->updateCFGrande_Pelicula($Titulo, $Productora, $Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film, $Fecha_Estreno,$Image,$IDPelicula);
      } 
      //SI VIENE SIN IMAGENES
      else
      {
        $res = $Proyecto->updateSF_Pelicula($Titulo, $Productora, $Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film, $Fecha_Estreno, $IDPelicula);
      } 
      if($res){
        ?>
        <script>
          Swal.fire({
            title:'Pelicula Modificada con éxito !',
            icon:'success',
            showConfirmButton:false,
            allowOutsideClick: false,
            timer:1500,
            timerProgressBar:true
          });
          setTimeout(function () {
            window.location="../MenuAdmin.php?/=UGVsaWN1bGE=";
          },1300); 
        </script>
        <?php
      }else{
          ?>
          <script>
              Swal.fire({
                  title:'Error al Modificar la Pelicula!',
                  icon:'error',
                  showConfirmButton:false,
                  allowOutsideClick: false,
                  timer:1500,
                  timerProgressBar:true
              });
              setTimeout(function () {
                  window.location="../MenuAdmin.php?/=UGVsaWN1bGE=";
              },1300); 
          </script>
          <?php
      } 
    }
  }              
?>
     