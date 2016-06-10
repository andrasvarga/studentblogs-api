<?php
	class LocationController extends Controller
	{
		
		public static function post($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			
			$name =		$params['name'];
			$slug =		strtolower($params['slug']);
			$code =		strtoupper($params['code']);
			$parentTemp =	(int)$params['parent'];
			$parent;
			
			if ($parentTemp) {
				$parent = $entityManager->find('Location', $parentTemp);
			} else {
				$parent = NULL;
			}
			
			if ( !isset($name) || !isset($slug) || !isset($code) ) {
				return $this->message($response, 'error','Missing values! Required: name, slug, code');
			}
			
			$location = $entityManager->getRepository('Location')->findOneBy(array('code' => $code));
			
			if ( $location ) {
				return $this->message($response, 'error','Country code "'.$code.'" already exists!');
			}
			
			$toAdd = new Location($name, $slug, $code, $parent);
			
			$entityManager->persist($toAdd);
			$entityManager->flush();
			
			return $this->message($response, 'success','Location "'.$code.'" added successfully');
		}
		
		public static function get($request, $response, $args)
		{
			global $entityManager;
						
			$resultArray = array();
			$tempArray = array();
				
			$code = $args['code'];
			
			$location;

			if ( intval($code) == 0 ) {		
				$location = $entityManager->getRepository('Location')->findOneBy(array('code' => $code));
			} else {
				$location = $entityManager->find('Location', (int)$code);
			}
			
			if ( !$location ) {
				return $this->message($response, 'error','Country "'.$code.'" does not exist!');
			}
						
			$stats = $location->getValues();
			foreach($stats as $stat){
					$tempArray[] = array(
						"name" => $stat->getName(),
						"value" => $stat->getValue(),
						"unit" => $stat->getUnitHtml(),
						"description" => $stat->getDescription(),
						"status" => $stat->getStatus()->getSlug()
					);
			}
			
			$resultArray[] = array(
				"id" => $location->getId(),
				"name" => $location->getName(),
				"slug" => $location->getSlug(),
				"code"	=> $location->getCode(),
				"parent" => $location->getParentId(),
				"stats" => $location->getValueIds(),
				"stat" => $tempArray
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
			
			$code = $args['code'];
			$location;			
			if ( intval($code) == 0 ) {		
				$location = $entityManager->getRepository('Location')->findOneBy(array('code' => $code));
			} else {
				$location = $entityManager->find('Location', $code);
			}			
			if ( !$location ) {
				return $this->message($response, 'error','Country "'.$code.'" does not exist!');
			}
	
			$name =		$params['name'];
			$slug =		strtolower($params['slug']);
			$code =		strtoupper($params['code']);
			$parentTemp =	(int)$params['parent'];
			$parent;
			
			if ($parentTemp) {
				$parent = $entityManager->find('Location', $parentTemp);
			} else {
				$parent = NULL;
			}
			
			if ($location->getName() != $name)		$location->setName($name);
			if ($location->getSlug() != $slug)		$location->setSlug($slug);
			if ($location->getCode() != $code)		$location->setCode($code);
			if ($location->getParent() != $parent)	$location->setParent($parent);
			
			
			$entityManager->flush();
	
			return $this->message($response, 'success','Location "'.$code.'" has been updated!');
		}
		
		public static function delete($request, $response, $args)
		{
			global $entityManager;
			$params = $request->getParsedBody();
			if ( !$this->hasAuth($params['key'],$response) ) return;
			
			$code = $args['code'];
			
			$location;
			
			if ( intval($code) == 0 ) {		
				$location = $entityManager->getRepository('Location')->findOneBy(array('code' => $code));
			} else {
				$location = $entityManager->find('Location', $code);
			}
			
			$entityManager->remove($location);
			$entityManager->flush();
			
			return $this->message($response, 'success','Location "'.$code.'" has been deleted!');
		}
		
		public static function getList($request, $response, $args)
		{
			global $entityManager;
			$resultArray = array();
			
			$locations = $entityManager->getRepository('Location')->findAll();
			foreach($locations as $location){
				
				$resultArray[] = array(
					'id'		=> $location->getId(),
					'name'		=> $location->getName(),
					'slug'  => $location->getSlug(),
					'code'	=> $location->getCode(),
					'parent' => $location->getParentId()
				);
			}
			$old_res = $response->write(json_encode($resultArray));
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');
			return $new_res;
		}
		
	}
?>