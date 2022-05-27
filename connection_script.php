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
	$sql = "SELECT sectionName FROM sections WHERE idSection = ".$idSection."";
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

function SelectValuesFromSizesBySectionId($connection, $section_id) {
	$sql = "SELECT * FROM `sizes` WHERE section_id = ".$section_id."";
	// print_r($sql);
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idSize'=>$row['idSize'],
			'value'=>$row['value'],
			'isActive'=>$row['isActive'],
			'section_id'=>$row['section_id']
		);
    }
    return $array;
}

function SelectSizeById($connection, $idSize) {
	$sql = "SELECT * FROM `sizes` WHERE idSize = ".$idSize."";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

function UpdateSizeIsActiveById($connection, $isActive, $idSize) {
	$sql = "UPDATE `sizes` SET isActive = ".$isActive." WHERE idSize = ".$idSize."";
	print_r($sql);
	mysqli_query($connection, $sql);
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

function AddNewUserInDatabase($connection, $login, $password, $name, $surname, $patronymic, $district, $city, $street, $house, $flat, $post_index, $email) {
	$sql = "INSERT INTO `users` (idUser, login, password, name, surname, patronymic, district, city, street, house, flat, post_index, email, token, discount, idRole) VALUES (DEFAULT, '$login', '".md5($password)."', '$name', '$surname', '$patronymic', '$district', '$city', '$street', '$house', '$flat', '$post_index', '$email', DEFAULT, 0, 3)";
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
	$row = mysqli_fetch_assoc($result);
	return $row;
}

function SelectUserByEmail($connection, $email) {
	$sql = "SELECT * FROM `users` WHERE email = '".$email."'";
	$result = mysqli_query($connection, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
	return NULL;
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
			$row["district"],
			$row["city"],
			$row["street"],
			$row["house"],
			$row["flat"],
			$row["post_index"],
			$row["email"],
			$row["token"],
			$row["discount"],
		);
		return $user;
	}
	return NULL;
}

function SelectAllFromRoles($connection) {
	$sql = "SELECT * FROM `roles`";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_array($result))
	{
		$array[] = array(
			'idRole'=>$row['idRole'],
			'role'=>$row['role']
		);
	}
	// print_r($array);
	return $array;
}

function SelectRoleById($connection, $idRole) {
	$sql = "SELECT r.role FROM `roles` r WHERE r.idRole = ".$idRole."";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
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

function UpdateUsersData($connection, $login, $name, $surname, $patronymic, $district, $city, $street, $house, $flat, $postIndex) {
	$sql = "UPDATE `users` u SET u.name = '".$name."', u.surname = '".$surname."', u.patronymic = '".$patronymic."', u.district = '".$district."', u.city = '".$city."', u.street = '".$street."', u.house = '".$house."', u.falt = '".$flat."', u.post_index = ".$postIndex." WHERE u.login = '".$login."'";
	mysqli_query($connection, $sql);
}

function UpdateUsersPassword($connection, $login, $newPassword) {
	$sql = "UPDATE `users` u SET u.password = ".md5($newPassword)." WHERE u.login = '".$login."'";
	mysqli_query($connection, $sql);
}

function UpdateUsersDataAsAdmin($connection, $idUser, $login, $name, $surname, $patronymic, $district, $city, $street, $house, $flat, $postIndex, $discount, $idRole) {
	$sql = "UPDATE `users` u SET u.login = '".$login."', u.name = '".$name."', u.surname = '".$surname."', u.patronymic = '".$patronymic."', u.district = '".$district."', u.city = '".$city."', u.street = '".$street."', u.house = '".$house."', u.falt = '".$flat."', u.post_index = ".$postIndex.", u.discount = ".$discount.", u.idRole = ".$idRole." WHERE u.idUser = ".$idUser."";
	mysqli_query($connection, $sql);
}

function DeleteUserCascade($connection, $entyesConnection, $idUser) {
	$sql1 = "DELETE FROM `users` WHERE idUser = ".$idUser."";
	mysqli_query($connection, $sql1);
	$sql2 = "DELETE FROM `comments` WHERE user_id = ".$idUser."";
	mysqli_query($entyesConnection, $sql2);
	$sql3 = "DELETE FROM `tickets` WHERE user_id = ".$idUser."";
	mysqli_query($connection, $sql3);
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
			'entry_id'=>$row['entry_id'],
			'size_id'=>$row['size_id']
		);
    }
    return $array;
}

function SelectEntryesInOrderById($connection, $entryesInOrderId) {
	$sql = "SELECT * FROM entryes_in_order WHERE idEntry_in_order = ".$entryesInOrderId."";
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	$row = mysqli_fetch_array($result);
    return $row;
}

