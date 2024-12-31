<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/Home', 'Home::showDashboard');    
$routes->setAutoRoute(true);

// This will allow you to access the getData method using the URL /data
//campaigns

$routes->get('/', 'Logincontroller::index');
$routes->get('/Campaigns', 'Home::showCampagins');
$routes->get('/displayCreateCampaign', 'Home::displayCreateCampaign');
$routes->post('/createCampaign', 'Home::createCampaign');
$routes->get('/DeleteCampaign/(:any)', 'Home::deleteCampaign/$1');
$routes->get('/displayUpdateCampaign/(:any)', 'Home::displayUpdateCampaign/$1');
$routes->post('/updateCampaign/(:any)', 'Home::updateCampaign/$1');

//process
$routes->get('/Process/(:any)', 'Home::displayProcess/$1');
$routes->get('/displayCreateProcess/(:any)', 'Home::displayCreateProcess/$1');
$routes->post('/createProcess', 'Home::createProcess');

//Users
$routes->get('/Users', 'Home::showUsers');
$routes->get('/displayUpdateUsers/(:any)', 'Home::displayUpdateUser/$1');
$routes->get('/displayCreateUsers', 'Home::displayCreateUsers');
$routes->post('/createUser', 'Home::createUser');
$routes->get('/DeleteUser/(:any)', 'Home::DeleteUser/$1');
$routes->post('/updateUser/(:any)', 'Home::UpdateUser/$1');
    
//Chat
// $routes->get('/Chat','')

//Login 
$routes->post('/login', 'LoginController::authenticate');   
$routes->post('/register/saveData', 'RegistarController::saveData');