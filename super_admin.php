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
if ($userArray['idRole'] == 1) {
?>
<body>
	<div class="tab">
		<div>
			<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
				<button class="tab-links"><?echo($sectionsArray[$i]['sectionName'])?></button>
			<?}?>
		</div>
		<div>
			<button class="tab-links">Клиенты</button>
		</div>
		<div>
			<button class="tab-links">Сотрудники</button>
		</div>
		<form  action="./exit_script.php" method="POST" class="exit_form">
			<input style = "height: 40px;background-color: darkgray;" type="submit" value="Выход">
		</form>
	</div>
	
		<!-- Sizes content -->
		
		<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
			<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-content">
				<h2 class="ContentH2">Размеры</h2>
				<div class="sizes">
					<?
					$sizesArray = SelectValuesFromSizesBySectionId($conn, $sectionsArray[$i]['idSection']);
					if ($sizesArray != NULL && !empty($sizesArray)) {
						for ($j = 0; $j < count($sizesArray); $j++) { 
							?>
							<form id="sizeForm-<?=$i?>-<?=$j?>" class="sizeForm sizeEditForm" action="change_size_activity_script.php" method="post">
								<input name="sizeId" type="hidden" value="<?=$sizesArray[$j]['idSize']?>">
								<div class="sizeForm-value">
									<p><?=$sizesArray[$j]['value']?></p>
								</div>
								<?
								if ($sizesArray[$j]['isActive'] == true) {
									?>
									<input class="sizeForm-disable" name="disableSize" type="submit" value="Убрать">
									<?
								}
								else {
									?>
									<input class="sizeForm-disable" name="ableSize" type="submit" value="Вернуть">
									<?
								}
								?>
								<button class="sizeForm-delete">Удалить</button>
							</form>
							<?
						}
					}
					?>
					<form id="sizeForm-add" class="sizeForm" action="add_new_size.php" method="post">
						<input class="sizeForm-newValue" name="sizeForm-value">
						<input class="sizeForm-add" name="addSize" type="submit" value="+">
					</form>
				</div>
		</div>
		<?}?>

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

		<!-- Output content -->
	
		<?for ($i = 0; $i < count($sectionsArray); $i++) {
		?>
		<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-output">
			<h2 class="OutputH2">Изменение</h2>
			<?
			$entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, $sectionsArray[$i]['idSection']);
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
										<p><input type="radio" name="IsActive" value="Enabled"> Активен</p> 
										<p><input type="radio" name="IsActive" value="Disabled"> Неактивен</p> 
									</div>
									<div class="fileInputWrapper">
										<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
									</div>
									<input id="edit_input" type="submit" name="Post-edit" value="Изменить">
									<input type="hidden" name="Section-id" value="<?echo($sectionsArray[$i]['sectionName'])?>">
									<input type="hidden" name="Entry-id" value="<?echo($entryesBySectionArray[$j]->idEntry)?>">
								</form>
								<form id="deleteForm-<?echo($i)?>-<?echo($j)?>" class="deleteForm" method="POST" action="dataDeleter.php">
									<input id="delete_input" type="submit" name="Post-delete" value="Удалить">
									<input type="hidden" name="Entry-id" value="<?echo($entryesBySectionArray[$j]->idEntry)?>">
								</form>
	
								<?$entryesBySectionArray[$j]->setImages($conn);?>
								<input id="imagesByEntryArray" type="hidden" value="imagesByEntryArray" data-imagesByEntryArrayLength="<?echo(count($entryesBySectionArray[$j]->imagesArray))?>">
								<div class="imageWrapper">
										<?for ($u = 0; $u < count($entryesBySectionArray[$j]->imagesArray); $u++) {?>
											<div class="imageWrapper-container">
												<form id="deleteForm-<?echo($i)?>-<?echo($j)?>-<?echo($u)?>" method="POST" action="imageDeleter.php" class="deleteOnePictureForm">
													<img src="<?echo($entryesBySectionArray[$j]->imagesArray[$u]->path)?>" alt="">
													<button id="X-button" class="X-button">X</button>
													<input id="X-submit" type="submit" class="X-submit">
													<input type="hidden" name="ImageId" value="<?echo($imagesByEntryArray[$u]['idImage'])?>">
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
			$rolesArray = SelectAllFromRoles($clockUsersConn);
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
					<form id="clientForm-<?echo($i)?>" class="clientForm" action="update_client_data_script.php" method="POST">
						<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
						<div class="client-login">
							<p>Логин: </p>
							<input name="clientLogin" type="text" value="<?=$user->login?>">
						</div>
						<div class="client-email">
							<p>Эл. почта: </p>
							<input name="clientEmail" type="text" value="<?=$user->email?>">
						</div>
						<div class="client-role">
							<p>Роль: </p>
							<select name="clientRole">
								<?
								for ($j = 0; $j < count($rolesArray); $j++) { 
									if ($rolesArray[$j]['idRole'] == $user->idRole) {
										?>
										<option selected value="<?=$rolesArray[$j]['idRole']?>"><?=$rolesArray[$j]['role']?></option>
										<?
									}
									else {
										?>
										<option value="<?=$rolesArray[$j]['idRole']?>"><?=$rolesArray[$j]['role']?></option>
										<?
									}
								}
								?>
							</select>
						</div>
						<div class="client-name">
							<p>Имя: </p>
							<input name="clientName" type="text" value="<?=$user->name?>">
						</div>
						<div class="client-surname">
							<p>Фамилия: </p>
							<input name="clientSurname" type="text" value="<?=$user->surname?>">
						</div>
						<div class="client-patronymic">
							<p>Отчество: </p>
							<input name="clientPatronymic" type="text" value="<?=$user->patronymic?>">
						</div>
						<div class="client-discount">
							<p>Скидка(%): </p>
							<input name="clientDiscount" class="client-discount__input" type="number" value="<?echo($user->discount);?>" min="0" max="100">
						</div>
						<input id="client-update__input" type="submit" value="Обновить данные">
						<button class="client-delete__button">Удалить учётную запись</button>
					</form>
				</div>
				<?
			}
			?>
		</div>
	</div>

	<!-- Managers content -->

