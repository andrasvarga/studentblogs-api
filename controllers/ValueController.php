<?php
	class ValueController extends Controller
	{
		public static function post($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			
			// Parameters:
			//
			// factor (factor ID)
			// location (location ID)
			// status (status ID)
			// value (the value string)
			// source (the source string)
			// sourceDate (date of the source)
			// key (api key)
			
			$factorTemp =	(int)$params['factor'];
			$locationTemp =	(int)$params['location'];
			$statusTemp =	(int)$params['status'];
			$value = 		$params['value'];
			$source = 		$params['source'];
			$sourceDateTemp = $params['sourceDate'];
			
			if (   !isset($factorTemp)
				|| !isset($locationTemp)
				|| !isset($statusTemp)
				|| !isset($value)
				|| !isset($source)
				|| !isset($sourceDateTemp) ) {
				return $this->message($response, 'error','Missing values!');
			}
			
			$factor = $entityManager->find('Factor', $factorTemp);
			$location = $entityManager->find('Location', $locationTemp);
			$status = $entityManager->find('Status', $statusTemp);
			$sourceDate = new DateTime($sourceDateTemp);
			
			if ( !$factor || !$location || !$status || !$sourceDate ) {
				return $this->message($response, 'error','Some of the following does not exist or given in wrong format: Factor, Location, Status, SourceDate');
			}
			
			
			$apikey = $entityManager->getRepository('ApiKey')->findOneBy(array('apikey' => $params['key']));
			
			if (!$apikey) return $this->message($response, 'error','Missing API Key!');
			
			$now = new DateTime('NOW');
			
			$toAdd = new Value($factor, $location, $status, $apikey, $now, $now, $value, $source, $sourceDate);
			
			$entityManager->persist($toAdd);
			$entityManager->flush();
			
			return $this->message($response, 'success','Value has been added successfully');
		}
		
		public static function get($request, $response, $args)
		{
			global $entityManager;			
			$id = $args['id'];
			
			$value = $entityManager->find('Value', $id);
			
			$resultArray = array(
				"factor"	=> $value->getFactor()->getName(),
				"location"	=> array(
					"name"		=> $value->getLocation()->getName(),
					"slug"		=> $value->getLocation()->getSlug(),
					"code"		=> $value->getLocation()->getCode()
				),
				"status"	=> $value->getStatus()->getSlug(),
				"submitted"	=> $value->getSubmitDate(),
				"updated"	=> $value->getUpdateDate(),
				"value"		=> $value->getValue(),
				"unit"		=> $value->getUnitHtml(),
				"source"	=> $value->getSource(),
				"sourceDate"=> $value->getSourceDate()
			);
			
			$old_res = $response->write(json_encode($resultArray));			
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');			
			return $new_res;
		}
		
		public static function put($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			$id = $args['id'];
			
			// Parameters:
			//
			// factor
			// location
			// status
			// value
			// source
			// sourceDate
			
			if (isset($params['factor']))	$factorTemp =	(int)$params['factor'];
			if (isset($params['location']))	$locationTemp =	(int)$params['location'];
			if (isset($params['status']))	$statusTemp =	(int)$params['status'];
			if (isset($params['value']))	$newValue = 	$params['value'];
			if (isset($params['source']))	$source = 		$params['source'];
			if (isset($params['sourceDate'])) $sourceDateTemp = $params['sourceDate'];
			
			$apikey = $entityManager->getRepository('ApiKey')->findOneBy(array('apikey' => $params['key']));
			$now = new DateTime('NOW');
			
			$updated = false;
			
			$value = $entityManager->find('Value', $id);
			
			if (isset($factorTemp)){
				$factor = $entityManager->find('Factor', $factorTemp);
				if ($value->getFactor() != $factor){
					$value->setFactor($factor); //factor
					$updated = true;
				}
			}
			if (isset($locationTemp)){
				$location = $entityManager->find('Location', $locationTemp);	
				if ($value->getLocation() != $location){
					$value->setLocation($location); //location
					$updated = true;
				}
			}
			if (isset($statusTemp)){
				$status = $entityManager->find('Status', $statusTemp);
				if ($value->getStatus() != $status){
					$value->setStatus($status); //status
					$updated = true;
				}
			}
			if (isset($sourceDateTemp)){
				$sourceDate = new DateTime($sourceDateTemp);
				if ($value->getSourceDate() != $sourceDate){
					$value->setSourceDate($sourceDate); //sourcedate
					$updated = true;
				}
			}
			if (isset($newValue)){
				if ($value->getValue() != $newValue){
					$value->setValue($newValue); //value
					$updated = true;
				}
			}
			if (isset($source)){
				if ($value->getSource() != $source){
					$value->setSource($source); //source
					$updated = true;
				}
			}
							
			if ($value->getApiKey() != $apikey){
				$value->setApiKey($apikey); //apikey
				$updated = true;
			}
			
			if ($updated) $value->setUpdateDate($now); //updated
			
			$entityManager->flush();
			
			if (!$updated) return $this->message($response, 'success','Entry has not been changed!');
	
			return $this->message($response, 'success','Entry has been updated!');
		}
		
		public static function delete($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			$id = $args['id'];
			
			$value = $entityManager->find('Value', $id);
			
			$entityManager->remove($value);
			$entityManager->flush();
			
			return $this->message($response, 'success','Value has been deleted!');
		}
	}
?>