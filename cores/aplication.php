<?php

function authenticate() {

    $headers = apache_request_headers();
    $response = array();

    if (isset($headers['Authorization'])) {
        $db = new Database();
    	$api_key = $headers['Authorization'];
        if (!$db->isValidApiKey($api_key)) {
            $response["Auth-Error"] = true;
            $response["Auth-Message"] = "Access Denied. Invalid Api key";
            return $response;
        } else {
            $response["Auth-Error"] = false;
            $response["Auth-Message"] = "Authenticated.";
            return $response;
        }
    } else {
        $response["Auth-Error"] = true;
        $response["Auth-Message"] = "Api key is misssing";
        return $response;
    }
}


/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function toResponse($status_code, $response, $view = null) {
    //$app = \Slim\Slim::getInstance();
    if(!$view){
    	http_response_code($status_code);
    	header('Content-type: application/json');
    	echo json_encode($response);
    }
    die();
}

