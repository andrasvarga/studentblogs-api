<?php
	class FactorController extends Controller
	{
		
		public static function post($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			
			// Parameters:
			//
			// name
			// description
			// priority
			// active
			// invert
			// unit
			// key
			
			$name = $params['name'];
			$desc = $params['description'];
			$prior = (int)$params['priority'];
			$active = (bool)$params['active'];
			$invert = (bool)$params['invert'];
			$unitTemp = (int)$params['unit'];
			$unit;
			
			/* Parameter(s) do(es) not exist */
			if ( !isset($name) || !isset($desc) || !isset($prior) ) {
				return $this->message($response, 'error','Missing values! Required: name, description, priority');
			}
			
			if ($unitTemp) {
				$unit = $entityManager->find('Unit', $unitTemp);
			} else {
				$unit = NULL;
			}
			
			$toAdd = new Factor($name, $unit, $desc, $prior, $invert);
			
			$entityManager->persist($toAdd);
			$entityManager->flush();
			
			return $this->message($response, 'success','Factor added successfully');
		}
				
		public static function get($request, $response, $args)
		{
			global $entityManager;	
			$resultArray = array();

			if (isset($args['id'])) $id = $args['id']; // id of the factor
			
				$factor = $entityManager->find('Factor',(int)$id);
				
				if($factor){
					$resultArray = array(
						'id'		=> $factor->getId(),
						'name'		=> $factor->getName(),
						'description'=> $factor->getDescription(),
						'unit'		=> array(
							'slug' => $factor->getUnitSlug(),
							'html' => $factor->getUnitHtml()
						),
						'priority'	=> $factor->getPriority(),
						'invert' => $factor->isInvert()
					);
				} else {
					return $this->message($response, 'error','Factor does not exist!');
				}
			
			$old_res = $response->write(json_encode($resultArray));
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');
			return $new_res;
		}
		
		public static function put($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if (! $this->hasAuth($params['key'],$response) ) return;
			$id = $args['id'];
			
			$name = $params['name'];
			$desc = $params['description'];
			$prior = (int)$params['priority'];
			$active = (bool)$params['active'];
			$invert = (bool)$params['invert'];
			$unitTemp = (int)$params['unit'];
			$unit;
			
			$factor = $entityManager->find('Factor', $id);
			
			/* Entity does not exist */
			if (!$factor) {
				return $this->message($response, 'error','Factor does not exist!');
			}

			if ($unitTemp) {
				$unit = $entityManager->find('Unit', $unitTemp);
			} else {
				$unit = NULL;
			}
			
			if ($factor->getName() != $name)		$factor->setName($name);
			if ($factor->getDescription() != $desc)	$factor->setDescription($desc);
			if ($factor->getPriority() != $prior)	$factor->setPriority($prior);
			if ($factor->getUnit() != $unit)		$factor->setUnit($unit); // unit
			if ($factor->isActive() != $active)		$factor->setActive($active); // active
			if ($factor->isInvert() != $invert)		$factor->setInvert($invert); // invert
			
			$entityManager->flush();
			
			return $this->message($response, 'success','Factor has been updated!');
		}
		
		public static function delete($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();			
			if ( !$this->hasAuth($params['key'],$response) ) return;
			$id = $args['id'];
			
			$factor = $entityManager->find('Factor', $id);
			
			/* Entity does not exist */
			if (!$factor) {
				return $this->message($response, 'error','Factor does not exist!');
			}
			
			$entityManager->remove($factor);
			$entityManager->flush();
			
			return $this->message($response, 'success','Factor has been deleted!');
		}
		
		public static function getList($request, $response, $args)
		{
			global $entityManager;	
			$resultArray = array();
			
			$factors = $entityManager->getRepository('Factor')->findAll();
			foreach($factors as $factor){
				$resultArray[] = array(
					'id'		=> $factor->getId(),
					'name'		=> $factor->getName(),
					'description'=> $factor->getDescription(),
					'unit'		=> array(
						'slug' => $factor->getUnitSlug(),
						'html' => $factor->getUnitHtml()
					),
					'priority'	=> $factor->getPriority(),
					'invert' => $factor->isInvert(),
					'active' => $factor->isActive()
				);
			}
			
			$old_res = $response->write(json_encode($resultArray));
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');
			return $new_res;
		}
		
		public static function getValues($request, $response, $args)
		{
			global $entityManager;	
			$resultArray = array();
			
			$id = $args['id']; // id of the factor

			if ($id){
				$factor = $entityManager->find('Factor',(int)$id);
				$values = $entityManager->getRepository('Value')->findBy( array( 'factor' => $factor->getId() ) );		
				foreach($values as $value){
					$resultArray[$value->getLocationCode()] = $value->getValue();
				};
			} else {
			}
			
			$old_res = $response->write(json_encode($resultArray));
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');
			return $new_res;		
		}
	
	}
?>