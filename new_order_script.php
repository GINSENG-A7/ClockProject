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
	if(isset($_POST["itemId"]) && isset($_POST["itemCount"]) && isset($_POST["orderId"])) {
		print_r($_POST["itemId"]);
		print_r($_POST["itemCount"]);
		$entryesArray = array();
		$idOrder = $_POST["orderId"];
		$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $idOrder);
		for ($a = 0; $a < count($entryesInOrderArray); $a++) {
			for ($i = 0; $i < count($_POST["itemId"]); $i++) {
				if($entryesInOrderArray[$a]['entry_id'] == $_POST["itemId"][$i]) {
					for ($j = 0; $j < $_POST["itemCount"][$i] - 1; $j++) {
						print_r($_POST["itemId"][$i]);
						AddNewEntryToOrder($clockUsersConn, $idOrder, $_POST["itemId"][$i]);
					}
				}
			}	
			array_push($entryesArray, SelectEntryByEntryId($conn, $entryesInOrderArray[$a]['entry_id']));
		}
		for ($i = 0; $i < count($entryesArray); $i++) {
			// print_r($entryesArray[$i]->price);
			UpdateHistoricalPriceInAllEntryesInOrderById($clockUsersConn, $entryesArray[$i]->price, $entryesArray[$i]->idEntry);
		}
		UpdateOrderDateAndStatusAndHistoricalDiscountInOrderById($clockUsersConn, date('Y-m-d H:i:s'), 2, $idOrder, $login);
		// print_r($entryesArray);

	}
?>