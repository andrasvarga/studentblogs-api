<?php
	/*
	 * TEST DATA
	 * 
	 * Creates test data for the StudentBlogs Map API
	 *
	 */

	require_once "bootstrap.php";
	
	/* FORM FIELD TYPES */
	
	$text =		new FormFieldType("text");
	$textarea =	new FormFieldType("textarea");
	$date = 	new FormFieldType("date");
	$image = 	new FormFieldType("image");
	$rating = 	new FormFieldType("rating");
	$location =	new FormFieldType("location");
	$checkbox =	new FormFieldType("checkbox");
	$radio =	new FormFieldType("radio");
	$number = 	new FormFieldType("number");
	$degree = 	new FormFieldType("degree");
	$cost =		new FormFieldType("cost");
	
	$formFieldTypes = array( $text, $textarea, $date, $image, $rating, $location, $checkbox, $radio, $number, $degree, $cost );
	
	foreach ($formFieldTypes as $formFieldType){
		$entityManager->persist($formFieldType);
	}
	$entityManager->flush();
	
	/* FORM POSTS */
	
	// FormPost($title, $name, $description)
	
	$studies =		new FormPost("Study Review","study-review","Sample Description");
	$internship =	new FormPost("Internship Review","internship-review","Sample Description");
	
	$formPosts = array( $studies, $internship );
	
	foreach ($formPosts as $formPost){
		$entityManager->persist($formPost);
	}
	$entityManager->flush();
	
	/* FORM GROUPS */
	
	// FormGroup($title, $name, $order=0)
	
	$education =				new FormGroup("Education Information",	"education-information", "Sample Description",	1);
	$company = 					new FormGroup("Internship Information",	"internship-information", "Sample Description",	2);
	
	$expenses = 				new FormGroup("Living Expenses",		"living-expenses", "Sample Description",			3);
	
	$studyExperiences = 		new FormGroup("Study Experiences",		"study-experiences", "Sample Description",		4);
	$internshipExperiences =	new FormGroup("Internship Experiences",	"internship-experiences", "Sample Description",	4);
	
	$studyRating =				new FormGroup("Rate Your Studies",		"study-rating", "Sample Description",				5);
	$internshipRating =			new FormGroup("Rate Your Internship",	"internship-rating", "Sample Description",		5);
	
	$formGroups = array( $education, $company, $expenses, $studyExperiences, $internshipExperiences, $studyRating, $internshipRating );
	
	foreach ($formGroups as $formGroup){
		$entityManager->persist($formGroup);
	}
	$entityManager->flush();
	
	/* FORM FIELDS */
	
	// FormField__construct(FormFieldType $type, FormGroup $group, $title, $name, $placeholder="", $instructions="", $version, $order=0, $required=FALSE)
	
	$formFields = array(
		// Education Information
		new FormField($location,$education, "City",				"field-city-edu",		"Placeholder", "Instructions", 1, 0, true),
		new FormField($text,	$education, "Institution",		"field-institution",	"Placeholder", "Instructions", 1, 1, true),
		new FormField($text,	$education, "Programme",		"field-programme",		"Placeholder", "Instructions", 1, 2, true),
		new FormField($degree,	$education, "Type of Degree",	"field-type-of-degree",	"Placeholder", "Instructions", 1, 3, true),
		new FormField($number,	$education, "Duration",			"field-duration",		"Placeholder", "Number of semesters", 1, 4, true),
		new FormField($number,	$education, "Current Semester",	"field-cur-semester",	"Placeholder", "Instructions", 1, 5, true),
		// Internship Information
		new FormField($location,$company,	"City",				"field-city-intern",	"Placeholder", "Instructions", 1, 0, true),
		new FormField($text,	$company,	"Company",			"field-company",		"Placeholder", "Instructions", 1, 1, true),
		new FormField($checkbox,$company,	"Company identity is confidential", "field-company-confidential", "", "Please, check the box below if your employer requires anonimity.", 1, 2),
		new FormField($text,	$company,	"Job Position",		"field-job-position",	"Placeholder", "Instructions", 1, 3, true),
		// Living Expenses
		new FormField($cost,	$expenses,	"Food",			"field-exp-food",	"Placeholder", "Instructions", 1, 0, true),
		new FormField($cost,	$expenses,	"Accomodation",	"field-exp-accom",	"Placeholder", "Instructions", 1, 1, true),
		new FormField($cost,	$expenses,	"Social Life",	"field-exp-social",	"Placeholder", "Instructions", 1, 2, true),
		// Study Experiences
		new FormField($textarea, $studyExperiences, "Why did you decide to study abroad?",										"field-rew-why",	"Placeholder", "What was the motivation behind choosing the particular programme? - How did you apply for the programme? - Were there any scholarships/grants available?", 1, 0, true),
		new FormField($textarea, $studyExperiences, "What were your experiences during your stay as an international student?",	"field-rew-what",	"Placeholder", "Administration challenges - Student life - Night life - Friends - Getting Settled - School and education experiences - Housing and accommodation",			1, 1, true),
		new FormField($textarea, $studyExperiences, "How did your life change after being an international student?",			"field-rew-how",	"Placeholder", "How have you developed as a person and as a professional? - What are your plans and opportunities for the future? - Would you recommend it to others?",	1, 2, true),
		// Internship Experiences
		new FormField($textarea, $internshipExperiences, "How did you find your internship?",					"field-int-how",	"Placeholder", "What was the motivation behind choosing the particular company for your internship? - How did you get in contact with the company? - Was your internship paid/non-paid?",	1, 0, true),
		new FormField($textarea, $internshipExperiences, "What were your experiences during your internship?",	"field-int-what",	"Placeholder", "What were your tasks and responsibilities? - Atmosphere and working environment - Challenges you have faced - Housing and accommodation (if moved to a new city/country)", 1, 1, true),
		new FormField($textarea, $internshipExperiences, "How would you evaluate your internship?",				"field-int-eval",	"Placeholder", "How have you developed as a person and as a professional? - What are your plans and opportunities for the future? - Would you recommend it to others?",					1, 2, true),
		// Study Rating
		new FormField($rating, $studyRating,		"Academic quality of education",	"field-rating-1",	"", "Teachers, Literature",						1, 0, true),
		new FormField($rating, $studyRating,		"Assistance for integration",		"field-rating-2",	"", "Accommodation, Buddy program, Intro week", 1, 1, true),
		new FormField($rating, $studyRating,		"Events",							"field-rating-3",	"", "Professional workshops, Social activities",1, 2, true),
		new FormField($rating, $studyRating,		"Facilities",						"field-rating-4",	"", "Equipment, Network, Library, Labs",		1, 3, true),
		// Internship Rating
		new FormField($rating, $internshipRating,	"N/A",	"field-rating-1",	"", "Sample Instruction", 1, 0, true),
		new FormField($rating, $internshipRating,	"N/A",	"field-rating-2",	"", "Sample Instruction", 1, 1, true),
		new FormField($rating, $internshipRating,	"N/A",	"field-rating-3",	"", "Sample Instruction", 1, 2, true),
		new FormField($rating, $internshipRating,	"N/A",	"field-rating-4",	"", "Sample Instruction", 1, 3, true)
	);
	
	foreach ($formFields as $formField){
		$entityManager->persist($formField);
	}
	$entityManager->flush();
	
	/* ADDING FORM GROUPS TO FORM POSTS */
	
	$studies->addGroup($education);
	$studies->addGroup($expenses);
	$studies->addGroup($studyExperiences);
	$studies->addGroup($studyRating);
	
	$internship->addGroup($education);
	$internship->addGroup($company);
	$internship->addGroup($expenses);
	$internship->addGroup($internshipExperiences);
	$internship->addGroup($internshipRating);
	
	$entityManager->flush();
	
	
	
?>