<?php
require_once 'HTTP/Request2.php';

$request = new HTTP_Request2();
$request->setUrl('https://w1zvwy.api.infobip.com/whatsapp/1/message/template');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
    'follow_redirects' => TRUE
));
$request->setHeader(array(
    'Authorization' => 'App 7ef88c32178b1396ffeca78719306876-f1fb45bd-270b-4a7b-82f3-fa1d896f92d6',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json'
));
$request->setBody('{"messages":[{"from":"447860099299","to":"21629785051","messageId":"dd234bd2-b0a4-40cb-8b48-6ad8b3e46d8f","content":{"templateName":"message_test","templateData":{"body":{"placeholders":["Mohamed"]}},"language":"en"}}]}');
try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        echo $response->getBody();
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        $response->getReasonPhrase();
    }
}
catch(HTTP_Request2_Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>