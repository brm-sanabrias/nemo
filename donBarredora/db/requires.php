<?php  

error_reporting(0);
ini_set('display_errors', 0);

ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Bogota');


global $prefijo;
global $path;
$path=(isset($_SERVER["DOCUMENT_ROOT"]) && $_SERVER["DOCUMENT_ROOT"]!="") ? $_SERVER["DOCUMENT_ROOT"]."/" : "/Library/WebServer/Documents/";

require($prefijo."db/DBO.php");
//DataObjects

require($prefijo."db/requires.ini.php");


//Clases
//require($prefijo."class/class.thread.php");
require($prefijo."class/class.General.inc.php");
require($prefijo."class/class.mongo.php");
require($prefijo."class/class.fb.php");
require($prefijo."class/class.barredora.php");
//Smarty
//require($_SERVER["DOCUMENT_ROOT"]."/Smarty/libs/Smarty.class.php");
/*require($path."Smarty/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->left_delimiter = '{#';
$smarty->right_delimiter = '#}';*/




function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

function objectToArray($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	} else {
		return $d;
	}
}

function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

function miGestorDeErrores($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // Este código de error no está incluido en error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        printVar( "<b>Mi ERROR</b> [$errno] $errstr<br />\n");
        printVar( "  Error fatal en la línea $errline en el archivo $errfile");
        printVar( ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n");
        printVar( "Abortando...<br />\n");
        exit(1);
        break;

    case E_USER_WARNING:
        printVar( "<b>Mi WARNING</b> [$errno] $errstr<br />\n");
        break;

    case E_USER_NOTICE:
        printVar( "<b>Mi NOTICE</b> [$errno] $errstr<br />\n");
        break;

    default:
        printVar( "Tipo de error desconocido: [$errno] $errstr<br />\n");
        break;
    }

    /* No ejecutar el gestor de errores interno de PHP */
    return true;
}
//set_error_handler('miGestorDeErrores');

?>