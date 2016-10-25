<?php

require_once 'http/Response.php';
require_once 'http/status_messages.php';

class HomeController {
    
    private $homeRepository;
    
    public function __construct(HomeRepository $homeRepository) {
        $this->homeRepository=$homeRepository;
    }
    
    public function saludoAction($request){
        $response = new Response();
        
        $result= $this->homeRepository->saludo();
        
        if (is_array($result)) {
                $response->setBody($result);
                $response->setStatus(200);
            } else if (is_string($result)) {
                $response->setBody(['message' => $result]);
                $response->setStatus(200);
            }
                
        return $response;
        
    }
    
}
