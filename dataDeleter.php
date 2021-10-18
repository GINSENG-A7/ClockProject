<?include "./connection_script.php"?>
<?php
if (isset($POST['Entry-id'])) {
	$entryId = $_POST['Entry-id'];
	echo($entryId);
	DeleteEntryAndImages($conn, $entryId);
}
?>