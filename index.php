<?php
/**
 *  création de l'index 
 */
session_start();

//require_once 'controller/router.php';

/**
 * appel de l'autoloader pour charger les classes 
 */
require 'engine/autoloader.php';
$autoloader = new Autoloader();

$autoloader->addDirectories(
	array(
	'engine',	
	'controller',
	'entity',
	'model',
	'view',
	'public'
	));

$autoloader->registerAutoload();

$router = new Router(); 
$router->routeQuery(); 


