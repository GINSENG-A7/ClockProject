<?include "./connection_script.php"?>
<?php
$sectionsArray = SelectAllSections($conn);
if (isset($_POST['Title']) &&
isset($_POST['Price']) &&
isset($_POST['Body']) &&
isset($_POST['Section-id']) &&
isset($POST['Entry-id'])) {
	$title = $_POST['Title'];
	$body = $_POST['Body'];
	$price = $_POST['Price'];
	$sectionId = $_POST['Section-id'];
	$entryId = $_POST['Entry-id'];
	echo($title);
	echo($body);
	echo($price);
	echo($sectionId);
	echo($entryId);
	// for ($i = 0; $i < count($sectionsArray); $i++) {
	// 	// echo (strcasecmp(trim($POST['Tab-id']),  trim($sectionsArray[$i])) == 0) ? 'Equal' : 'Not equal';
	// 	print_r($sectionsArray[$i]['sectionName']);
	// 	if(trim($tabName) == trim($sectionsArray[$i]['sectionName'])) {
	// 		echo("!");
	// 		AddNewEntry($conn, $title, $body, $price, SelectSectionIdByName($conn, $tabName));
	// 		$lastInsertedIdInEntryes = mysqli_insert_id($conn);
	// 		for($j = 0 ; $j < count($tempFilesPathArray); $j++) {
	// 			AddNewImages($conn, $tempFilesPathArray[$j], $lastInsertedIdInEntryes);
	// 		}
	// 	}
	// }
	UpdateEntryById($conn, $entryId, $title, $body, $price);
}
?>