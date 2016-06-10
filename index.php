<?php
	require_once('bootstrap.php');
	
	$app = new \Slim\App;

	//
	// ROUTING
	//

	$app->get('/info', function($request, $response, $args) {
		echo ("Hello! This is StudentBlogs API V0.3 \n");
		echo ("Service status: OK");
		return $response;
	});
	
	// CREATE
	$app->post('/location',			'LocationController:post');		// Create location entity
	$app->post('/factor',			'FactorController:post');		// Create factor entity
	$app->post('/value',			'ValueController:post');		// Create value entity
	
	$app->post('/review',			'ReviewController:post');		// Create review
	
	// READ
	$app->get('/location',			'LocationController:getList');	// List of all locations
	$app->get('/location/{code}',	'LocationController:get');		// Specified location entity
	$app->get('/factor',			'FactorController:getList');	// List of all factors
	$app->get('/factor/{id}',		'FactorController:get');		// Specified factor entity
	$app->get('/factor/values/{id}','FactorController:getValues');	// Active / verified (!) values of a specified factor entity
	$app->get('/value/{id}',		'ValueController:get');			// Specified value entity
	$app->get('/form/{code}',		'FormController:get');			// Read (generate) form
	
	$app->get('/review/{id}',		'ReviewController:get');		// Read (render) review
	
	// UPDATE
	$app->put('/location/{code}',	'LocationController:put');		// Update specified location
	$app->put('/factor/{id}',		'FactorController:put');		// Update specified factor
	$app->put('/value/{id}',		'ValueController:put');			// Update specified value
	// DELETE
	$app->delete('/location/{code}','LocationController:delete');	// Delete specified location
	$app->delete('/factor/{id}',	'FactorController:delete');		// Delete specified factor
	$app->delete('/value/{id}',		'ValueController:delete');		// Delete specified value
	
	$app->run();
?>
