<?php require_once('../Connections/conexioncreacion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conexioncreacion, $conexioncreacion);
$query_DatosSlider = "SELECT * FROM tblslider ORDER BY intOrden ASC";
$DatosSlider = mysql_query($query_DatosSlider, $conexioncreacion) or die(mysql_error());
$row_DatosSlider = mysql_fetch_assoc($DatosSlider);
$totalRows_DatosSlider = mysql_num_rows($DatosSlider);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilladmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administracion AyZWeb</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><?php include("../includes/cabecera_admin.php"); ?></div>
  <div class="sidebar1">
  <?php include("../includes/menuizquierda_admin.php"); ?>

    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>
  <div class="content"><!-- InstanceBeginEditable name="Partederechaadmin" -->
  
  <script>
function asegurar()
{
   rc = confirm("Seguro que desea eliminar?"); 
   return rc;
}
</script>
    <h1>Lista de Publicidades</h1>
    <p><a href="slider_add.php"><img src="images/icono_add.png" width="16" height="16" />A&ntilde;adir Publicidad</a></p>
    <table width="100%" border="0" cellpadding="2" cellspacing="2">
      <tr class="tablacabecera">
        <td>Titulo de Menu</td>
        <td>Imagen</td>
        <td>Orden</td>
        <td>Estado</td>
        <td>Acciones</td>
      </tr>
      <?php do { ?>
  <tr>
    <td><?php echo $row_DatosSlider['strTitulo']; ?></td>
    <td><img src="../images/slider/<?php echo $row_DatosSlider['strImagenPequena']; ?>" width="80" height="50" /></td>
    <td><?php echo $row_DatosSlider['intOrden']; ?></td>
    <td><?php 
	if ($row_DatosSlider['intEstado'] == 1) 
		echo "ACTIVO"; 
	else 
		echo "INACTIVO"; ?></td>
    <td><a href="slider_edit.php?recordID=<?php echo $row_DatosSlider['idContador']; ?>"><img src="images/icono_edit.png" width="16" height="16" /></a>&nbsp;&nbsp;<a href="slider_remove.php?recordID=<?php echo $row_DatosSlider['idContador']; ?>""><img src="images/icono_remove.png" width="16" height="16" onclick="javascript:return asegurar();"/></a></td>
  </tr>
  <?php } while ($row_DatosSlider = mysql_fetch_assoc($DatosSlider)); ?>
    </table>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->
  
    <!-- end .content --></div>
  <div class="footer">
   <?php include("../includes/pie_admin.php"); ?></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosSlider);
?>
