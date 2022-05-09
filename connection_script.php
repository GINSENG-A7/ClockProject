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

function AddNewUserInDatabase($connection, $login, $password, $name, $surname, $patronymic, $address, $email) {
	$sql = "INSERT INTO `users` (idUser, login, password, name, surname, patronymic, address, email, token, discount, role_id) VALUES (DEFAULT, '$login', '".md5($password)."', '$name', '$surname', '$patronymic', '$address', '$email', DEFAULT, 0, 3)";
	mysqli_query($connection, $sql);
}

function CheckUserAuthorizationData($connection, $login, $password) {
	// printf($login);
	// printf($password);
	$sql = "SELECT u.login, u.password FROM `users` u WHERE u.login = '".$login."'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	if ($result->num_rows > 0) {
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

function SelectRoleById($connection, $idRole) {
	$sql = "SELECT r.role FROM `roles` r WHERE r.idRole = ".$idRole."";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	return $row;
}

//------------------------Cart--------------------------//
function SelectAllFromOrdersByStatusAndUser($connection, $login, $status_id) {
	$sql = "SELECT * FROM `orders` o WHERE o.status_id = ".$status_id." && o.user_id = (SELECT u.idUser FROM users u WHERE u.login = '".$login."')";
	$result = mysqli_query($connection, $sql);
	if ($result == NULL || empty($result)) {
		return NULL;
	}
	while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idOrder'=>$row['idOrder'],
			'result_value'=>$row['result_value'],
			'order_date'=>$row['order_date'],
			'user_id'=>$row['user_id'],
			'status_id'=>$row['status_id']
		);
    }
    return $array;
}

function SelectEntryesInOrderByOrderId($connection, $idOrder) {
	$sql = "SELECT * FROM entryes_in_order WHERE order_id = ".$idOrder."";
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
	$sql = "INSERT INTO `orders` (idOrder, order_date, `user_id`, status_id) VALUES (DEFAULT, '$order_date', (SELECT u.idUser FROM users u WHERE u.login = '$login'), $status_id)";
	mysqli_query($connection, $sql);
}

function AddNewEntryToOrder($connection, $order_id, $entry_id) {
	$sql = "INSERT INTO `entryes_in_order` (idEntry_in_order, historicalPrice, order_id, entry_id) VALUES (DEFAULT, NULL, $order_id, $entry_id)";
	mysqli_query($connection, $sql);
}
?>