let dataForm = document.getElementsByClassName("personal__data-form")[0];
dataForm.addEventListener('submit', async (e) => {
	e.preventDefault();
	let response = await fetch(dataForm.action, {
		method: 'POST',
		body: new FormData(dataForm)
	});
	if (response.ok) {
		window.location.replace("../personal.php");
		alert("Данные учётной записи успешно обновлены.");
	}
	else {
		alert("Request error");
	}
});
let allDataInputs = dataForm.querySelectorAll("input[type=text]");

let changeDataButton = document.querySelector("#changeDataButton");
let dataInputsAreNotEmpty = true;
let fioValidationIsGood = true;
let loginValidationIsGood = true;
let emailValidationIsGood = true;
let postIndexValidationIsGood = true;

changeDataButton.addEventListener("click", (event) => {
	event.preventDefault();
	dataInputsAreNotEmpty = true;
	fioValidationIsGood = true;
	loginValidationIsGood = true;
	emailValidationIsGood = true;
	postIndexValidationIsGood = true;
	for (const input of allDataInputs) {
		if (input.value == "" && input.id != "Flat") {
			dataInputsAreNotEmpty = false;
		}
	}
	if (dataInputsAreNotEmpty == false) {
		toggleValidationError("Все поля обязательны к заполнению.", dataForm);
	}
	else {
		for (const input of allDataInputs) {
			if (input.id == "Email") {
				let regex3 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				emailValidationIsGood = regex3.test(input.value);
				if (emailValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании эл. почты.", dataForm);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
			if (input.id == "PostIndex") {
				let regex4 = /^[0-9]{6}$/;
				postIndexValidationIsGood = regex4.test(input.value);
				if (postIndexValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании почтового индекса.", dataForm);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}								
			}
			if (input.id == "Name" || input.id == "Surname" || input.id == "Patronymic") {
				if (fioValidationIsGood == true) {
					if (fioValidationIsGood == false) {
						toggleValidationError("Неверныйформат данных при указании ФИО.", dataForm);
						input.classList.add("error");
					}
					else {
						let regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
						fioValidationIsGood = regex1.test(input.value);
						input.classList.remove("error");
					}
				}
			}
			if (input.id == "Login") {
				let regex2 = /^[a-zA-Z0-9]{4,250}$/;
				loginValidationIsGood = regex2.test(input.value);
				if (loginValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании логина.", dataForm);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
		}
	}
	if (dataInputsAreNotEmpty == true && fioValidationIsGood == true && loginValidationIsGood == true && emailValidationIsGood == true && postIndexValidationIsGood == true) {
		// let changeDataInput = dataForm.querySelector("#ChangeData");
		// changeDataInput.click();
	}
});

let passwordForm = document.getElementsByClassName("personal__password-form")[0];
passwordForm.addEventListener('submit', async (e) => {
	e.preventDefault();
	let response = await fetch(passwordForm.action, {
		method: 'POST',
		body: new FormData(passwordForm)
	});
	if (response.ok) {
		window.location.replace("../personal.php");
		alert("Пароль успешно измененён.");
	}
	else {
		alert("Request error");
	}
});
let allPasswordsInputs = passwordForm.querySelectorAll("input[type=password]");

let changePasswordButton = document.querySelector("#changePasswordButton");
let passwordInputsAreNotEmpty = true;
let oldPasswordValidationIsGood = true;
let newPasswordValidationIsGood = true;

changePasswordButton.addEventListener("click", (event) => {
	event.preventDefault();
	passwordInputsAreNotEmpty = true;
	oldPasswordValidationIsGood = true;
	newPasswordValidationIsGood = true;

	for (const input of allPasswordsInputs) {
		if (input.value == "") {
			passwordInputsAreNotEmpty = false;
		}
	}
	if (passwordInputsAreNotEmpty == false) {
		toggleValidationError("Все поля обязательны к заполнению.", passwordForm);
	}
	else {
		let oldPW;
		let newPW;
		for (const input of allPasswordsInputs) {
			if (input.id == "OldPassword") {
				let regex1 = /^[a-zA-Z0-9]{4,250}$/;
				oldPasswordValidationIsGood = regex1.test(input.value);
				if (oldPasswordValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании текущего пароля.", passwordForm);
					input.classList.add("error");
				}
				else {
					oldPW = input;
					input.classList.remove("error");
				}
			}
			if (input.id == "NewPassword") {
				let regex2 = /^[a-zA-Z0-9]{4,250}$/;
				newPasswordValidationIsGood = regex2.test(input.value);
				if (newPasswordValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании нового пароля.", passwordForm);
					input.classList.add("error");
				}
				else {
					newPW = input;
					input.classList.remove("error");
				}
			}
			if (input.id == "NewPasswordCheck") {
				if (newPW.value != input.value) {
					toggleValidationError("Новый пароль не совпадает.", passwordForm);
					input.classList.add("error");
					newPW.classList.add("error");
				}
				else if (oldPW.value == newPW.value) {
					toggleValidationError("Новый пароль совпадает со старым.", passwordForm);
					oldPW.classList.add("error");
					newPW.classList.add("error");
				}
				else {
					oldPW.classList.remove("error");
					newPW.classList.remove("error");
					input.classList.remove("error");
				}
			}
		}
	}
	if (passwordInputsAreNotEmpty == true && oldPasswordValidationIsGood == true && newPasswordValidationIsGood == true) {
		// let changePasswordInput = passwordForm.querySelector("#PasswordData");
		// changePasswordInput.click();
	}
});

function toggleValidationError(errorMessage, parentElement) {
	let validationError = document.querySelector(".validationError");
	if (validationError != null) {
		validationError.remove();
	}
	let validationErrorNode = document.createElement("p");
	validationErrorNode.innerText = errorMessage;
	validationErrorNode.classList.add('validationError');
	parentElement.appendChild(validationErrorNode);
}