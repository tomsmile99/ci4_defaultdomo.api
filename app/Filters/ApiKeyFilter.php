<?php 

// สร้างไฟล์ใหม่ที่ app/Filters/ApiKeyFilter.php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services; // เพิ่มการนำเข้า Services class

class ApiKeyFilter implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        $key = $request->getHeaderLine('x-api-key');
        if(empty($key)){
          //return Services::response()->setStatusCode(ResponseInterface::HTTP_FORBIDDEN, 'API Key required');
          $response = [
            'status' => 401,
            'message' => 'API Key required'
          ];
          return Services::response()->setJSON($response)->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
        $db = \Config\Database::connect();
        $apiKey = $db->table('api_keys')->where('key', $key)->get()->getRow();
        if (!$apiKey) {
          //return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'Invalid API Key');
          $response = [
            'status' => 403,
            'message' => 'Invalid API Key'
          ];
          return Services::response()->setJSON($response)->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
