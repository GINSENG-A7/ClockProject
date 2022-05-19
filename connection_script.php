<?php
// include './classes/connectionClass.php';
// include './classes/photoClass.php';
// include './classes/entryClass.php';
require_once('./classes/connectionClass.php');
require_once('./classes/photoClass.php');
require_once('./classes/entryClass.php');
$connection = new Connection("127.0.0.1", "root", "root");
// echo($connection->serverIP);
// echo($connection->username);
// echo($connection->password);

// $servername = "127.0.0.1";
// $username = "root";
// $password = "root";

// Create connection
$conn = $connection->get_mysqli_connection('clock');

// Check connection
if ($conn->connect_error) {
	print_r("Connection Error");
  	die("Connection failed: " . $conn->connect_error);
}

// Create connection
$clockUsersConn = $connection->get_mysqli_connection('clockusers');

// Check connection
if ($clockUsersConn->connect_error) {
	print_r("Connection Error");
  	die("Connection failed: " . $clockUsersConn->connect_error);
}


function AddNewImages($connection, $path, $idEntry) {
	$sql = "INSERT INTO `images` (idImage, `path`, idEntry) VALUES (DEFAULT, '$path', $idEntry)";
	print_r($sql);
	mysqli_query($connection, $sql);
}

function AddNewEntry($connection, $title, $body, $price, $idSection) {
	$sql = "INSERT INTO `entryes` (idEntry, title, body, price, idSection) VALUES (DEFAULT, '$title', '$body', $price, $idSection)";
	mysqli_query($connection, $sql);
}

function SelectAllFromEntryes($connection) {
	$sql = "SELECT e.idEntry, e.title, e.body, e.price, e.idSection FROM entryes e";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = new Entry(
			$row['idEntry'],
			$row['title'],
			$row['body'],
			$row['price'],
			$row['idSection']
		);
    }
    return $array;
}

function SelectAllFromEntryesBySectionId($connection, $idSection) {
	$sql = "SELECT e.idEntry, e.title, e.body, e.price, e.idSection FROM entryes e WHERE e.idSection = ".$idSection."";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = new Entry(
			$row['idEntry'],
			$row['title'],
			$row['body'],
			$row['price'],
			$row['idSection']
		);
    }
    return $array;
}

function SelectAllImagesByEntryId($connection, $idEntry) {
	$sql = "SELECT idImage, `path` FROM images WHERE idEntry = ".$idEntry."";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = new Photo(
			$row['idImage'],
			$row['path']
		);
    }
    return $array;
}

function SelectEntryByEntryId($connection, $idEntry) {
	$sql = "SELECT * FROM entryes WHERE idEntry = ".$idEntry."";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    {
		$entry = new Entry(
			$row['idEntry'],
			$row['title'],
			$row['body'],
			$row['price'],
			$row['idSection']
		);
    }
    return $entry;
}

function SelectSectionNameById($connection, $idSection) {
	$sql = "SELECT sectionName FROM sections WHERE idSection = '".$idSection."'";
    $result = mysqli_query($connection, $sql)->fetch_assoc();
	return $result['sectionName'];
}

function SelectSectionIdByName($connection, $sectionName) {
	$sql = "SELECT idSection FROM sections WHERE sectionName = '".$sectionName."'";
    $result = mysqli_query($connection, $sql)->fetch_assoc();
	return $result['idSection'];
}

function SelectAllSections($connection) {
	$sql = "SELECT idSection, sectionName FROM sections";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idSection'=>$row['idSection'],
			'sectionName'=>$row['sectionName']
		);
    }
    return $array;
}

function UpdateEntryById($connection, $idEntry, $newTitle, $newBody, $newPrice) {
	$sql = "UPDATE entryes SET title = '$newTitle', body = '$newBody', price = $newPrice WHERE idEntry = $idEntry";
	mysqli_query($connection, $sql);
}
	
function DeleteEntryAndImages($connection, $idEntry) {
	$sql = "DELETE FROM images WHERE idEntry = ".$idEntry."";
	mysqli_query($connection, $sql);
	$sql = "DELETE FROM entryes WHERE idEntry = ".$idEntry."";
	mysqli_query($connection, $sql);
}

