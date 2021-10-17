<?include "./connection_script.php"?>
<?
$sectionsArray = SelectAllSections($conn);
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
<body>
	<div class="tab">
	<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
		<button class="tab-links"><?echo($sectionsArray[$i]['sectionName'])?></button>
	<?}?>
	</div>

	<!-- Tab content -->
	<h2 class="ContentH2">Добавление</h2>

	<?for ($i = 0; $i < count($sectionsArray); $i++) {?>
		<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-content">
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
				<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
				<input id="data_input" type="submit" name="Post-submit" value="Добавить">
				<input type="hidden" name="Tab-id" value="<?echo($sectionsArray[$i]['sectionName'])?>">
				<output id="list"></output>
			</form>
		</div>
	<?}?>

	<span class="bottom-line"></span>

	<!-- Output content -->
	<h2 class="OutputH2">Изменение</h2>

	<?for ($i = 0; $i < count($sectionsArray); $i++) {
		?>
		<div id="<?echo($sectionsArray[$i]['sectionName'])?>" class="tab-output">
			<?
			$entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, $sectionsArray[$i]['idSection']);
			if (is_countable($entryesBySectionArray)) {
				for ($j = 0; $j < count($entryesBySectionArray); $j++) {
					if($entryesBySectionArray[$j] != null) {
						print_r($entryesBySectionArray[$j]);
						?>
							<form id="outputForm-<?$sectionsArray[$i]['sectionName']?>-<?$entryesBySectionArray[$j]['idEntry']?>" action="">
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
								<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
								<input id="edit_input" type="submit" name="Post-edit" value="Изменить">
								<input type="hidden" name="Section-id" value="<?echo($sectionsArray[$i]['sectionName'])?>">
								<input type="hidden" name="Entry-id" value="<?echo($entryesBySectionArray[$j]['idEntry'])?>">
							</form>
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