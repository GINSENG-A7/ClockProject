<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?require_once ("./classes/userClass.php");?>
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

function dateCompare($a, $b) 
{
    if ($a["ticket_date"] == $b["date"]) {
        return 0;
    }
    return (strtotime($a["ticket_date"]) < strtotime($b["ticket_date"])) ? -1 : 1;
}

$materialsArray = SelectAllMaterials($conn);
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
    <title>Admin panel</title>
</head>
<?
$userArray = SelectUserByLogin($clockUsersConn, $login);
if ($userArray['idRole'] == 2) {
?>
<body>
	<input id="sectionsArray" type="hidden" value="sectionsArray"  data-sectionsArrayLength="<?echo(count($sectionsArray))?>">
	<div class="tab">
		<div>
			<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
				<button id="<?=$sectionsArray[$i]['sectionName']?>" class="tab-links"><?echo($sectionsArray[$i]['sectionName'])?></button>
			<?}?>
		</div>
		<div>
			<button id="Клиенты" class="tab-links">Клиенты</button>
		</div>
		<div>
			<button id="Заказы" class="tab-links">Заказы</button>
		</div>
		<div>
			<button id="Отправления" class="tab-links">Отправления</button>
		</div>
		<div>
			<button id="Запросы" class="tab-links">Запросы</button>
		</div>
		<div>
			<button id="Материалы" class="tab-links">Материалы</button>
		</div>
		<form  action="./exit_script.php" method="POST" class="exit_form">
			<input style = "height: 40px;background-color: darkgray;" type="submit" value="Выход">
		</form>
	</div>

	<!-- Tab content -->
	
	<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
		<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-content">
			<h2 class="ContentH2">Добавление</h2>
			<form id="fileForm-<?echo($i)?>" method="POST" action="fileLoader.php" enctype="multipart/form-data">
				<div class="wrapper">
					<span class="wrapper-span">Наименование</span>
					<textarea class="wrapper-title" name="Title" id="title" cols="30" rows="1"></textarea>
				</div>
				<div class="wrapper">
					<span class="wrapper-span">Цена</span>
					<textarea class="wrapper-price" name="Price" id="price" cols="30" rows="1"></textarea>
				</div>
				<div class="wrapper">
					<span class="wrapper-span">Описание</span>
					<textarea class="wrapper-body" name="Body" id="body" cols="30" rows="1"></textarea>
				</div>
				<div class="wrapper">
					<span class="wrapper-span">Материал</span>
					<select name="Material" id="material">
						<?
						for ($y = 0; $y < count($materialsArray); $y++) { 
							?>
							<option value="<?=$materialsArray[$y]['idMaterial']?>"><?=$materialsArray[$y]['value']?></option>
							<?
						}
						?>
					</select>
				</div>
				<!-- <input id="files_input-1" type="submit" value='Загрузить' name="submit"> -->
				<!-- <button id="loadDataButton-1" class="tab-content-button"></button> -->
				<div class="fileInputWrapper">
					<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
				</div>
				<input id="data_input" type="submit" name="Post-submit" value="Добавить">
				<input type="hidden" name="Tab-id" value="<?echo($sectionsArray[$i]['sectionName'])?>">
				<output id="list"></output>
			</form>
		</div>
	<?}?>

	<span class="bottom-line"></span>

	<!-- Output content -->
	
	<?for ($i = 0; $i < count($sectionsArray); $i++) {
		?>
		<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-output">
			<h2 class="OutputH2">Изменение</h2>
			<?
			$entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, $sectionsArray[$i]['idSection'], array("true", "false"));
			if (is_countable($entryesBySectionArray)) {
				for ($j = 0; $j < count($entryesBySectionArray); $j++) {
					if($entryesBySectionArray[$j] != null) {
						// print_r($entryesBySectionArray[$j]);
						?>
							<div class="entry-wrapper">
								<input id="entryesBySectionArray" type="hidden" value="entryesBySectionArray" data-entryesBySectionArrayLength="<?echo(count($entryesBySectionArray))?>"> 
								<form id="outputForm-<?echo($i)?>-<?echo($j)?>" class="outputForm" method="POST" action="dataUpdater.php" >
									<div class="wrapper">
										<span class="wrapper-span">Наименование</span>
										<textarea class="wrapper-title" name="Title" id="title" cols="30" rows="1"><?echo($entryesBySectionArray[$j]->title)?></textarea>
									</div>
									<div class="wrapper">
										<span class="wrapper-span">Цена</span>
										<textarea class="wrapper-price" name="Price" id="price" cols="30" rows="1"><?echo($entryesBySectionArray[$j]->price)?></textarea>
									</div>
									<div class="wrapper">
										<span class="wrapper-span">Описание</span>
										<textarea class="wrapper-body" name="Body" id="body" cols="30" rows="1"><?echo($entryesBySectionArray[$j]->body)?></textarea>
									</div>
									<div class="radioWrapper">
										<p><input type="radio" name="IsActive" value="Enabled" <?if($entryesBySectionArray[$j]->isActive == true) {echo("checked");}?>> Активен</p> 
										<p><input type="radio" name="IsActive" value="Disabled" <?if($entryesBySectionArray[$j]->isActive == false) {echo("checked");}?>> Неактивен</p> 
									</div>
									<div class="wrapper">
										<span class="wrapper-span">Материал</span>
										<select name="Material" id="material">
											<?
											for ($y = 0; $y < count($materialsArray); $y++) { 
												if ($materialsArray[$y]['idMaterial'] == $entryesBySectionArray[$j]->idMaterial) {
													?>
													<option value="<?=$materialsArray[$y]['idMaterial']?>" selected><?=$materialsArray[$y]['value']?></option>
													<?
												}
												else {
													?>
													<option value="<?=$materialsArray[$y]['idMaterial']?>"><?=$materialsArray[$y]['value']?></option>
													<?
												}
											}
											?>
										</select>
									</div>
									<div class="fileInputWrapper">
										<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
									</div>
									<input id="edit_input" type="submit" name="Post-edit" value="Изменить">
									<input type="hidden" name="Section-id" value="<?echo($sectionsArray[$i]['sectionName'])?>">
									<input type="hidden" name="Entry-id" value="<?echo($entryesBySectionArray[$j]->idEntry)?>">
								</form>
								<!-- <form id="deleteForm-<?//echo($i)?>-<?//echo($j)?>" class="deleteForm" method="POST" action="dataDeleter.php">
									<input id="delete_input" type="submit" name="Post-delete" value="Удалить">
									<input type="hidden" name="Entry-id" value="<?//echo($entryesBySectionArray[$j]->idEntry)?>">
								</form> -->
	
								<?$entryesBySectionArray[$j]->setImages($conn);?>
								<input id="imagesByEntryArray" type="hidden" value="imagesByEntryArray" data-imagesByEntryArrayLength="<?echo(count($entryesBySectionArray[$j]->imagesArray))?>">
								<div class="imageWrapper">
										<?for ($u = 0; $u < count($entryesBySectionArray[$j]->imagesArray); $u++) {?>
											<div class="imageWrapper-container">
												<form id="deleteForm-<?echo($i)?>-<?echo($j)?>-<?echo($u)?>" method="POST" action="imageDeleter.php" class="deleteOnePictureForm">
													<img src="<?echo($entryesBySectionArray[$j]->imagesArray[$u]->path)?>" alt="">
													<button id="X-button" class="X-button">X</button>
													<input id="X-submit" type="submit" class="X-submit">
													<input type="hidden" name="ImageId" value="<?echo($entryesBySectionArray[$j]->imagesArray[$u]->idImage)?>">
												</form>
											</div>
										<?}?>
									<div class="add-new-images">
										<form id="insertImageForm-<?echo($i)?>-<?echo($j)?>" method="POST" action="fileLoader.php" class="insertImageForm" enctype="multipart/form-data">
											<div id="insertImage-button" class="insertImage-button">
												<p>+</p>
											</div>
											<input id="insertImage-submit" type="submit" class="insertImage-submit">
											<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
											<input type="hidden" name="Entry-id" value="<?echo($entryesBySectionArray[$j]->idEntry)?>">
										</form>
									</div>
								</div>
							</div>
						<?
					}
					else {
						echo("NULL");
					}
				}
			}
			?>
		</div>
	<?}?>

	<!-- Clients content -->

	<div id="Клиенты" class="tab-output">
		<h2 class="OutputH2">Изменение</h2>
		<div class="clientsGridWrapper">
			<?
			$usersArray = SelectAllUsersByRoleId($clockUsersConn, 3);
			for ($i = 0; $i < count($usersArray); $i++) {
				$user = new AdvancedUser(
					$usersArray[$i]['idUser'],
					$usersArray[$i]['idRole'],
					$usersArray[$i]['login'],
					$usersArray[$i]['password'],
					$usersArray[$i]['name'],
					$usersArray[$i]['surname'],
					$usersArray[$i]['patronymic'],
					$usersArray[$i]['district'],
					$usersArray[$i]['city'],
					$usersArray[$i]['street'],
					$usersArray[$i]['house'],
					$usersArray[$i]['flat'],
					$usersArray[$i]['post_index'],
					$usersArray[$i]['email'],
					$usersArray[$i]['token'],
					$usersArray[$i]['discount']
				);
				?>
				<div class="client">
					<form id="clientForm-<?echo($i)?>" class="clientForm" action="./update_client_data_script.php" method="POST">
						<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
						<div class="client-login">
							<p>Логин: </p>
							<p><?echo($user->login);?></p>
						</div>
						<div class="client-name">
							<p>Имя: </p>
							<p><?echo($user->name);?></p>
						</div>
						<div class="client-surname">
							<p>Фамилия: </p>
							<p><?echo($user->surname);?></p>
						</div>
						<div class="client-patronymic">
							<p>Отчество: </p>
							<p><?echo($user->patronymic);?></p>
						</div>
						<div class="client-discount">
							<p>Скидка(%): </p>
							<input name="clientDiscount" class="client-discount__input" type="number" value="<?echo($user->discount);?>" min="0" max="100">
						</div>
						<input id="client-update__input" type="submit" value="Обновить данные">
					</form>
				</div>
				<?
			}
			?>
		</div>
	</div>

	<!-- Orders content -->

	<div id="Заказы" class="tab-output">
		<h2 class="OutputH2">Отправления</h2>
		<div class="ordersGridWrapper">
			<?
			$ordersArray = SelectAllFromOrdersByStatus($clockUsersConn, 2);
			if ($ordersArray != NULL) {
				for ($i = 0; $i < count($ordersArray); $i++) {
					$user = SelectUserByUserId($clockUsersConn, $ordersArray[$i]["user_id"]);
					?>
					<div class="order">
						<form id="orderForm-<?echo($i)?>" class="orderForm" action="./send_track.php" method="POST">
							<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
							<input name="idOrder" type="hidden" value="<?echo($ordersArray[$i]["idOrder"]);?>">
							<div class="order__client-login">
								<p>Логин: </p>
								<p><?echo($user->login);?></p>
							</div>
							<div class="order__client-discount">
								<p>Скидка: </p>
								<p><?echo($user->discount * 100);?></p>
								<p> %</p>
							</div>
							<div class="order__totalPrice">
								<?
								$totalPrice = 0;
								$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $ordersArray[$i]["idOrder"]);
								for ($j = 0; $j < count($entryesInOrderArray); $j++) {
									$totalPrice += $entryesInOrderArray[$j]['historicalPrice'] - ($entryesInOrderArray[$j]['historicalPrice'] * $user->discount);
								}
								?>
								<p>Cтоимость заказа: </p>
								<p><?echo($totalPrice);?> ₽</p>
							</div>
							<div class="order__date">
								<p>Дата заказа: </p>
								<p><?echo($ordersArray[$i]["order_date"]);?></p>
							</div>
							<div class="order__track">
								<p>Трек номер: </p>
								<input type="text" name="track">
							</div>
							<div class="order__entryes">
								<a class="order__entryes-link" href="./entryesInOrder.php?id=<?=$ordersArray[$i]["idOrder"];?>">
									<button>Товары в заказе</button>
								</a>
							</div>
							
							<input name="sendTrack" type="submit" value="Отправить трек-номер">
							<button class="cancel_order">Отменить заказ</button>
							<!-- Добавить асинхронное выполнение скрипта -->
						</form>
					</div>
					<?
				}
			}
			?>
		</div>
	</div>

	<div id="Отправления" class="tab-output">
		<h2 class="OutputH2">Отправления</h2>
		<div class="ordersGridWrapper">
			<?
			$ordersArray = SelectAllFromOrdersByStatus($clockUsersConn, 5);
			if ($ordersArray != NULL) {
				for ($i = 0; $i < count($ordersArray); $i++) {
					$user = SelectUserByUserId($clockUsersConn, $ordersArray[$i]["user_id"]);
					?>
					<div class="order">
						<form id="orderForm-<?echo($i)?>" class="orderForm" action="./confirm_user_payment.php" method="POST">
							<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
							<input name="idOrder" type="hidden" value="<?echo($ordersArray[$i]["idOrder"]);?>">
							<div class="order__client-login">
								<p>Логин: </p>
								<p><?echo($user->login);?></p>
							</div>
							<div class="order__client-discount">
								<p>Скидка: </p>
								<p><?echo($user->discount * 100);?></p>
								<p> %</p>
							</div>
							<div class="order__totalPrice">
								<?
								$totalPrice = 0;
								$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $ordersArray[$i]["idOrder"]);
								for ($j = 0; $j < count($entryesInOrderArray); $j++) {
									$totalPrice += $entryesInOrderArray[$j]['historicalPrice'] - ($entryesInOrderArray[$j]['historicalPrice'] * $user->discount);
								}
								?>
								<p>Cтоимость заказа: </p>
								<p><?echo($totalPrice);?> ₽</p>
							</div>
							<div class="order__date">
								<p>Дата заказа: </p>
								<p><?echo($ordersArray[$i]["order_date"]);?></p>
							</div>
							<div class="order__track">
								<p>Трек номер: </p>
								<p><?echo($ordersArray[$i]["track"]);?></p>
							</div>
							<div class="order__date">
								<p>Дата оплаты: </p>
								<input type="datetime-local" name="paidDate">
							</div>
							<div class="order__entryes">
								<a class="order__entryes-link" href="./entryesInOrder.php?id=<?=$ordersArray[$i]["idOrder"];?>">
									<button>Товары в заказе</button>
								</a>
							</div>
							
							<input name="confirmUserPayment" type="submit" value="Подтвердить оплату">
							<button class="cancel_order_btn">Отменить заказ</button>
							<!-- Добавить асинхронное выполнение скрипта -->
						</form>
					</div>
					<?
				}
			}
			?>
		</div>
	</div>

	<!-- Tickets content -->

	<div id="Запросы" class="tab-output">
		<h2 class="OutputH2">Обрабатываемые вами сообщения</h2>
		<div class="ticketsGridWrapper">
			<?
			$managerArray = SelectUserByLogin($clockUsersConn, $login);
			$manager = new User(
				$managerArray['idUser'], 
				$managerArray['idRole'], 
				$managerArray['login'], 
				$managerArray['password']
			);
			$ticketsArray = SelectAllFromTickets($clockUsersConn, true, $manager->idUser);
			// print_r($ticketsArray);
			
			$simpleTicketsArray = SelectAllFromSimpleTickets($clockUsersConn, true, $manager->idUser);
			print_r($simpleTicketsArray);
			if ($ticketsArray != NULL || $simpleTicketsArray != NULL) {
				if ($ticketsArray == NULL) {
					$mergedArray = $simpleTicketsArray;
				}
				elseif ($simpleTicketsArray == NULL) {
					$mergedArray = $ticketsArray;
				}
				elseif ($ticketsArray != NULL && $simpleTicketsArray != NULL) {
					$mergedArray = array_merge($ticketsArray, $simpleTicketsArray);
				}
				usort($mergedArray, "dateCompare");
				// print_r($mergedArray);
				for ($i = 0; $i < count($mergedArray); $i++) {
					if ($mergedArray[$i]['user_id'] != NULL) {
						$user = SelectUserByUserId($clockUsersConn, $mergedArray[$i]["user_id"]);
						?>
						<div class="ticket">
							<form id="ticketForm-<?echo($i)?>" class="ticketForm" action="./close_ticket_script.php" method="POST">
								<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
								<input name="idTicket" type="hidden" value="<?echo($mergedArray[$i]["idTicket"]);?>">
								<div class="ticket__theme">
									<p>Тема обращения: </p>
									<p><?echo($mergedArray[$i]["theme"]);?></p>
								</div>
								<div class="ticket__body">
									<p>Сообщение: </p>
									<p><?echo($mergedArray[$i]["body"]);?></p>
								</div>
								<div class="ticket__date">
									<p>Дата обращения: </p>
									<p><?echo($mergedArray[$i]["ticket_date"]);?></p>
								</div>
								<div class="ticket__userFIO">
									<p>Логин пользователя: </p>
									<p><?echo($user->login);?> </p>
								</div>
								<div class="ticket__email">
									<p>Почта пользователя: </p>
									<p><?echo($user->email);?></p>
								</div>
								<input name="becomeTicketPerformer" type="submit" value="Завершить">
								<!-- Добавить асинхронное выполнение скрипта -->
							</form>
						</div>
						<?
					}
					else {
						?>
						<div class="simple_ticket">
							<form id="ticketForm-<?echo($i)?>" class="ticketForm" action="./close_ticket_script.php" method="POST">
								<input name="idTicket" type="hidden" value="<?echo($mergedArray[$i]["idTicket"]);?>">
								<div class="ticket__theme">
									<p>Тема обращения: </p>
									<p><?echo($mergedArray[$i]["theme"]);?></p>
								</div>
								<div class="ticket__body">
									<p>Сообщение: </p>
									<p><?echo($mergedArray[$i]["body"]);?></p>
								</div>
								<div class="ticket__date">
									<p>Дата обращения: </p>
									<p><?echo($mergedArray[$i]["ticket_date"]);?></p>
								</div>
								<div class="ticket__name">
									<p>Псевдоним гостя: </p>
									<p><?echo($mergedArray[$i]["name"]);?></p>
								</div>
								<div class="ticket__contacts">
									<p>Контакты гостя: </p>
									<p><?echo($mergedArray[$i]["telephone"]);?></p>
									<p><?echo($mergedArray[$i]["email"]);?></p>
								</div>
								<input name="becomeTicketPerformer" type="submit" value="Завершить">
								<!-- Добавить асинхронное выполнение скрипта -->
							</form>	
						</div>
						<?
					}
				}
			}
			?>
		</div>
		<h2 class="OutputH2">Текущие обращения</h2>
		<div class="ticketsGridWrapper">
			<?
			$ticketsArray = SelectAllFromTickets($clockUsersConn, true, NULL);
			// print_r($ticketsArray);
			$simpleTicketsArray = SelectAllFromSimpleTickets($clockUsersConn, true, NULL);
			if ($ticketsArray != NULL || $simpleTicketsArray != NULL) {
				if ($ticketsArray == NULL) {
					$mergedArray = $simpleTicketsArray;
				}
				elseif ($simpleTicketsArray == NULL) {
					$mergedArray = $ticketsArray;
				}
				elseif ($ticketsArray != NULL && $simpleTicketsArray != NULL) {
					$mergedArray = array_merge($ticketsArray, $simpleTicketsArray);
				}
				usort($mergedArray, "dateCompare");
				// print_r($mergedArray);
				for ($i = 0; $i < count($mergedArray); $i++) {
					if ($mergedArray[$i]['user_id'] != NULL) {
						$user = SelectUserByUserId($clockUsersConn, $mergedArray[$i]["user_id"]);
						?>
						<div class="ticket">
							<form id="ticketForm-<?echo($i)?>" class="ticketForm" action="./perform_ticket_script.php" method="POST">
								<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
								<input name="idTicket" type="hidden" value="<?echo($mergedArray[$i]["idTicket"]);?>">
								<div class="ticket__theme">
									<p>Тема обращения: </p>
									<p><?echo($mergedArray[$i]["theme"]);?></p>
								</div>
								<div class="ticket__body">
									<p>Сообщение: </p>
									<p><?echo($mergedArray[$i]["body"]);?></p>
								</div>
								<div class="ticket__date">
									<p>Дата обращения: </p>
									<p><?echo($mergedArray[$i]["ticket_date"]);?></p>
								</div>
								<div class="ticket__userFIO">
									<p>Логин пользователя: </p>
									<p><?echo($user->login);?> </p>
								</div>
								<input name="becomeTicketPerformer" type="submit" value="Ответить">
								<!-- Добавить асинхронное выполнение скрипта -->
							</form>
						</div>
						<?
					}
					else {
						?>
						<div class="simple_ticket">
							<form id="ticketForm-<?echo($i)?>" class="ticketForm" action="./perform_ticket_script.php" method="POST">
								<input name="idTicket" type="hidden" value="<?echo($mergedArray[$i]["idTicket"]);?>">
								<div class="ticket__theme">
									<p>Тема обращения: </p>
									<p><?echo($mergedArray[$i]["theme"]);?></p>
								</div>
								<div class="ticket__body">
									<p>Сообщение: </p>
									<p><?echo($mergedArray[$i]["body"]);?></p>
								</div>
								<div class="ticket__date">
									<p>Дата обращения: </p>
									<p><?echo($mergedArray[$i]["ticket_date"]);?></p>
								</div>
								<div class="ticket__name">
									<p>Псевдоним гостя: </p>
									<p><?echo($mergedArray[$i]["name"]);?></p>
								</div>
								<div class="ticket__contacts">
									<p>Контакты гостя: </p>
									<p><?echo($mergedArray[$i]["telephone"]);?></p>
									<p><?echo($mergedArray[$i]["email"]);?></p>
								</div>
								<input name="becomeTicketPerformer" type="submit" value="Ответить">
								<!-- Добавить асинхронное выполнение скрипта -->
							</form>	
						</div>
						<?
					}
				}
			}
			?>
		</div>
	</div>

	<!-- Materials content -->

	<div id="Материалы" class="tab-output">
		<h2 class="OutputH2"></h2>
		<div class="materialsWrapper">
			<?
			$materialsArray = SelectAllMaterials($conn);
			if ($materialsArray != NULL) {
				for ($i = 0; $i < count($materialsArray); $i++) {
					$material = $materialsArray[$i];
					?>
					<div class="material">
						<form id="materialForm-<?echo($i)?>" class="materialForm" action="./delete_material_script.php" method="POST">
							<input name="idMaterial" type="hidden" value="<?echo($material["idMaterial"]);?>">
							<div class="material__value">
								<p><?echo($material["value"]);?></p>
							</div>

							<!-- <input class="material__delete" name="deleteMaterial" type="submit" value="X"> -->
						</form>
					</div>
					<?
				}
			}
			?>
			<div class="material">
				<form id="materialForm-add" class="materialForm" action="./add_new_material_script.php" method="POST">
					<input name="idMaterial" type="hidden" value="<?echo($material["idMaterial"]);?>">
					<div class="material__label">
						<p>Материал: </p>
					</div>
					<div class="material__value">
						<input name="valueMaterial" type="text">
					</div>

					<input class="material__add" name="addMaterial" type="submit" value="Добавить">
				</form>
			</div>
		</div>
	</div>

	<span class="bottom-line"></span>

	<script src="./js/admin.js"></script>
	<script src="./js/filesLoader.js"></script>
	<!-- <script src="./js/sendSecondFormData.js"></script> -->
</body>
<?
}
else {
	?>
	<script>
		alert("Данная страница вам недоступна.");
		window.location.replace("./index.php");
	</script>
	<?
}
?>