function AddNewOrderToUser($connection, $order_date, $login, $status_id) {
	$sql = "INSERT INTO `orders` (idOrder, order_date, paid_date, `user_id`, status_id) VALUES (DEFAULT, '$order_date', DEFAULT, (SELECT u.idUser FROM users u WHERE u.login = '$login'), $status_id)";
	mysqli_query($connection, $sql);
}

function AddNewEntryToOrder($connection, $order_id, $entry_id, $size_id) {
	$sql = "INSERT INTO `entryes_in_order` (idEntry_in_order, historicalPrice, order_id, entry_id, size_id) VALUES (DEFAULT, NULL, $order_id, $entry_id, $size_id)";
	mysqli_query($connection, $sql);
}

function UpdateHistoricalPriceInAllEntryesInOrderById($connection, $historicalPrice, $entry_id) {
	$sql = "UPDATE `entryes_in_order` eio SET eio.historicalPrice = ".$historicalPrice." WHERE eio.entry_id = ".$entry_id."";
	mysqli_query($connection, $sql);
}

function UpdateHistoricalPriceAndSizeInAllEntryesInOrderById($connection, $historicalPrice, $size_id, $entry_id) {
	$sql = "UPDATE `entryes_in_order` eio SET eio.historicalPrice = ".$historicalPrice.", eio.size_id = ".$size_id." WHERE eio.entry_id = ".$entry_id."";
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

function DeleteEntryInOrderByEntryId($connection, $entryesInOrderId) {
	$sql = "DELETE FROM `entryes_in_order` eio WHERE eio.idEntry_in_order = ".$entryesInOrderId."";
	print_r($sql);
	mysqli_query($connection, $sql);
}

//------------------------Tickets--------------------------//

function AddNewTicket($connection, $theme, $body, $is_open, $ticket_date, $login, $performer_id) {
	$sql = "INSERT INTO `tickets` (idTicket, theme, body, is_open, ticket_date, `user_id`, performer_id) VALUES (DEFAULT, '$theme', '$body', $is_open, '$ticket_date', (SELECT u.idUser FROM users u WHERE u.login = '$login'), $performer_id)";
	print_r($sql);
	mysqli_query($connection, $sql);
}

function AddNewSimpleTicket($connection, $theme, $body, $is_open, $name, $email, $telephone, $ticket_date) {
	$sql = "INSERT INTO `simple_tickets` (idTicket, theme, body, is_open, `name`, email, telephone, ticket_date, performer_id) VALUES (DEFAULT, '$theme', '$body', $is_open, '$name', '$email', '$telephone', '$ticket_date', 'NULL')";
	print_r($sql);
	mysqli_query($connection, $sql);
}

function SelectAllFromSimpleTickets($connection, $is_open, $performer_id) {
	$sql = "SELECT * FROM `simple_tickets` WHERE is_open = ".$is_open." AND performer_id = ".$performer_id."";
	if ($performer_id == NULL) {
		$sql = "SELECT * FROM `simple_tickets` WHERE is_open = ".$is_open." AND performer_id IS NULL";
	}
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	while($row = mysqli_fetch_array($result))
    {
		$array[] = array(
			'idTicket'=>$row['idTicket'],
			'theme'=>$row['theme'],
			'body'=>$row['body'],
			'is_open'=>$row['is_open'],
			'name'=>$row['name'],
			'email'=>$row['email'],
			'telephone'=>$row['telephone'],
			'ticket_date'=>$row['ticket_date'],
			'performer_id'=>$row['performer_id']
		);
    }
    return $array;
}

function SelectAllFromTickets($connection, $is_open, $performer_id) {
	$sql = "SELECT * FROM `tickets` WHERE is_open = ".$is_open." AND performer_id = ".$performer_id."";
	if ($performer_id == NULL) {
		$sql = "SELECT * FROM `tickets` WHERE is_open = ".$is_open." AND performer_id IS NULL";
	}
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idTicket'=>$row['idTicket'],
			'theme'=>$row['theme'],
			'body'=>$row['body'],
			'is_open'=>$row['is_open'],
			'ticket_date'=>$row['ticket_date'],
			'user_id'=>$row['user_id'],
			'performer_id'=>$row['performer_id']
		);
    }
    return $array;
}

function UpdateTicketStatusAndPerformer($connection, $performer_id, $is_open, $idTicket) {
	$sql = "UPDATE `tickets` t SET t.performer_id = ".$performer_id.", t.is_open = ".$is_open." WHERE t.idTicket = ".$idTicket."";
	print_r($sql);
	mysqli_query($connection, $sql);
}

function UpdateSimpleTicketStatusAndPerformer($connection, $performer_id, $is_open, $idTicket) {
	$sql = "UPDATE `simple_tickets` s SET s.performer_id = ".$performer_id.", s.is_open = ".$is_open." WHERE s.idTicket = ".$idTicket."";
	print_r($sql);
	mysqli_query($connection, $sql);
}
?>