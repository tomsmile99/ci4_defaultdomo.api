<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// api ส่วนของ user *********
//--------------------      เมนูงานขายประกัน      --------------------//

//---- ประเภทรถ ----//
//$routes->get('/api/insurances/dataformcheckpremiums', 'Users\InsurancesController::dataFormCheckPremiums');
$routes->get('/api/insurances/dataformcheckpremiums', 'InsurancesController::dataFormCheckPremiums');
$routes->get('/api/insurances/dataformcheckpremiums/seriescars/(:num)', 'InsurancesController::dataSeriesCars/$1');

$routes->post('/api/insurances/dataformcheckpremiums', 'DemoController::createApiKey');
//---- End ประเภทรถ ----//




//--------------------    End เมนูงานขายประกัน      --------------------//
// End api ส่วนของ user *********












// $routes->get('/', 'Home::index');
$routes->get('/demo', 'DemoController::index');



$routes->get('/demo/(:num)', 'DemoController::index/$1');
// $routes->get('/api/demo/delete/(:num)', 'DemoController::delete/$1');
// $routes->get('/api/demo/status/(:num)/(:any)', 'DemoController::status/$1/$2');
// $routes->match(['get','post'], "/api/demo/create", 'DemoController::create');
// $routes->match(['get','post'], "/api/demo/create/(:num)", 'DemoController::create/$1');

$routes->post('/demo', 'DemoController::createApiKey');
// $routes->resource('api/users',[
//   'controller' =>'Api\Users',
//   'filter' => 'authApi'
// ]);

//$routes->resource('api/demo',['controller' =>'DemoController::index','filter' => 'authApi']);

  

// $routes->group('api', ['filter' => 'authApi'], function ($routes){
//   $routes->group('demo', function ($routes){
//     $routes->get('api/demo', 'DemoController::index');
//   });
// });


