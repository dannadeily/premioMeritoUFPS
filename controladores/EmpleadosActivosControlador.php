 <?php
  require_once $_COOKIE["ruta"] . '/modelos/EmpleadosActivosModelo.php';
  require_once('../include/conexion_remota_nueva.php');
  require_once $_COOKIE["ruta"] . '/vendor/autoload.php';
  require_once $_COOKIE["ruta"] . '/controladores/AWSControlador.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
  use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
  use \avadim\FastExcelWriter\Excel;

  /**
   *
   */
  class EmpleadosActivosControlador
  {
    private $model;

    function __construct()
    {
      $this->model = new EmpleadosActivosModelo();
    }

    public function insertarExcel()
    {
      require_once $_COOKIE["ruta"] . '/controladores/CompanyControlador.php';
      $companyControlador = new CompanyControlador();
      set_time_limit(900);
      $excel = $_FILES["activos"];
      $ruta = $excel["tmp_name"];
      if (substr($excel["name"], -4) != "xlsx" && substr($excel["name"], -4) != "XLSX") {
        setcookie('formatoInvalido', 'XLSX', '', '/');
        return header('location:../../vistas/EmpleadosActivos.php');
      }
      //busca el nombre de la empresa
      $company = $companyControlador->buscarId($_POST["emp_id"])[0]->socialReason;
      //borra todos los datos de esa tabla
      $this->borrarDatosEmpresa($_POST["emp_id"]);
      //$this->deshabilitarCliente($_POST["emp_id"]);
      //metodo de leer
      $reader = ReaderEntityFactory::createXLSXReader();
      $reader->setShouldPreserveEmptyRows(true);
      $reader->open($ruta);
      $insertados = 0;
      $noinsertados = 0;
      $companyDistinc = array();
      $clienteCompanyDistinct = array();
      $CountCliente = 0;
      $habilitados = 0;
      $cambioEmpresa = 0;
      $reintegro = 0;
      foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
          $cells = $row->getCells();
          $numeroCelular = strval($cells[2]->getValue());
          if (strlen($numeroCelular) == 10 && $numeroCelular[0] == 3) {
            $celularPersonal = $cells[2]->getValue();
          } else {
            $celularPersonal = "";
          }
          if (filter_var($cells[3]->getValue(), FILTER_VALIDATE_EMAIL)) {
            $mail = strtolower($cells[3]->getValue());
          } else {
            $mail = "";
          }
          if (is_numeric($cells[0]->getValue())) {
            $activos = array(
              //datos del excel
              'baac_nombre_cliente' => strtoupper($cells[1]->getValue()), //
              'baac_cargo' => $cells[15]->getValue(), //
              'baac_fecha_ingreso' => $cells[6]->getValue(), //
              'baac_cedula_cliente' => $cells[0]->getValue(), //
              'baac_fecha_nacimiento' => $cells[5]->getValue(), //
              'baac_celular_cliente' => $celularPersonal, //
              'baac_direccion_cliente' => $cells[4]->getValue(), //
              'baac_sueldo' => $cells[8]->getValue(), //no esta en el formato y si en el que pasa la empresa
              'baac_correo_cliente' => $mail,
              'baac_company_id' => $_POST["emp_id"],
              'baac_company' => $company,
              'baac_fecha_retiro' => $cells[7]->getValue(),
              'baac_scoring' => $cells[9]->getValue(),
              'baac_monto_scoring' => $cells[10]->getValue(),
              'baac_centro_costos' => $cells[13]->getValue(),
              'baac_ciudad' => $cells[14]->getValue(),
              'baac_cuenta_banco' => $cells[16]->getValue(),
              'baac_ciclo_nomina' => $cells[17]->getValue(),
              'baac_fecha_pago' => $cells[18]->getValue(),
              'baac_genero' => $cells[19]->getValue()
            );
            if (
              $company == "Emtelco" || $this->model->insertarExcel($activos) > 0
              //| $this->model->actualizarEstado($activos["baac_cedula_cliente"],$_POST["emp_id"])>0
            ) {
              if ($this->model->actualizarEstado($activos["baac_cedula_cliente"], $_POST["emp_id"]) > 0) {
                $id_cliente = $this->model->buscarIdClient($activos["baac_cedula_cliente"])[0]->idClient;
                $habilitados++;
                $this->insertarAuditoria($id_cliente, 1);
              }
              if ($company != "Emtelco") {
                $insertados++;
              }
            } else {
              $datosNoInsertados = $this->buscarActivoCedula($cells[0]->getValue());
              $diferente = array(
                'cedula' => $cells[0]->getValue(),
                'nombre' => $datosNoInsertados[0]->baac_nombre_cliente,
                'empresa' => $datosNoInsertados[0]->baac_company,
                'company' => $company
              );
              $noinsertados++;
              //! hacer el metodo de cambiar de empresa
              $this->model->actualizarEmpresa($company, $cells[0]->getValue(), $_POST["emp_id"]);
              array_push($companyDistinc, $diferente);
              //! cambio el mensaje de la vista por no insertados a cambiados de empresa
            }
            //! aca coloco el llamado al metodo de enviar email
            $datosCliente = $this->clienteDiferenteEmpresa($_POST["emp_id"], $cells[0]->getValue());
            if ($datosCliente[0] != false) {
              $clienteDiferente = array(
                'cedula' => $cells[0]->getValue(),
                'nombre' => $cells[1]->getValue(),
                'empresa' => $datosCliente[0]->socialReason,
                'estado' => $datosCliente[0]->platformState,
                'company' => $company
              );
              $CountCliente++;
              array_push($clienteCompanyDistinct, $clienteDiferente);
            }
            if ($cambioEmpresa == 0 && $this->model->validarEmpresa($company, $cells[0]->getValue()) > 0) {
              $cambioEmpresa++;
            }
            if ($reintegro == 0 && $this->model->reintegro($company, $cells[0]->getValue()) > 0) {
              $reintegro++;
            }
          }
        }
        break;
      }
      //!valida y verifica el correo envia
      if ($cambioEmpresa > 0) {
        $accion = "cambio de empresa";
        $ruta = $this->generarDocumentoCambioEmpresa($accion);
        $this->enviarMail($ruta, $accion);
        unlink($ruta);
      }
      if ($reintegro > 0) {
        $accion = "reintegro";
        $ruta = $this->generarDocumentoReintegro($accion);
        $this->enviarMail($ruta, $accion);
        unlink($ruta);
      }
      $aws = new AWSControlador();
      $aws->guardarS3($_FILES["activos"], "baseactivos/" . $_POST["emp_id"] . "/" . $_FILES["activos"]["name"]);
      $this->guardarArchivo($_FILES["activos"], $company);
      $clientesActivos = $this->verificaClient($_POST["emp_id"]);
      array_pop($clientesActivos);
      foreach ($clientesActivos as $value) {
        $this->deshabilitarCliente($value["idClient"]);
        $this->insertarAuditoria($value["idClient"], 0);
      }
      session_start();
      setcookie('nombreEmpresa', $company, '', '/');
      setcookie('noinsertados', $noinsertados, '', '/');
      setcookie('insertados', $insertados, '', '/');
      setcookie('clienteDiferente', $CountCliente, '', '/');
      setcookie('habilitados', $habilitados, '', '/');
      $_SESSION['descargar'] = $companyDistinc;
      $_SESSION['descargarClienteDiferente'] = $clienteCompanyDistinct;
      return header('location:../../vistas/EmpleadosActivos.php');
    }

    public function borrarDatosEmpresa($id)
    {
      return $this->model->borrarDatosEmpresa($id);
    }

    public function deshabilitarCliente($id)
    {
      return $this->model->deshabilitarCliente($id);
    }

    public function guardarArchivo($archivo, $empresa)
    {
      $directorio = "../base_activos/";
      date_default_timezone_set('America/Bogota');
      $nombre_archivo = $archivo["name"];
      $dir_destino = $directorio . $nombre_archivo;
      move_uploaded_file($archivo["tmp_name"], $dir_destino);
    }
    public function guardarArchivoDeshabilitados($archivo, $empresa)
    {
      $directorio = "../base_retirados/";
      date_default_timezone_set('America/Bogota');
      $nombre_archivo = $archivo["name"];
      $dir_destino = $directorio . $nombre_archivo;
      move_uploaded_file($archivo["tmp_name"], $dir_destino);
    }

    public function descargarClienteDiferente()
    {
      session_start();
      date_default_timezone_set('America/Bogota');
      $fecha = date("y-m-d-G-i-s");
      $lista = $_SESSION["descargarClienteDiferente"];
      $company = $lista[0]["company"];
      $writer = WriterEntityFactory::createXLSXWriter();
      $writer->openToBrowser($company . '_sin_cambios_20' . $fecha . '.xlsx'); // stream data directly to the browser
      $cells = [
        WriterEntityFactory::createCell('cedula'),
        WriterEntityFactory::createCell('nombre'),
        WriterEntityFactory::createCell('estado'),
        WriterEntityFactory::createCell('empresa actual'),
      ];
      $singleRow = WriterEntityFactory::createRow($cells);
      $writer->addRow($singleRow);
      foreach ($lista as $key) {
        if ($key["platformState"] = 1) {
          $estado = 'habilitado';
        } else {
          $estado = 'inhabilitado';
        }
        $cells = [
          WriterEntityFactory::createCell($key["cedula"]),
          WriterEntityFactory::createCell($key["nombre"]),
          WriterEntityFactory::createCell($estado),
          WriterEntityFactory::createCell($key["empresa"])
        ];
        $singleRow = WriterEntityFactory::createRow($cells);
        $writer->addRow($singleRow);
      }
      $writer->close();
    }

    public function descargar()
    {
      session_start();
      date_default_timezone_set('America/Bogota');
      $fecha = date("y-m-d-G-i-s");
      $company = $_SESSION["descargar"][0]["company"];
      $writer = WriterEntityFactory::createXLSXWriter();
      $writer->openToBrowser($company . '_no_registrados' . $fecha . '.xlsx'); // stream data directly to the browser
      $cells = [
        WriterEntityFactory::createCell('cedula'),
        WriterEntityFactory::createCell('nombre'),
        WriterEntityFactory::createCell('empresa anterior'),
      ];
      $singleRow = WriterEntityFactory::createRow($cells);
      $writer->addRow($singleRow);
      foreach ($_SESSION["descargar"] as $key) {
        $cells = [
          WriterEntityFactory::createCell($key["cedula"]),
          WriterEntityFactory::createCell($key["nombre"]),
          WriterEntityFactory::createCell($key["empresa"])
        ];
        $singleRow = WriterEntityFactory::createRow($cells);
        $writer->addRow($singleRow);
      }
      $writer->close();
    }
    public function descargarInhabilitados()
    {
      session_start();
      date_default_timezone_set('America/Bogota');
      $fecha = date("y-m-d-G-i-s");
      $company = $_SESSION["descargarInhabilitados"][0]["company"];
      $writer = WriterEntityFactory::createXLSXWriter();
      $writer->openToBrowser($company . '_no_registrados' . $fecha . '.xlsx'); // stream data directly to the browser
      $cells = [
        WriterEntityFactory::createCell('cedula'),
        WriterEntityFactory::createCell('nombre'),
        WriterEntityFactory::createCell('empresa'),
      ];
      $singleRow = WriterEntityFactory::createRow($cells);
      $writer->addRow($singleRow);
      foreach ($_SESSION["descargarInhabilitados"] as $key) {
        $cells = [
          WriterEntityFactory::createCell($key["cedula"]),
          WriterEntityFactory::createCell($key["nombre"]),
          WriterEntityFactory::createCell($key["empresa"])
        ];
        $singleRow = WriterEntityFactory::createRow($cells);
        $writer->addRow($singleRow);
      }
      $writer->close();
    }
    /**
     *empleadors retirados
     */
    public function DescargarRepetidos()
    {
      session_start();
      date_default_timezone_set('America/Bogota');
      $fecha = date("y-m-d-G-i-s");
      $company = $_SESSION["descargarClientesDiferentes"][0]["company"];
      $writer = WriterEntityFactory::createXLSXWriter();
      $writer->openToBrowser($company . '_sin_cambios_20' . $fecha . '.xlsx'); // stream data directly to the browser
      $cells = [
        WriterEntityFactory::createCell('cedula'),
        WriterEntityFactory::createCell('nombre'),
        WriterEntityFactory::createCell('estado'),
        WriterEntityFactory::createCell('empresa actual'),
      ];
      $singleRow = WriterEntityFactory::createRow($cells);
      $writer->addRow($singleRow);
      foreach ($_SESSION["descargarClientesDiferentes"] as $key) {
        if ($key["platformState"] = 1) {
          $estado = 'habilitado';
        } else {
          $estado = 'inhabilitado';
        }
        $cells = [
          WriterEntityFactory::createCell($key["cedula"]),
          WriterEntityFactory::createCell($key["nombre"]),
          WriterEntityFactory::createCell($estado),
          WriterEntityFactory::createCell($key["empresa"])
        ];
        $singleRow = WriterEntityFactory::createRow($cells);
        $writer->addRow($singleRow);
      }
      $writer->close();
    }


    public function deshabilitarExcel()
    {
      require_once $_COOKIE["ruta"] . '/controladores/CompanyControlador.php';
      $companyControlador = new CompanyControlador();
      $company = $companyControlador->buscarId($_POST["emp_id"])[0]->socialReason;
      set_time_limit(900);
      $excel = $_FILES["activos"];
      $ruta = $excel["tmp_name"];
      if (substr($excel["name"], -4) != "xlsx" && substr($excel["name"], -4) != "XLSX") {
        setcookie('formatoInvalido', 'XLSX', '', '/');
        return header('location:../../vistas/DeshabilitarClientesActivos.php');
      }
      $eliminados = 0;
      $habilitados = 0;
      $reader = ReaderEntityFactory::createXLSXReader();
      $reader->open($ruta);
      $companyDistinc = array();
      $clientCompany = array();
      $CountCliente = 0;
      $deshabilitados = 0;
      $clienteCompanyDistinct = array();
      foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
          $cells = $row->getCells();
          if (is_numeric($cells[0]->getValue())) {
            if ($this->borrarActivos($cells[0]->getValue(), $_POST["emp_id"]) > 0) {
              $eliminados++;
            } else {
              $datosNoInsertados = $this->buscarActivoCedula($cells[0]->getValue());
              if ($datosNoInsertados[0] != false) {
                $diferente = array(
                  'cedula' => $cells[0]->getValue(),
                  'nombre' => $datosNoInsertados[0]->baac_nombre_cliente,
                  'empresa' => $datosNoInsertados[0]->baac_company,
                  'company' => $company
                );
                array_push($companyDistinc, $diferente);
                $habilitados++;
              }
            }
            if ($this->deshabilitarCedula($cells[0]->getValue(), $_POST["emp_id"]) > 0) {
              if (@!empty($id_cliente = $this->model->buscarIdClient($cells[0]->getValue())[0]->idClient)) {
                $deshabilitados++;
                $this->insertarAuditoria($id_cliente, 0, 1);
              }
            }
            $datosCliente = $this->clienteDiferenteEmpresa($_POST["emp_id"], $cells[0]->getValue());
            if ($datosCliente[0] != false) {
              $clienteDiferente = array(
                'cedula' => $cells[0]->getValue(),
                'nombre' => $cells[1]->getValue(),
                'empresa' => $datosCliente[0]->socialReason,
                'estado' => $datosCliente[0]->platformState,
                'company' => $company
              );
              $CountCliente++;
              array_push($clienteCompanyDistinct, $clienteDiferente);
            }
          }
        }
        break;
      }
      $aws = new AWSControlador();
      $aws->guardarS3($_FILES["activos"], "basearetirados/" . $_POST["emp_id"] . "/" . $_FILES["activos"]["name"]);
      $this->guardarArchivoDeshabilitados($_FILES["activos"], $company);
      session_start();
      setcookie('nombreEmpresa', $company, '', '/');
      setcookie('eliminados', $eliminados, '', '/');
      setcookie('deshabilitados', $deshabilitados, '', '/');
      setcookie('habilitados', $habilitados, '', '/');
      setcookie('countClinte', $CountCliente, '', '/');
      $_SESSION['descargarClientesDiferentes'] = $companyDistinc;
      $_SESSION['descargarInhabilitados'] = $companyDistinc;
      return header('location:../../vistas/DeshabilitarClientesActivos.php');
    }

    public function enviarMail($ruta, $accion)
    {
      $mail = new PHPMailer(true);
      try {
        //Si el correo no te llega, quita el comentario
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.sendgrid.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'apikey';
        $mail->Password   = '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';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // Destinatarios
        $mail->setFrom('adrean_cx@hotmail.com');
        $mail->addAddress($this->model->encargadoCartera()->cof_valor);
        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Solicitud ' . $accion;
        $mail->Body    = 'Solicitud de ' . $accion . ' ';
        $mail->addAttachment($ruta);
        $mail->AltBody = 'Version en texto plano del correo (No HTML, no formato)';
        $mail->send();
      } catch (Exception $e) {
        echo "Ocurrio un error: {$mail->ErrorInfo}";
      }
    }
    public function deshabilitarCedula($cedula, $id)
    {
      return $this->model->deshabilitarCedula($cedula, $id);
    }

    public function borrarActivos($cedula, $id)
    {
      return $this->model->borrarActivos($cedula, $id);
    }
    public function insertarAuditoria($id_cliente, $platformState)
    {
      return $this->model->insertarAuditoria($id_cliente, $platformState);
    }

    public function verificaClient($id)
    {
      return $this->model->verificaClient($id);
    }
    public function buscarActivoCedula($cedula)
    {
      return $this->model->buscarActivoCedula($cedula);
    }
    public function clienteDiferenteEmpresa($idCompany, $cedula)
    {
      return $this->model->clienteDiferenteEmpresa($idCompany, $cedula);
    }
    public function generarDocumentoReintegro($accion)
    {
      global $conexionr;
      $sql = "SELECT  s.saba_numero_cedula cedula, saba_full_name  nombre,
      b.baac_fecha_ingreso 'fecha ingreso',b.baac_company 'empresa actual'
      ,s.saba_credito credito
      from vw_sabana_completa s
      join BaseActivos b on (b.baac_cedula_cliente = s.saba_numero_cedula and trim(b.baac_company) = trim(s.saba_empresa))
      where s.saba_sub_estado = 'Mora Directa'
      and saba_dif > 0
      group by credito
      order by credito
      ";
      $datosReporte = mysqli_query($conexionr, $sql) or die(mysqli_error($conexionr) . "Consulta Empresa");
      $datosCamposReporte = mysqli_fetch_fields($datosReporte);
      $datosReporte = mysqli_fetch_all($datosReporte, MYSQLI_ASSOC);
      $columnas = array();
      foreach ($datosCamposReporte as $datoCamposReporte) {
        $columnas[] = $datoCamposReporte->name;
      }
      $nombre = "../base_activos/" . $accion . ".xlsx";
      $excel = Excel::create(['Sheet1']);
      $sheet = $excel->getSheet();
      $sheet->writeRow($columnas);
      $sheet
        ->setColWidths([15, 25, 20, 23, 20]);
      for ($i = 0; $i < count($datosReporte); $i++) {
        $sheet->writeRow($datosReporte[$i]);
      }
      $excel->save($nombre);
      return $nombre;
    }
    public function generarDocumentoCambioEmpresa($accion)
    {
      global $conexionr;
      $sql = "SELECT s.saba_credito credito, s.saba_numero_cedula cedula, saba_full_name  nombre,
              s.saba_fecha_desembolso as 'fecha desembolso' , s.saba_empresa 'empresa origen', 
              b.baac_company 'empresa actual', b.baac_fecha_ingreso 'fecha ingreso',
              s.saba_monto  monto, s.saba_pago_total 'valor total', count(s.saba_credito) 'Cuotas pendientes',
              s.saba_valor_cuota 'valor cuota', saba_cartera 'saldo cartera',
              saba_rango_cartera 'rango cartera', saba_estado_credito estado, saba_sub_estado 'subestado'
              from vw_sabana_completa s
              join BaseActivos b on (b.baac_cedula_cliente = s.saba_numero_cedula and trim(b.baac_company) != trim(s.saba_empresa))
              where s.saba_sub_estado  ='Mora Directa'
              and saba_dif > 0
              group by credito
              order by credito";
      $datosReporte = mysqli_query($conexionr, $sql) or die(mysqli_error($conexionr) . "Consulta Empresa");
      $datosCamposReporte = mysqli_fetch_fields($datosReporte);
      $datosReporte = mysqli_fetch_all($datosReporte, MYSQLI_ASSOC);
      $columnas = array();
      foreach ($datosCamposReporte as $datoCamposReporte) {
        $columnas[] = $datoCamposReporte->name;
      }
      $nombre = "../base_activos/" . $accion . ".xlsx";
      $excel = Excel::create(['Sheet1']);
      $sheet = $excel->getSheet();
      $sheet->writeRow($columnas);
      $sheet
        ->setColWidths([15, 25, 34, 23, 35, 35]);
      for ($i = 0; $i < count($datosReporte); $i++) {
        $sheet->writeRow($datosReporte[$i]);
      }
      $excel->save($nombre);
      return $nombre;
    }
  }
