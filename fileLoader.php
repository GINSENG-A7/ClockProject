<?php
	if(isset($_FILES)){
		try {

			// Undefined | Multiple Files | $_FILES Corruption Attack
			// If this request falls under any of them, treat it invalid.
			if (
				$_FILES['files']['error'][0] != 0
			) {
				throw new RuntimeException('Invalid parameters.');
			}

			// Check $_FILES['upfile']['error'] value.
			switch ($_FILES['files']['error'][0]) {
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
			if ($_FILES['files']['size'][0] > 1000000) {
				throw new RuntimeException('Exceeded filesize limit.');
			}

			// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
			// Check MIME Type by yourself.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (false === $ext = array_search(
				$finfo->file($_FILES['files']['tmp_name'][0]),
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
			$newFileName = hash_file('md5', $_FILES['files']['tmp_name'][0]).'.'.$ext;
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
				if(move_uploaded_file($_FILES['files']['tmp_name'][0], SITE_ROOT.$location)){
					$response = 1;
				}
				else {
					throw new RuntimeException('Failed to move uploaded file.');
				}
			// }

			echo $response;
			exit;
		}
		catch (RuntimeException $e) {

			echo $e->getMessage();
		
		}
	}
?>