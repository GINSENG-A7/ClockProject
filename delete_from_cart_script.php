<?require_once("./connection_script.php")?>
<?session_start()?>
<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	} 
	else {
		$login = NULL;
	}
	if(isset($_POST['entryesInOrderId'])) {
		$entryesInOrderId = $_POST['entryesInOrderId'];
		print_r($itemId);
		print_r(" ");
		$entryInOrder = SelectEntryesInOrderById($clockUsersConn, $entryesInOrderId);
		DeleteEntryInOrderByEntryId($clockUsersConn, $entryInOrder['idEntry_in_order']);
	}
?>