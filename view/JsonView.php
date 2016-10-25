<?php


/**
 * Genera outputs con formato JSON
 */
class JsonView  
{

    public function render($response)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($response->getBody(), JSON_PRETTY_PRINT);
        http_response_code($response->getStatus());
        return true;
    }
}