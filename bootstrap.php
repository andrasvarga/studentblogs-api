<?php

	/* Global Autoloader */
	require 'vendor/autoload.php';

	/* Doctrine Entity Manager */
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;

	$paths = array(__DIR__."/models");
	$isDevMode = true; // TRUE to generate proxies, FALSE if production mode
	
	$dbParams = array(
		'driver'   => 'pdo_mysql',
		'user'     => 'username',
		'password' => 'password',
		'dbname'   => 'database',
		'charset'  => 'utf8'
	);
	
	$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
	$entityManager = EntityManager::create($dbParams, $config);
		
	/* Auto-Load Models */
	foreach (glob("models/*.php") as $filename)
	{
		include_once $filename;
	}
	
	/* Auto-Load Controllers */
	foreach (glob("controllers/*.php") as $filename)
	{
		include_once $filename;
	}

	
?>