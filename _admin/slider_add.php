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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblslider (strImagenGrande, strImagenPequena, strTitulo, strSubtitulo, strMenu, strLink, intOrden, intEstado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strImagenGrande'], "text"),
                       GetSQLValueString($_POST['strImagenPequena'], "text"),
                       GetSQLValueString($_POST['strTitulo'], "text"),
                       GetSQLValueString($_POST['strSubtitulo'], "text"),
                       GetSQLValueString($_POST['strMenu'], "text"),
                       GetSQLValueString($_POST['strLink'], "text"),
                       GetSQLValueString($_POST['intOrden'], "int"),
                       GetSQLValueString($_POST['intEstado'], "int"));

  mysql_select_db($database_conexioncreacion, $conexioncreacion);
  $Result1 = mysql_query($insertSQL, $conexioncreacion) or die(mysql_error());

  $insertGoTo = "slider_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
function subirimagen(nombrecampo)
{
	self.name = 'opener';
	remote = open('gestionimagen.php?campo='+nombrecampo, 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
    <h1>A&ntilde;adir Publicidad</h1>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td width="187" align="right" nowrap="nowrap">Imagen Grande :</td>
          <td width="294"><input type="text" name="strImagenGrande" value="" size="25" /><input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen('strImagenGrande');"/>
          (734x250px)</td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Imagen Peque&ntilde;a :</td>
          <td><input type="text" name="strImagenPequena" value="" size="25" /><input type="button" name="button2" id="button2" value="Subir Imagen" onclick="javascript:subirimagen('strImagenPequena');"/>
          (80x50px)</td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Titulo:</td>
          <td><input type="text" name="strTitulo" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Subtitulo:</td>
          <td><input type="text" name="strSubtitulo" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Menu:</td>
          <td><input type="text" name="strMenu" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Link:</td>
          <td><input type="text" name="strLink" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Orden:</td>
          <td><input type="text" name="intOrden" value="" size="5" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Estado:</td>
          <td><label for="intEstado"></label>
            <select name="intEstado" id="intEstado">
              <option value="1">Activo</option>
              <option value="0">Desactivado</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td>
          <a class="button" href="javascript:document.form1.submit();"><span>Insertar Slider</span></a> 
</td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->
  
    <!-- end .content --></div>
  <div class="footer">
   <?php include("../includes/pie_admin.php"); ?></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
