<?php
require_once "bootstrap.php";

$photos = new FormGroup("Photos", "photos", "Sample Description", 5);
$entityManager->persist($photos);
$entityManager->flush();

$type = $entityManager->find('FormFieldType', 4);

$upload = new FormField( $type , $photos , "Upload your photos", "field-upload-photos", "", "Illustrate your story as much as you can! You can upload 12 pictures here. If you want to share more photos or other kinds of media, just upload it to Google Drive or any cloud storage and share us the link instead!", 1, 0, false);
$entityManager->persist($upload);
$entityManager->flush();

$studies = $entityManager->find('FormPost', 1);
$internship = $entityManager->find('FormPost', 2);

$studies->addGroup($photos);
$internship->addGroup($photos);

$entityManager->flush();
?>