<!-- Сделать по примеру выше!!!! -->

	<div id="Сотрудники" class="tab-output">
		<h2 class="OutputH2">Изменение</h2>
		<div class="clientsGridWrapper">
			<?
			$usersArray = SelectAllUsersByRoleId($clockUsersConn, 2);
			$rolesArray = SelectAllFromRoles($clockUsersConn);
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
					<form id="clientForm-<?echo($i)?>" class="clientForm" action="update_client_data_script.php" method="POST">
						<input name="idUser" type="hidden" value="<?echo($user->idUser);?>">
						<div class="client-login">
							<p>Логин: </p>
							<input name="clientLogin" type="text" value="<?=$user->login?>">
						</div>
						<div class="client-email">
							<p>Эл. почта: </p>
							<input name="clientEmail" type="text" value="<?=$user->email?>">
						</div>
						<div class="client-role">
							<p>Роль: </p>
							<select name="clientRole">
								<?
								for ($j = 0; $j < count($rolesArray); $j++) { 
									if ($rolesArray[$j]['idRole'] == $user->idRole) {
										?>
										<option selected value="<?=$rolesArray[$j]['idRole']?>"><?=$rolesArray[$j]['role']?></option>
										<?
									}
									else {
										?>
										<option value="<?=$rolesArray[$j]['idRole']?>"><?=$rolesArray[$j]['role']?></option>
										<?
									}
								}
								?>
							</select>
						</div>
						<div class="client-name">
							<p>Имя: </p>
							<input name="clientName" type="text" value="<?=$user->name?>">
						</div>
						<div class="client-surname">
							<p>Фамилия: </p>
							<input name="clientSurname" type="text" value="<?=$user->surname?>">
						</div>
						<div class="client-patronymic">
							<p>Отчество: </p>
							<input name="clientPatronymic" type="text" value="<?=$user->patronymic?>">
						</div>
						<div class="client-discount">
							<p>Скидка(%): </p>
							<input name="clientDiscount" class="client-discount__input" type="number" value="<?echo($user->discount);?>" min="0" max="100">
						</div>
						<input id="client-update__input" type="submit" value="Обновить данные">
						<button class="client-delete__button">Удалить учётную запись</button>
					</form>
				</div>
				<?
			}
			?>
		</div>
	</div>

	<!-- <script src="./js/admin.js"></script> -->
	<script src="./js/super_admin.js"></script>
	<script src="./js/filesLoader.js"></script>
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