function DeleteImageById($connection, $idImage) {
	$sql = "DELETE FROM images WHERE idImage = ".$idImage."";
	mysqli_query($connection, $sql);
}

function SelectPictureBySection($connection, $idSection) {
	$sql = "SELECT * FROM entryes e Join images i on e.idEntry = i.idEntry  WHERE e.idSection = ".$idSection."";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idEntry'=>$row['idEntry'],
			'title'=>$row['title'],
			'body'=>$row['body'],
			'price'=>$row['price'],
			'idSection'=>$row['idSection'],
			'path'=>$row['path']
		);
    }
    return $array;
}

function SelectFirstPictureBySection($connection, $idSection) { // 0 usages
	$sql = "SELECT * FROM entryes e Join images i on e.idEntry = i.idEntry  WHERE e.idSection = 1 GROUP BY e.idEntry";
	
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
		$tempEntry = new Entry(
			$row['idEntry'],
			$row['title'],
			$row['body'],
			$row['price'],
			$row['idSection']
		);
		$tempEntry->setImages($connection);

        $array[] = $tempEntry;
    }
    return $array;
}

//-----------------------------Users----------------------------//

function AddNewUserInDatabase($connection, $login, $password, $name, $surname, $patronymic, $address, $post_index, $email) {
	$sql = "INSERT INTO `users` (idUser, login, password, name, surname, patronymic, address, post_index, email, token, discount, idRole) VALUES (DEFAULT, '$login', '".md5($password)."', '$name', '$surname', '$patronymic', '$address', '$post_index', '$email', DEFAULT, 0, 3)";
	mysqli_query($connection, $sql);
}

function CheckUserAuthorizationData($connection, $login, $password) {
	// printf($login);
	// printf($password);
	$sql = "SELECT u.login, u.password FROM `users` u WHERE u.login = '".$login."'";
	$result = mysqli_query($connection, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		if ($login == $row['login'] && md5($password) == $row['password']) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

function SelectUserByLogin($connection, $login) {
	$sql = "SELECT * FROM `users` WHERE login = '".$login."'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	return $row;
}

function SelectUserByUserId($connection, $idUser) {
	$sql = "SELECT * FROM `users` WHERE idUser = ".$idUser."";
	$result = mysqli_query($connection, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		$user = new AdvancedUser(
			$row["idUser"],
			$row["idRole"],
			$row["login"],
			$row["password"],
			$row["name"],
			$row["surname"],
			$row["patronymic"],
			$row["address"],
			$row["post_index"],
			$row["email"],
			$row["token"],
			$row["discount"],
		);
		return $user;
	}
	return NULL;
}

function SelectRoleById($connection, $idRole) {
	$sql = "SELECT r.role FROM `roles` r WHERE r.idRole = ".$idRole."";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	return $row;
}

function SelectAllUsersByRoleId($connection, $idRole) {
	$sql = "SELECT * FROM `users` WHERE idRole = ".$idRole."";
	$result = mysqli_query($connection, $sql);
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result))
		{
			$array[] = $row;
		}
		return $array;
	}
	return NULL;
}

function UpdateUsersDiscount($connection, $newDiscount, $idUser) {
	$sql = "UPDATE `users` u SET u.discount = ".$newDiscount." WHERE u.idUser = ".$idUser."";
	mysqli_query($connection, $sql);
}
//------------------------Cart_and_orders--------------------------//
function SelectAllFromOrdersByStatusAndUser($connection, $login, $status_id) {
	$sql = "SELECT * FROM `orders` o WHERE o.status_id = ".$status_id." && o.user_id = (SELECT u.idUser FROM users u WHERE u.login = '".$login."')";
	$result = mysqli_query($connection, $sql);
	if ($result != NULL || !empty($result)) {
		while($row = mysqli_fetch_array($result))
		{
			$array[] = array(
				'idOrder'=>$row['idOrder'],
				'order_date'=>$row['order_date'],
				'paid_date'=>$row['paid_date'],
				'historicalDiscount'=>$row['historicalDiscount'],
				'user_id'=>$row['user_id'],
				'status_id'=>$row['status_id']
			);
		}
		// print_r($array);
		return $array;
	}
	return NULL;
}

