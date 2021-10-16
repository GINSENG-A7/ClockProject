<?php
// print_r($POST["title"]);
// print_r($POST["price"]);
// print_r($POST["body"]);
if (!empty($_POST["submitInput"])) {
	echo ($POST["textInput"]);
}
else {
	echo ("нихуя не пришло");
}
?>