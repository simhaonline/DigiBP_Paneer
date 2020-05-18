<?php
error_reporting(E_ALL);
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

//Variables
$person = $_GET['n'];

//Programm
$return = startProcess($person);


//return the value

echo json_encode($return);




function startProcess($person) {
    // This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
    require_once 'HTTP/Request2.php';

    $request = new Http_Request2('https://digibp-paneer.herokuapp.com/rest/process-definition/key/monthlyBilling/tenant-id/digibp-paneer/start');
    $url = $request->getUrl();

    $headers = array(
    // Request headers
        'Content-Type' => 'application/json'
    );

    $request->setHeader($headers);

    $parameters = array(
    // Request parameters
    );

    $url->setQueryVariables($parameters);

    $request->setMethod(HTTP_Request2::METHOD_POST);

    // Request body
    
    $request->setBody('{
                        "variables": {
                             "Mandate": { "value" : "insert_mandate_here", "type": "String"},
                             "Customer": { "value" : "Krusty_Krab", "type": "String"},
                             "Person": { "value" : "'.$person.'", "type": "String"}},
                        "businessKey": "business key"
                       }');

    try
    {
        $response = $request->send();
        $return = json_decode($response->getBody());
        return $return;
    
    }
    catch (HttpException $ex)
    {
        return $ex;
    }
 }
?>
