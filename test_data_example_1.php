<?php

	/*
	 * TEST DATA
	 * 
	 * Creates test data for the StudentBlogs Map API
	 *
	 */

	require_once "bootstrap.php";
	
	/* LEVEL 3 */

		$l3 = array(
			// Units ($name,$slug)
			new Unit('&euro;',			'euro'),				// $l3[0]
			new Unit('&#37;',			'percent'),				// $l3[1]
			new Unit('C&deg;',			'celsius'),				// $l3[2]
			new Unit('km<sup>2</sup>',	'square-kilometers'),	// $l3[3]
			new Unit('&#36;',			'dollar')				// $l3[4]
		);
		
		foreach ($l3 as $l){
			$entityManager->persist($l);
		}
		
		$entityManager->flush();

	/* LEVEL 2 */
	
		$l2a = array(
			// Factors ($name, Unit $unit=NULL, $description, $priority=100, $active=false, $invert=false)
			
			// $l2a[0]
			new Factor(
				'GDP',
				$l3[4],
				'It represents the total dollar value of all goods and services produced over a specific time period; you can think of it as the size of the economy.',
				1,
				true
			),
			
			// $l2a[1]
			new Factor(
				'Average tuition fee',
				$l3[0],
				'Tuition fees in Euro from http://www.studyineurope.eu/tuition-fees',
				2,
				true,
				true
			),
			
			// $l2a[2]
			new Factor(
				'Available grants',
				$l3[0],
				'',
				3,
				true
			),
			
			// $l2a[3]
			new Factor(
				'Groceries index',
				NULL,
				'',
				4,
				true,
				true
			),
			
			// $l2a[4]
			new Factor(
				'Rent index',
				NULL,
				'',
				5,
				true,
				true
			),
			
			// Keys ($owner='anonymous',$status=false)
			new ApiKey('studentblogs.org',	true),				// $l2a[5]
			// Locations ($name, $slug, $code, Location $parent=NULL)
			new Location('Eastern Europe',	'eastern-europe'),	// $l2a[6]
			new Location('Northern Europe',	'northern-europe'),	// $l2a[7]
			new Location('Southern Europe',	'southern-europe'),	// $l2a[8]
			new Location('Western Europe',	'western-europe'),	// $l2a[9]
			// Statuses ($name,$slug)
			new Status('Pending',	'pending'),		// $l2a[10]
			new Status('Verified',	'verified'),	// $l2a[11]
			new Status('Deprecated','deprecated')	// $l2a[12]
		);
		
		$l2b = array(
			new Location('Belarus', 		'belarus',			'BY', $l2a[6]), // $l2b[0]
			new Location('Czech Republic', 	'czech-republic',	'CZ', $l2a[6]), // $l2b[1]
			new Location('Hungary',			'hungary',			'HU', $l2a[6]), // $l2b[2]
			new Location('Moldova',			'moldova',			'MD', $l2a[6]), // $l2b[3]
			new Location('Poland',			'poland',			'PL', $l2a[6]), // $l2b[4]
			new Location('Romania', 		'romania',			'RO', $l2a[6]), // $l2b[5]
			new Location('Slovakia', 		'slovakia',			'SK', $l2a[6]), // $l2b[6]
			new Location('Ukraine', 		'ukraine',			'UA', $l2a[6]), // $l2b[7]
			
			new Location('Denmark',		'denmark',		'DK', $l2a[7]), // $l2b[8]
			new Location('Estonia',		'estonia',		'EE', $l2a[7]), // $l2b[9]
			new Location('Finland',		'finland',		'FI', $l2a[7]), // $l2b[10]
			new Location('Greenland',	'greenland',	'GL', $l2a[7]), // $l2b[11]
			new Location('Iceland',		'iceland',		'IS', $l2a[7]), // $l2b[12]
			new Location('Latvia',		'latvia',		'LV', $l2a[7]), // $l2b[13]
			new Location('Lithuania',	'lithuania',	'LT', $l2a[7]), // $l2b[14]
			new Location('Norway',		'norway',		'NO', $l2a[7]), // $l2b[15]
			new Location('Sweden',		'sweden',		'SE', $l2a[7]), // $l2b[16]
			
			new Location('Albania',					'albania',					'AL', $l2a[8]), // $l2b[17]
			new Location('Bosnia and Herzegovina',	'bosnia-and-herzegovina',	'BA', $l2a[8]), // $l2b[18]
			new Location('Bulgaria',				'bulgaria',					'BG', $l2a[8]), // $l2b[19]
			new Location('Croatia',					'croatia',					'HR', $l2a[8]), // $l2b[20]
			new Location('Greece',					'greece',					'GR', $l2a[8]), // $l2b[21]
			new Location('Macedonia',				'macedonia',				'MK', $l2a[8]), // $l2b[22]
			new Location('Montenegro',				'montenegro',				'ME', $l2a[8]), // $l2b[23]
			new Location('Serbia',					'serbia',					'RS', $l2a[8]), // $l2b[24]
			new Location('Slovenia',				'slovenia',					'SI', $l2a[8]), // $l2b[25]
						
			new Location('Austria',			'austria',			'AT', $l2a[9]), // $l2b[26]
			new Location('Belgium',			'belgium',			'BE', $l2a[9]), // $l2b[27]
			new Location('France',			'france',			'FR', $l2a[9]), // $l2b[28]
			new Location('Germany',			'germany',			'DE', $l2a[9]), // $l2b[29]
			new Location('Ireland',			'ireland',			'IE', $l2a[9]), // $l2b[30]
			new Location('Italy',			'italy',			'IT', $l2a[9]), // $l2b[31]
			new Location('Liechtenstein',	'liechtenstein',	'LI', $l2a[9]), // $l2b[32]
			new Location('Luxembourg',		'luxembourg',		'LU', $l2a[9]), // $l2b[33]
			new Location('Netherlands',		'netherlands',		'NL', $l2a[9]), // $l2b[34]
			new Location('Portugal',		'portugal',			'PT', $l2a[9]), // $l2b[35]
			new Location('Spain',			'spain',			'ES', $l2a[9]), // $l2b[36]
			new Location('Switzerland',		'switzerland',		'CH', $l2a[9]), // $l2b[37]
			new Location('United Kingdom',	'united-kingdom',	'GB', $l2a[9]), // $l2b[38]
		);
		
		foreach ($l2a as $l){
			$entityManager->persist($l);
		}
		foreach ($l2b as $l){
			$entityManager->persist($l);
		}
		
		$entityManager->flush();
		
	/* LEVEL 1 */
		
		$now = new DateTime('NOW');
		
		$l1 = array();
		
		// Values (Factor $factor, Location $location, Status $status, ApiKey $apikey, DateTime $submitted, DateTime $updated, $value, $source, DateTime $sourceDate)
		
		// Loop through all states in Europe
		for($i = 0; $i <= 38; $i++){
			$l1[] = new Value($l2a[0], $l2b[$i], $l2a[11], $l2a[5], $now, $now, 'N/A', 'Initial Data Generator', $now);
			$l1[] = new Value($l2a[1], $l2b[$i], $l2a[11], $l2a[5], $now, $now, 'N/A', 'Initial Data Generator', $now);
			$l1[] = new Value($l2a[2], $l2b[$i], $l2a[11], $l2a[5], $now, $now, 'N/A', 'Initial Data Generator', $now);
			$l1[] = new Value($l2a[3], $l2b[$i], $l2a[11], $l2a[5], $now, $now, 'N/A', 'Initial Data Generator', $now);
			$l1[] = new Value($l2a[4], $l2b[$i], $l2a[11], $l2a[5], $now, $now, 'N/A', 'Initial Data Generator', $now);
		}
		
		foreach ($l1 as $l){
			$entityManager->persist($l);
		}
		
		$entityManager->flush();

?>