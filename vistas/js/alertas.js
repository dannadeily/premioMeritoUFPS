function mensaje(alerta){
  if( alerta=="incorrecto"){
    swal({
  title: "Datos incorrectos",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="incompletos"){
    swal({
  title: "Datos incompletos",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="existe"){
    swal({
  title: "el usuario ya existe",
  icon: "warning",
  dangerMode: true,
    });
  }
  if( alerta=="registrado"){
    swal({
  title: "registro realizado con exito",
  icon: "success",
  dangerMode: true,
    });
  }
  if( alerta=="actualizado"){
    swal({
  title: "actualización exitosa",
  icon: "success",
  dangerMode: true,
    });
  }
  if( alerta=="fechamenor"){
    swal({
      title: "Fechas incorrectas",
  text: "la fecha de inicio de inicio debe ser mayor a la fecha actual y la fecha de inicio de inicio debe ser menor a la fecha de cierre",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="errorimagen"){
    swal({
  title: "ha ocurrido un error con la imagen",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="tamañomayor"){
    swal({
  title: "formato invalido o tamaño del archivo superior a 5mb",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="borrado"){
    swal({
  title: "eliminado con exito",
  icon: "success",
  dangerMode: true,
    });
  }
  if( alerta=="noborrado"){
    swal({
  title: "no se ha podido eliminar",
  icon: "error",
  dangerMode: true,
    });
  }
  if( alerta=="tamañosmayores"){
    swal({
  title: "formato invalido o tamaño del archivo superior a 5mb",
  icon: "error",
  dangerMode: true,
    });
}
if( alerta=="calificacion"){
  swal({
title: "calificacion añadida",
icon: "success",
dangerMode: true,
  });
}
if( alerta=="tarde"){
  swal({
title: "intente mas tarde",
icon: "error",
dangerMode: true,
  });
}
if( alerta=="enviado"){
  swal({
title: "enviado correctamente",
text: "revise su email",
icon: "success",
dangerMode: true,
  });
}
}
