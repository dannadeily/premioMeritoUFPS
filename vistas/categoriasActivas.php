<?php
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
require_once '../controladores/CategoriaControlador.php';
require_once '../controladores/DocumentoControlador.php';
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])||($_SESSION['rol']!="Estudiante"&&$_SESSION['rol']!="Egresado")) {
  header("location:iniciar.php");
}
$documento=new DocumentoControlador();
$categoriascon=new ConvocatoriaCategoriaControlador();
$categoria=new CategoriaControlador();
if (isset($_GET['cat']) && !empty($_GET['cat'])) {
  $lista=$categoria->listar($_GET["cat"]);
  $documentos=$documento->listar();
  $contarDocumentos=count($documentos);
}
$listar=$categoriascon->listar($_GET["id"]);
$count=count($listar);
 ?>


 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/categoriasActivas.css">
     <title>convocatorias vigentes</title>
   </head>
   <body>

     <main id="main" class="main">
     <header>
       <?php include 'HeaderLogin.php'; ?>
     </header>
       <aside class="">
         <?php include 'barraLateralUsuario.php'; ?>

       </aside>

        <div class="div-activar">
          <br>
          <legend>Seleccione categoria</legend>
           <hr>

       <section id="container-activar">

         <nav>

         <table id="costumers-activar">

         <?php
         for ($i=0; $i <$count-1 ; $i++) {
           if ($listar[$i]->rol==$_SESSION["rol"]) {
             // code...

          ?>

          <tr>
            <td> <a class="a-class"
              href="categoriasActivas.php?cc=<?php echo $listar[$i]->id; ?>&&id=<?php echo $_GET["id"]; ?>&&cat=<?php echo $listar[$i]->id_categoria ?>">
               <?php  echo $listar[$i]->nombre; ?> <i class="fas fa-angle-right"></i></a>
             </td>
          </tr>
          <?php

       }   } ?>

          </table>

        </nav>


          <div class="article-activar">

          <?php if(isset($_GET['cat']) && !empty($_GET['cat'])){ ?>
          <p class="p-activar">
            <hr>
              <h4>Descripcion:</h4>
            <?php ?> <h6 class="h6-class"> <?php echo  $lista[0]->descripcion;?> <h6> <?php?>
              <br>
              <h4>Documentos Requeridos:</h4>
            <?php for ($i=0; $i <$contarDocumentos-1 ; $i++) {

              if($_GET['cat']==$documentos[$i]->id_categoria){  ?>

                <ul>

                  <li>
                    <h6 class="h6-class" > <?php echo $documentos[$i]->nombre ; ?> : </h6>
                    <h6 class="h6-class">   <?php echo $documentos[$i]->descripcion ; ?> </h6>
                  </li>

                </ul>

          <?php    }
            } ?>
              <hr>
          </p>


          <button class="button-categoriasActivas" type="button" onclick="location.href='subirDocumentos.php?cc=<?php echo $_GET['cc'] ?>&con=<?php echo $_GET['id'] ?>&id=<?php echo $_GET['cat'] ?>'" name="button"> continuar </button>
        <?php } ?>


      </div>
       </section>

</div>
</main> 
       <footer>
         <?php include '../footer.php'; ?>
       </footer>

     </body>
