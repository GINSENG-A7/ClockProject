<?require_once("./connection_script.php");?>
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/admin.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cart</title>
</head>
<body>
	<div class="card">
		<?
		if (isset( $_GET['id'] ) && !empty( $_GET['id'] )) {
			$order = SelectAllFromOrdersByOrderId($clockUsersConn, $_GET['id']);
			if ($order != NULL) {
				$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $_GET['id']);
				// print_r($entryesInOrderArray);
				for ($i = 0; $i < count($entryesInOrderArray); $i++) {
					$entry = SelectEntryByEntryId($conn, $entryesInOrderArray[$i]['entry_id']);
					$entry->setImages($conn);
					?> 
					<div class="card__item">
						<a href="./descripshen.php?id=<?=$entry->idEntry?>">
							<div class="card__img">
								<div class = "img" style= "background-image: url('<?=$entry->imagesArray[0]->path?>')">

								</div>
								<div class = "img-back" style= "background-image: url('<?=$entry->imagesArray[1]->path?>')">

								</div>
							</div>
							<div class="card__decription">
								<div class="card__title">
									<?=$entry->title?>
								</div>
								<div class="card__price">
									<?=$entry->price?> руб
								</div>
							</div>
						</a>
						<div class="card__btn">
							<a href="./descripshen.php?id=<?=$entry->idEntry?>">Подробнее...</a>
						</div>
					</div>
					<?
				}
			}
		}
		?>
	</div>
	<button class="backwardButton">Назад</button>
	<script src="./js/cart.js"></script>
</body>