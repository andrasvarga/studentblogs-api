<?php
	class ReviewController extends Controller
	{
		public static function post($request, $response, $args)
		{
			global $entityManager;			
			$params = $request->getParsedBody();
			
			if ( !$this->hasAuth($params['key'],$response) ) return;
						
			$user_id = $params["userId"];
			$form_id = $params["formId"];
			$version = $params["version"];
			$responses = $params["responses"];
			
			if (!isset($user_id))	return $this->message($response, 'error', 'User ID is missing!');
			if (!isset($version))	return $this->message($response, 'error', 'Version is missing!');
			if (!isset($responses))	return $this->message($response, 'error', 'Responses are missing!');
			
			// Creating the review entity
			// $user_id is the "userId" field of the given JSON object
			// Review($user_id, FormPost $form, DateTime $date, $version, $approved=FALSE)
			
			$now = new DateTime('NOW');
			$form = $entityManager->find('FormPost', $form_id);
			
			if (!$form) return $this->message($response, 'error', 'Form not found!');
			
			$review = new Review($user_id, $form, $now, $version);
			$entityManager->persist($review);
			$entityManager->flush();
			
			// Creating the response entities for the review
			// $responses is the "responses" field of the given JSON object
			// ReviewResponse(Review $review, FormField $field, $value)
			
			foreach ($responses as $r){
				$form_field = $entityManager->find('FormField', $r["fieldId"]);
				$reviewResponse = new ReviewResponse($review, $form_field, $r["value"]);
				$entityManager->persist($reviewResponse);
			}
			$entityManager->flush();
			
			// Triggering CMS endpoint to fetch the new post (if it wants to)

			$created_id = $review->getId();
			$trigger = file_get_contents('http://studentblogs.org/wp-json/studentblogs/v1/transfer/'.$created_id);
			if (!$trigger) return $this->message($response, 'error', 'CMS not found');
			
			return $this->message($response, 'success', 'Review has been added successfully');
		}
		
		public static function get($request, $response, $args)
		{
			global $entityManager;
			$id = $args['id'];
			$review = $entityManager->find('Review', $id);
			if (!$review) return $this->message($response, 'error', 'Review not found!');
			
			$old_res = $response->write(json_encode($review->getReview()));			
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