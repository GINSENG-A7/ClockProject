<?require_once ("./connection_script.php");?>
<?require_once ("./classes/advancedUserClass.php");?>
<?
session_start();
$sectionsArray = SelectAllSections($conn);
if (isset($_SESSION["login"])) {
	$login = $_SESSION["login"];
	// print_r($login);
} 
else {
	$login = NULL;
}
if(isset($_POST["paidDate"]) && isset($_POST["idOrder"])) {
	$paidDateAsStr = $_POST["paidDate"];
	$paidDateFormated = date('Y-m-d H:i:s', strtotime($paidDateAsStr));
	print($paidDateFormated);
	
	UpdatePaidDateAndStatusInOrderById($clockUsersConn, $paidDateFormated, 4, $_POST["idOrder"]);
}
?>