function SelectAllFromOrdersByStatus($connection, $status_id) {
	$sql = "SELECT * FROM `orders` o WHERE o.status_id = ".$status_id." ORDER BY o.order_date";
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idOrder'=>$row['idOrder'],
			'order_date'=>$row['order_date'],
			'paid_date'=>$row['paid_date'],
			'historicalDiscount'=>$row['historicalDiscount'],
			'user_id'=>$row['user_id'],
			'status_id'=>$row['status_id']
		);
    }
    return $array;
}

function SelectAllFromOrdersByOrderId($connection, $idOrder) {
	$sql = "SELECT * FROM `orders` o WHERE o.idOrder = ".$idOrder."";
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
    return $result;
}

function SelectEntryesInOrderByOrderId($connection, $idOrder) {
	$sql = "SELECT * FROM entryes_in_order WHERE order_id = ".$idOrder." ORDER BY entry_id";
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idEntry_in_order'=>$row['idEntry_in_order'],
			'historicalPrice'=>$row['historicalPrice'],
			'order_id'=>$row['order_id'],
			'entry_id'=>$row['entry_id']
		);
    }
    return $array;
}

function AddNewOrderToUser($connection, $order_date, $login, $status_id) {
	$sql = "INSERT INTO `orders` (idOrder, order_date, paid_date, `user_id`, status_id) VALUES (DEFAULT, '$order_date', DEFAULT, (SELECT u.idUser FROM users u WHERE u.login = '$login'), $status_id)";
	mysqli_query($connection, $sql);
}

function AddNewEntryToOrder($connection, $order_id, $entry_id) {
	$sql = "INSERT INTO `entryes_in_order` (idEntry_in_order, historicalPrice, order_id, entry_id) VALUES (DEFAULT, NULL, $order_id, $entry_id)";
	mysqli_query($connection, $sql);
}

function UpdateHistoricalPriceInAllEntryesInOrderById($connection, $historicalPrice, $entry_id) {
	$sql = "UPDATE `entryes_in_order` eio SET eio.historicalPrice = ".$historicalPrice." WHERE eio.entry_id = ".$entry_id."";
	mysqli_query($connection, $sql);
}

function UpdateOrderDateAndStatusAndHistoricalDiscountInOrderById($connection, $newOrderDate, $status_id, $idOrder, $login) {
	$sql = "UPDATE `orders` o SET o.order_date = '".$newOrderDate."', o.status_id = ".$status_id.", o.historicalDiscount = (SELECT u.discount FROM users u WHERE u.login = '".$login."') WHERE o.idOrder = ".$idOrder."";
	mysqli_query($connection, $sql);
}

function UpdatePaidDateAndStatusInOrderById($connection, $newPaidDate, $status_id, $idOrder) {
	$sql = "UPDATE `orders` o SET o.paid_date = '".$newPaidDate."', o.status_id = ".$status_id." WHERE o.idOrder = ".$idOrder."";
	mysqli_query($connection, $sql);
}

//------------------------Tickets--------------------------//

function AddNewTicket($connection, $theme, $body, $is_open, $ticket_date, $login, $performer_id) {
	$sql = "INSERT INTO `tickets` (idTicket, theme, body, is_open, ticket_date, `user_id`, performer_id) VALUES (DEFAULT, '$theme', '$body', $is_open, '$ticket_date', (SELECT u.idUser FROM users u WHERE u.login = '$login'), $performer_id)";
	print_r($sql);
	mysqli_query($connection, $sql);
}

function AddNewSimpleTicket($connection, $theme, $body, $is_open, $name, $email, $telephone, $ticket_date) {
	$sql = "INSERT INTO `simple_tickets` (idTicket, theme, body, is_open, `name`, email, telephone, ticket_date) VALUES (DEFAULT, '$theme', '$body', $is_open, '$name', '$email', '$telephone', '$ticket_date')";
	print_r($sql);
	mysqli_query($connection, $sql);
}
?>