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
	if(isset($_POST['userId']) && isset($_POST['theme'])) {
		
	}
?>