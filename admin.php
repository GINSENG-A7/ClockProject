<?include "./connection_script.php"?>
<?
$sectionsArray = SelectAllSections($conn);
if (isset($_SESSION["login"])) {
	$login = $_SESSION["login"];
	print_r($login);
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
	<input id="sectionsArray" type="hidden" value="sectionsArray"  data-sectionsArrayLength="<?echo(count($sectionsArray))?>">
	<div class="tab">
		<div>
			<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
				<button class="tab-links"><?echo($sectionsArray[$i]['sectionName'])?></button>
			<?}?>
		</div>
		<button class="tab-links">Клиенты</button>
		<form  action="entionAdmin.php">
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
			$entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, $sectionsArray[$i]['idSection']);
			if (is_countable($entryesBySectionArray)) {
				for ($j = 0; $j < count($entryesBySectionArray); $j++) {
					if($entryesBySectionArray[$j] != null) {
						// print_r($entryesBySectionArray[$j]);
						?>
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