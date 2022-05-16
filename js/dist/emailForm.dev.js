"use strict";

var form = document.querySelector('#registrationForm'); // form.addEventListener('submit', async (e) => {
// 	e.preventDefault();
// 	let response = await fetch('/create_ticket_scrpt.php', {
// 		method: 'POST',
// 		body: new FormData(form)
// 	});
// 	if (response.ok) {
// 		window.location.replace("../index.php");
// 		alert("Учётная запись успешно создана");
// 	}
// 	else {
// 		alert("Request error");
// 	}
// });

var button = document.querySelector(".form__button");
button.addEventListener("click", function () {
  button.form.submit();
});