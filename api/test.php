<?php
//Information som skickas i bodyn som form-data
  $data = [
    'Sommar' => 12000,
    'Höst' => 10000,
    'Vinter'   => 20000,
    'Våren' => 15000,
    'Som 22' => 9000
];
  
// Prepare new cURL resource
$crl = curl_init('localhost/api/Chart/Left');
curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($crl, CURLINFO_HEADER_OUT, true);

curl_setopt($crl, CURLOPT_POST, true);
curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
  
// Set HTTP Header for POST request 
curl_setopt($crl, CURLOPT_HTTPHEADER, array(
    'APIKEY: 1284GTY678XSW32FVZS.FVG567YHJUswqazxf42njuygt4376hdw57y', //API KEY som api:et kollar efter
    'TITEL: Charty',//Titel för stapeldiagrammet
    'BOTTOM: Inkomst i SEK') //Testen nedanför staplarna.

);
  
// Submit the POST request
$result = curl_exec($crl);
echo $result; //Ritar upp svaret från API:et
?>