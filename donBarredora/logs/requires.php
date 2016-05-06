<?php
@ini_set("display_errors","1");
@error_reporting(1);

global $prefijo;
require($prefijo."db/DBO.php");

require($prefijo."db/requires.ini.php");

//Clases
require($prefijo."class/class.General.inc.php");

//Smarty
require($_SERVER["DOCUMENT_ROOT"]."/Smarty/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->left_delimiter = '{#';
$smarty->right_delimiter = '#}';

function cambiaParaEnvio($cadena){
	//$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
	$cadena = utf8_encode($cadena);
	return($cadena);
}

function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

function sendNotificationAndroid($registatoin_ids, $message) {
    define("GOOGLE_API_KEY", "AIzaSyCWqypHnlzHoubWS4Dd_vWRrgqOtwQeWr0");
    // variable post http://developer.android.com/google/gcm/http.html#auth 
    $url = 'https://android.googleapis.com/gcm/send';
    // If message is too long, truncate it to stay within the max payload of 256 bytes.
    if (strlen($message) > 125) {
        $message = substr($message, 0, 125) . '...';
    }
    $fields = array(
        'registration_ids' => $registatoin_ids, 
        'data' => $message
    ); 
    $headers = array( 
        'Authorization: key=' . GOOGLE_API_KEY,
        'Content-Type: application/json' 
    ); 
    // abriendo la conexion 
    $ch = curl_init(); 
    // Set the url, number of POST vars, POST data 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    // Deshabilitamos soporte de certificado SSL temporalmente 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields)); 
    // ejecutamos el post
    $result = curl_exec($ch);
    printVar($result,"result android");
    // Cerramos la conexion 
    curl_close($ch);
    return json_decode($result);
}
function sendNotificationIos($registatoin_ids, $message,$badge){
    // Nuestro token
    $deviceToken = $registatoin_ids;
    // El password del fichero .pem
    $passphrase = 'claroc3';
    $ctx = stream_context_create();
    //Especificamos la ruta al certificado .pem que hemos creado
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'certs/ClaroC3CK.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
    // Abrimos conexión con APNS
    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    if (!$fp) {
        $return= (object) array('success' => false);
    }
    // If message is too long, truncate it to stay within the max payload of 256 bytes.
    if (strlen($message) > 125) {
        $message = substr($message, 0, 125) . '...';
    }
    // Creamos el payload
    $body['aps'] = array(
        'alert' => utf8_decode($message),
        'sound' => 'bingbong.aiff',
        'badge' => $badge
        );
    // Lo codificamos a json
    $payload = json_encode($body);
    // Construimos el mensaje binario
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
    // Lo enviamos
    $result = fwrite($fp, $msg, strlen($msg));
    printVar($result,"result ios");
    if (!$result) {
        $return= (object) array('success' => false);
    } else { 
        $return= (object) array('success' => "1");
    }
    // cerramos la conexión
    fclose($fp);
    return $return;
}

?>