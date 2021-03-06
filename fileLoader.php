<?include "./connection_script.php"?>
<?session_start()?>
<?php
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	} 
	else {
		$login = NULL;
	}
	$tempFilesPathArray = array();
	if(isset($_FILES)){
		try {
			for ($i=0; $i < count($_FILES['files']['name']); $i++) {
				// Undefined | Multiple Files | $_FILES Corruption Attack
				// If this request falls under any of them, treat it invalid.
				if (
					$_FILES['files']['error'][$i] != 0
				) {
					throw new RuntimeException('Invalid parameters.');
				}
	
				// Check $_FILES['upfile']['error'] value.
				switch ($_FILES['files']['error'][$i]) {
					case UPLOAD_ERR_OK:
						break;
					case UPLOAD_ERR_NO_FILE:
						throw new RuntimeException('No file sent.');
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						throw new RuntimeException('Exceeded filesize limit.');
					default:
						throw new RuntimeException('Unknown errors.');
				}
	
				// You should also check filesize here.
				if ($_FILES['files']['size'][$i] > 10000000) {
					throw new RuntimeException('Exceeded filesize limit.');
				}
	
				// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
				// Check MIME Type by yourself.
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				if (false === $ext = array_search(
					$finfo->file($_FILES['files']['tmp_name'][$i]),
					array(
						'jpg' => 'image/jpg',
						'jpeg' => 'image/jpeg',
						'png' => 'image/png',
						'gif' => 'image/gif',
					),
					true
				)) {
					throw new RuntimeException('Invalid file format.');
				}
	
				// file name
				$filename = $_FILES['files']['name'];
				$newFileName = hash_file('md5', $_FILES['files']['tmp_name'][$i]).'.'.$ext;
				// Location
				$location = '/img/load_folder/'.$newFileName;
	
				// file extension
				$file_extension = pathinfo($location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
	
				// Valid extensions
				$valid_ext = array("jpg","png","jpeg");
	
				$response = 0;
	
				define ('SITE_ROOT', realpath(dirname(__FILE__)));
	 
				// if(in_array($file_extension,$valid_ext)) {
					// Upload file
					if(move_uploaded_file($_FILES['files']['tmp_name'][$i], SITE_ROOT.$location)){
						$tempFilesPathArray[$i] = $location; //copy files paths to array
						$response = 1;
					}
					else {
						throw new RuntimeException('Failed to move uploaded file.');
					}
				// }
	
				echo $response;
			}
			
			//inserting entryes in tables IMAGES & ENTRYES

			$sectionsArray = SelectAllSections($conn);

			//Adding new pictures
			if (isset($_POST['Entry-id'])) {
				$entryId = $_POST['Entry-id'];
				//???????????????????? ????????????????
				for($j = 0 ; $j < count($tempFilesPathArray); $j++) {
					AddNewImages($conn, $tempFilesPathArray[$j], $entryId);
				}
			}

			elseif (isset($_POST['Title']) && 
			isset($_POST['Price']) && 
			isset($_POST['Body']) &&
			isset($_POST['Tab-id']) &&
			isset($_POST['Material'])) {
				$title = $_POST['Title'];
				$body = $_POST['Body'];
				$price = $_POST['Price'];
				$tabName = $_POST['Tab-id'];
				$idMaterial = $_POST['Material'];
				echo($title);
				echo($body);
				echo($price);
				echo($tabName);
				echo($idMaterial);
				for ($i = 0; $i < count($sectionsArray); $i++) {
					// echo (strcasecmp(trim($POST['Tab-id']),  trim($sectionsArray[$i])) == 0) ? 'Equal' : 'Not equal';
					print_r($sectionsArray[$i]['sectionName']);
					if(trim($tabName) == trim($sectionsArray[$i]['sectionName'])) {
						echo("!");
						AddNewEntry($conn, $title, $body, $price, $idMaterial, SelectSectionIdByName($conn, $tabName));
						$lastInsertedIdInEntryes = mysqli_insert_id($conn);
						for($j = 0 ; $j < count($tempFilesPathArray); $j++) {
							AddNewImages($conn, $tempFilesPathArray[$j], $lastInsertedIdInEntryes);
						}
					}
				}
			}
			else {
				throw new Exception('POST data is not set.');
			}


			exit;
			
		}
		catch (RuntimeException $e) {

			echo $e->getMessage();
		
		}
	}
?>