<?php
	class FormController extends Controller
	{
		public static function post($request, $response, $args)
		{
			// todo
		}
		
		public static function get($request, $response, $args)
		{
			global $entityManager;
			$code = $args['code'];
			
			if ( intval($code) == 0 ) {		
				$form = $entityManager->getRepository('FormPost')->findOneBy(array('name' => $code));
			} else {
				$form = $entityManager->find('FormPost', (int)$code);
			}
			
			if (!$form) return $this->message($response, 'error', 'Form not found!');
			
			$resultArray = array(
				"title"	 => $form->getTitle(),
				"name"	 => $form->getName(),
				"description" => $form->getDescription(),
				"fieldGroups" => array()
			);
			
			foreach ($form->getGroups() as $group)
			{
				array_push($resultArray["fieldGroups"],$group->getGroup());
			}
			
			$old_res = $response->write(json_encode($resultArray));			
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');			
			return $new_res;
		}
		
		public static function put($request, $response, $args)
		{
			// todo
		}
		
		public static function delete($request, $response, $args)
		{
			// todo
		}
		
	}
?>