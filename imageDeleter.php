<?include "./connection_script.php"?>
<?php
if(isset($_POST['ImageId'])) {
	$ImageId = $_POST['ImageId'];
	DeleteImageById($conn, $ImageId);
}
?>