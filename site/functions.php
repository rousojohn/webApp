<?php 

define("SERVICE_URL", 'http://localhost/webApp/server/');
define("ADMINEMAIL",""); /*user email for sending email*/
define("ADMINEMAILPASS","");/*password for email above*/

function getData ($url){
    $curl = curl_init(SERVICE_URL . $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        $res = new stdClass();
        $res->error = 'Did not fetch data';
        echo json_encode(res);
        die('');
    }
    curl_close($curl);
    return $curl_response;
}

$days= array (1=>'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
?>