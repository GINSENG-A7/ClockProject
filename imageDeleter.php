<?include "./connection_script.php"?>
<?php
if(isset($_POST['ImageId'])) {
	print_r("yes");
	$ImageId = $_POST['ImageId'];
	DeleteImageById($conn, $ImageId);
}
?>