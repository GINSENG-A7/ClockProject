<?require_once("./connection_script.php")?>
<?require_once("./classes/entryClass.php")?>
<?session_start()?>
<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	} 
	else {
		$login = NULL;
	}
	if (isset($_POST["itemId"]) && isset($_POST['entryesInOrderId']) && isset($_POST["itemCount"]) && isset($_POST["orderId"]) && isset($_POST["sizeIdSelect"])) {
		$entry = SelectEntryByEntryId($conn, $_POST["itemId"]);
		$idEntryesInOrder = $_POST['entryesInOrderId'];
		$idOrder = $_POST["orderId"];
		$itemCount = $_POST["itemCount"];
		$idSize = $_POST["sizeIdSelect"];
		for ($i = 1; $i < $itemCount; $i++) { 
			AddNewEntryToOrder($clockUsersConn, $idOrder, $entry->idEntry, $idSize);
		}
		//Добавить изменение размера
		UpdateHistoricalPriceAndSizeInAllEntryesInOrderById($clockUsersConn, $entry->price, $idSize, $entry->idEntry);
		UpdateOrderDateAndStatusAndHistoricalDiscountInOrderById($clockUsersConn, date('Y-m-d H:i:s'), 2, $idOrder, $login);
	}
	else if (isset($_POST["itemId"]) && isset($_POST['entryesInOrderId']) && isset($_POST["itemCount"]) && isset($_POST["orderId"])) {
		$entry = SelectEntryByEntryId($conn, $_POST["itemId"]);
		$idEntryesInOrder = $_POST['entryesInOrderId'];
		$idOrder = $_POST["orderId"];
		$itemCount = $_POST["itemCount"];
		$idSize = $_POST["sizeIdSelect"];
		for ($i = 1; $i < $itemCount; $i++) { 
			AddNewEntryToOrder($clockUsersConn, $idOrder, $entry->idEntry, "NULL");
		}
		UpdateHistoricalPriceInAllEntryesInOrderById($clockUsersConn, $entry->price, $entry->idEntry);
		UpdateOrderDateAndStatusAndHistoricalDiscountInOrderById($clockUsersConn, date('Y-m-d H:i:s'), 2, $idOrder, $login);
	}
?>