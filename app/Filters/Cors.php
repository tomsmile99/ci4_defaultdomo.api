<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface{
  public function before(RequestInterface $request, $arguments = null){
    // Allow from any origin
    header("Access-Control-Allow-Origin: http://127.0.0.1:3005");
    //header("Access-Control-Allow-Origin: https://insurance.sakerp.org/");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-API-KEY");

    // Handle preflight request
    if ($request->getMethod() == "OPTIONS"){
      exit(0);
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
      // Do nothing here
  }
}
