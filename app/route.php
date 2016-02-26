<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/

$app->get('/', 'App\Controller\HomeController:dispatch')->setName('homepage');