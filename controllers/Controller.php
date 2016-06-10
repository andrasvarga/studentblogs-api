<?php
	abstract class Controller
	{			
		protected function hasKey($key)
		{
			global $entityManager;
			$owner = $entityManager->getRepository('ApiKey')->findOneBy(array('apikey' => $key));
			if ($owner && $owner->isActive())
				return true;
			else
				return false;
		}
			
		protected function message($response, $type, $text)
		{
			$old_res = $response->write(json_encode(array($type,$text)));
			$new_res = $old_res->withHeader('Content-type', 'application/json');
			$new_res = $new_res->withHeader('Access-Control-Allow-Origin', '*');	
			return $new_res;
		}
		
		protected function hasAuth($key,$response)
		{
			if ( isset($key) && $this->hasKey($key) ) {
				return true;
			} else {
				$this->message($response, 'error','Access denied!');
				return false;
			}
		}
	}
?>