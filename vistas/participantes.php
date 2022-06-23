<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:../vistas/iniciar.php");
}
if (empty($_GET["conv"])) {
  header("location:../vistas/historial.php");
}
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
require '../controladores/ConvocatoriaControlador.php';
$convocatoria=new ConvocatoriaControlador();
$lista=$convocatoria->informe($_GET["conv"]);
$categoriascon=new ConvocatoriaCategoriaControlador();
$listar=$categoriascon->listar($_GET["conv"]);
$count=count($listar);
?>
  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php';  ?>
    </aside>
    <main id="main" class="main">

    <section class="section">
      </div>
       <div class="row">
       <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Participantes</h5>

             <div class="dropdown">
  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Seleccionar categoria
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <?php for ($i=0; $i <$count-1 ; $i++) { ?>
    <li> <a class="dropdown-item" href="participantes.php?cc=<?php echo $listar[$i]->id; ?>&&conv=<?php echo $_GET["conv"]; ?>&&cat=<?php echo $listar[$i]->id_categoria ?>">
            <?php  echo $listar[$i]->nombre." ".$listar[$i]->rol; ?>
    </a>
  </li>
        <?php    } ?>
  </ul>
</div>
<?php if(isset($_GET["cc"])){ ?>
             <!-- Table with stripped rows -->
             <table class="table datatable">
               <thead>
                 <tr>
                   <th>Nombres</th>
                   <th>Apellidos</th>
                   <th>Codigo</th>
                   <th>Email</th>
                   <th>Rol</th>
                   <th>Postulacion</th>
                   <th>Nota</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i <count($lista)-1 ; $i++) {
                   if($lista[$i]->id_convocatoria_categoria==$_GET["cc"]){
                   ?>


                         <td><?php echo $lista[$i]->nombres ?> </td>
                         <td><?php echo $lista[$i]->apellidos ?> </td>
                         <td><?php echo $lista[$i]->codigo_usuario ?> </td>
                         <td><?php echo $lista[$i]->email ?> </td>
                         <td><?php echo $lista[$i]->rol ?> </td>
                         <td><?php echo $lista[$i]->fecha_postulacion ?> </td>
                         <td><?php echo $lista[$i]->calificacion ?> </td>
                       </tr>

                <?php } } ?>
               </tbody>
             </table>
           <?php } ?>
           </div>
         </div>
       </div>
       </div>
     </section>

  </main>
    <footer>
      <?php include 'footer.php'; ?>
    </footer>
