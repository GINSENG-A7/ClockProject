<<<<<<< Updated upstream
=======
<?php
if (!isset($_COOKIE['User'])) {
header("location: ./authorization.php");
}
?>
>>>>>>> Stashed changes
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
		<button class="tab-links">Часы</button>
		<button class="tab-links">Браслеты</button>
		<button class="tab-links">Кольца</button>
		<button class="tab-links">Подвески</button>
		<button class="tab-links">Цепи</button>
		<button class="tab-links">Ремни</button>
		<button class="tab-links">Бритвы</button>
		<button class="tab-links">Портмоне</button>
		<button class="tab-links">Брелки</button>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<!-- Tab content -->
	<div id="Часы" class="tab-content">
		<h3>London</h3>
		<p>London is the capital city of England.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Браслеты" class="tab-content">
		<form method="POST" action="fileLoader.php" class="tab-content-addingNewEntry" enctype="multipart/form-data">
			<div class="wrapper">
				<span class="wrapper-span">Наименование</span>
				<textarea class="wrapper-title" name="title" id="title" cols="30" rows="1"></textarea>
			</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
			<div class="wrapper">
				<span class="wrapper-span">Цена</span>
				<textarea class="wrapper-price" name="price" id="price" cols="30" rows="1"></textarea>
			</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
			<div class="wrapper">
				<span class="wrapper-span">Описание</span>
				<textarea class="wrapper-body" name="body" id="body" cols="30" rows="1"></textarea>
			</div>
			<input type="submit" value='Загрузить' name="submit">
			<input type="file" id="files" name="files[]" multiple class="custom-file-input" />
			<output id="list"></output>
		</form>
	</div>
<<<<<<< Updated upstream


=======
>>>>>>> Stashed changes
	<div id="Кольца" class="tab-content">
		<h3>Tokyo</h3>
		<p>Tokyo is the capital of Japan.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Подвески" class="tab-content">
	<h3>London</h3>
	<p>London is the capital city of England.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Цепи" class="tab-content">
	<h3>Paris</h3>
	<p>Paris is the capital of France.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Ремни" class="tab-content">
	<h3>Tokyo</h3>
	<p>Tokyo is the capital of Japan.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Бритвы" class="tab-content">
	<h3>London</h3>
	<p>London is the capital city of England.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Портмоне" class="tab-content">
	<h3>Paris</h3>
	<p>Paris is the capital of France.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<div id="Брелки" class="tab-content">
	<h3>Tokyo</h3>
	<p>Tokyo is the capital of Japan.</p>
	</div>
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
	<script src="./js/admin.js"></script>
	<script src="./js/filesLoader.js"></script>
</body>