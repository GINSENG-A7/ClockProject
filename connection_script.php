<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";

// Create connection
$conn = mysqli_connect($servername, $username, $password, 'clock');

// Check connection
if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
}


function AddNewImages($connection, $path, $idEntry) {
	$sql = "INSERT images VALUES (NULL, $path, $idEntry)";
	mysqli_query($connection, $sql);
}

function AddNewEntry($connection, $title, $body, $price, $idSection) {
	$sql = "INSERT INTO entryes VALUES (NULL, $title, $body, $price, $idSection)";
	mysqli_query($connection, $sql);
}

function SelectAllFromEntryes($connection) {
	$sql = "SELECT e.idEntry, e.title, e.body, e.price, e.idSection FROM entryes e";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = array(
			'idEntry'=>$row['path'],
			'title'=>$row['title'],
			'body'=>$row['body'],
			'price'=>$row['price'],
			'idSection'=>$row['idSection']
		);
    }
    return $array;
}

function SelectAllImagesByEntryId($connection, $idEntry) {
	$sql = "SELECT i.path FROM images i WHERE i.idEntry = ".$idEntry."";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $array[] = $row['path'];
    }
    return $array;
}

function SelectSectionById($connection, $idSection) {
	$sql = "SELECT sectionName FROM sections WHERE ".$idSection."";
    $result = mysqli_query($connection, $sql);
	return $result;
}

function SelectAllSections($connection) {
	$sql = "SELECT sectionName FROM sections";
    $result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_array($result))
    {
        $array[] = $row['sectionName'];
    }
    return $array;
}
	
function DeleteEntryAndImage($connection, $idEntry) {
	$sql = "DELETE FROM images WHERE idEntry=".$idEntry."";
	mysqli_query($connection, $sql);
	$sql = "DELETE FROM entryes WHERE idEntry=".$idEntry."";
	mysqli_query($connection, $sql);
}

function DeleteImageById($connection, $idImage) {
	$sql = "DELETE FROM images WHERE idImage=".$idImage."";
	mysqli_query($connection, $sql);
}
?>