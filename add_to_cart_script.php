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
	if (isset($_POST['entryIdInput']) && isset($_POST['sizeIdSelect'])) {
		$cart = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 1);
		$cartItems = SelectEntryesInOrderByOrderId($clockUsersConn, $cart['idOrder']);
		if ($cart == NULL) {
			//создание первого Order
			AddNewOrderToUser($clockUsersConn, date('Y-m-d H:i:s'), $login, 1);
			$cartId = $clockUsersConn->insert_id;
			print_r($_POST['entryIdInput']);
			print_r(' ');
			print_r($_POST['sizeIdSelect']);
			AddNewEntryToOrder($clockUsersConn, $cartId, $_POST['entryIdInput'], $_POST['sizeIdSelect']);
		}
		else {
			print_r($_POST['entryIdInput']);
			print_r(' ');
			print_r($_POST['sizeIdSelect']);
			AddNewEntryToOrder($clockUsersConn, $cart[0]['idOrder'], $_POST['entryIdInput'], $_POST['sizeIdSelect']);
		}
	}
	else if (isset($_POST['entryIdInput'])) {
		$cart = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 1);
		$cartItems = SelectEntryesInOrderByOrderId($clockUsersConn, $cart['idOrder']);
		if ($cart == NULL) {
			//создание первого Order
			AddNewOrderToUser($clockUsersConn, date('Y-m-d H:i:s'), $login, 1);
			$cartId = $clockUsersConn->insert_id;
			print_r($_POST['entryIdInput']);
			AddNewEntryToOrder($clockUsersConn, $cartId, $_POST['entryIdInput'], "NULL");
		}
		else {
			print_r($_POST['entryIdInput']);
			AddNewEntryToOrder($clockUsersConn, $cart[0]['idOrder'], $_POST['entryIdInput'], "NULL");
		}
	}
?>