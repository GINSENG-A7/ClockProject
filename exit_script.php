<?
session_start();
if (isset($_SESSION["login"])) {
	$login = $_SESSION["login"];
	print_r($login);
} 
session_destroy();
// header("/index.php");
?>
	<!-- <script>
		window.location.replace("/index.php");
	</script> -->
<?
?>