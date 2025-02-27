<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes_model  = new \App\Models\RouteModel();
$routes_data = $routes_model->findAll();  
foreach ($routes_data as $key => $value) {   
	$routes->match(json_decode($value["methods"],true),$value["url"] , $value["controller"],json_decode($value["filters"],true));
	$routes->match(["POST"],"/file","Public\Home::file"); 
}  